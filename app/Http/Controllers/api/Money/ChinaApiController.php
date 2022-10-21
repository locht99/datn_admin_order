<?php

namespace App\Http\Controllers\api\Money;

use App\Http\Controllers\Controller;
use App\Http\Resources\Money\ChinaResource;
use App\Models\AdminTransactionModel;
use App\Models\ConfigModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChinaApiController extends Controller
{
    protected $adminTransactionModel;

    public function __construct(AdminTransactionModel $adminTransactionModel)
    {
        $this->adminTransactionModel = $adminTransactionModel;
    }
    public function getChineseMoneyTransaction(Request $request)
    {
        try {
            $data = $this->adminTransactionModel->getChinaTransaction($request);
            if (is_null($data)) {
                return response()->json([
                    "data" => null
                ]);
            }
            return ChinaResource::collection($data);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function createChinaMoneyTransaction(Request $request)
    {
        try {

            // $type = $request->type ? $request->type : null;
            $type = $request->post('type',0);
            $point_cn = $request->point_cn ? $request->point_cn : null;
            $surplus = $request->surplus ? $request->surplus : null;
            $content = $request->content ? $request->content : null;
            $exchange_rate = ConfigModel::where('key', 'EXCHANGE_RATE')->first()->value;
            
            if (!$type && !$request->additional_grouped) {
                return response()->json(['errors' => ['type' => 'Chọn loại giao dịch!']]);
            }

            $validator = Validator::make(
                $request->all(),
                [
                    'point_cn' => 'required|numeric',
                    'content' => 'required',
                ],
                [
                    'point_cn.required' => 'Vui lòng nhập số tiền!',
                    'point_cn.numeric' => 'Số tiền phải là số!',
                    'content.required' => 'Vui lòng nhập nội dung giao dịch!',
                ]
            );

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            if ($type == config('const.admin_transaction_type.currency_exchange')) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'surplus' => 'required|numeric',
                    ],
                    [
                        'surplus.required' => 'Vui lòng nhập số dư!',
                        'surplus.numeric' => 'Số dư phải là số!',
                    ]
                );

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()]);
                }
                $point_vn = $point_cn * $exchange_rate;
            } elseif ($type == config('const.admin_transaction_type.payment')) {
                $point_cn = -1 * abs($point_cn);
                $point_vn = null;
                $surplus = null;
            } else {
                $point_vn = null;
                $surplus = null;
            }


            $data = [
                'type_id' => $type,
                'content' => $content,
                'point_cn' => $point_cn,
                'point_vn' => $point_vn,
                'surplus' => $surplus,
                'date' => Carbon::now()
            ];
            $newChinaTransaction = AdminTransactionModel::create($data);

            return response()->json([
                'message' => 'Tạo mới giao dịch thành công',
                'data'  => $newChinaTransaction
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function getAdminTypeTransactionsChinese()
    {
        try {
            $type_id = [
                config('const.admin_transaction_type.currency_exchange'),
                config('const.admin_transaction_type.payment'),
                config('const.admin_transaction_type.orther_fee')
            ];
            $admin_type_transaction_chinese = DB::table('admin_transactions_types')
                ->whereIn('id', $type_id)
                ->select(
                    'admin_transactions_types.id',
                    'admin_transactions_types.name'
                )
                ->get();
            return response()->json([
                'admin_type_transactions_chinese' =>  $admin_type_transaction_chinese,
                'exchange_rate' => ConfigModel::where('key', config('const.config.EXCHANGE_RATE'))->first()
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                "message" => $th->getMessage()
            ]);
        }
    }
}
