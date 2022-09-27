<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PartnerResource;
use App\Models\PartnerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        try {
            $name = $request->name ? $request->name : null;
            $phone = $request->phone ? $request->phone : null;
            $from = $request->from ? $request->from : null;
            $to = $request->to ? $request->to : null;
            $is_running = $request->is_running;
            $is_delete = $request->is_delete;

            $partner = DB::table('partners');

            if ($name) {
                $partner->where('partners.name', 'like', "%{$name}%");
            }
            if ($phone) {
                $partner->where('partners.phone', 'like', "%{$phone}%");
            }
            if ($from) {
                $partner->whereDate('partners.create_at', '>=', $from);
            }
            if ($to) {
                $partner->whereDate('partners.create_at', '<=', $to);
            }
            if ($is_running != null) {
                $partner->where('partners.is_running', $is_running);
            }
            if ($is_delete != null) {
                $partner->where('partners.is_delete', $is_delete);
            }

            $data = $partner->paginate(config('const.pagination.per_page'));

            return response()->json([
                'data' => PartnerResource::collection($data)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $name = $request->name;
            $phone = $request->phone;

            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:100',
                    'phone' => 'required|regex:/^(0)[0-9]{9}$/|unique:partners,phone',
                ],
                [
                    'name.required' => 'Vui lòng nhập họ và tên đối tác!',
                    'name.max:100' => 'Tên không quá 100 ký tự!',
                    'phone.required' => 'Vui lòng nhập số điện thoại!',
                    'phone.regex' => 'Số điện thoại không đúng định dạng',
                    'phone.unique' => 'Số điện thoại đã tồn tại trong hệ thống'
                ]
            );
            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => $validator->errors()
                ]);
            }

            $newPartner = PartnerModel::create([
                'name' => $name,
                'phone' => $phone,
                'is_running' => 1,
            ]);
            return response()->json([
                'data' => $newPartner
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $partner = PartnerModel::find($id);
            if (!$partner) {
                return response()->json([
                    'error' => true,
                    "message" => 'id không tồn tại'
                ]);
            }

            $request->validate(
                [
                    'name' => 'required|max:100',
                    'phone' => 'required|regex:/^(0)[0-9]{9}$/|unique:partners,phone,' . $id,
                    'point' => 'numeric|min:0'
                ],
                [
                    'name.required' => 'Vui lòng nhập họ và tên đối tác!',
                    'name.max:100' => 'Tên không quá 100 ký tự!',
                    'phone.required' => 'Vui lòng nhập số điện thoại!',
                    'phone.regex' => 'Số điện thoại không đúng định dạng',
                    'phone.unique' => 'Số điện thoại đã tồn tại trong hệ thống',
                    'point.numeric' => 'Số tiền phải là số!',
                    'point.min' => 'Số tiền phải là số dương',
                ]
            );
            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'is_running' => $request->is_running ? 1 : 0,
                'is_delete' => $request->is_delete ? 1 : 0,
                'point' => $request->point ? $request->point : 0
            ];

            $partner->fill($data);
            $partner->save();
            return response()->json([
                'data' => $partner
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'message' => $th->getMessage()
            ]);
        }
    }
}
