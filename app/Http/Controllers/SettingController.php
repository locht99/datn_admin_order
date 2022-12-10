<?php

namespace App\Http\Controllers;

use App\Models\ConfigModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {
        $config_key = [
            config('const.config.EXCHANGE_RATE'),
            config('const.config.WOOD_FEE'),
            config('const.config.OWN_WOOD_FEE'),
        ];
        $data_settings = DB::table('configs')
            ->select('name', 'value')
            ->whereIn('key', $config_key)->get();

        return response()->json(['data_settings' => $data_settings]);
    }
    public function fee()
    {
        return view(('admin.settings.edit'), [
            'title' => 'Thiết lập dịch vụ'
        ]);
    }

    public function getDataConfig()
    {
        $config_key = [
            config('const.config.EXCHANGE_RATE'),
            config('const.config.WOOD_FEE'),
            config('const.config.OWN_WOOD_FEE'),
        ];
        $data_settings = DB::table('configs')
            ->select('name', 'value', 'id', 'key')
            ->whereIn('key', $config_key)->get();
        return response()->json(['data_settings' => $data_settings]);
    }

    public function updateConfig(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->input(),
                [
                    '*.value' => 'required|numeric',
                ],
                [
                    '*.value.required' => 'Vui lòng nhập số tiền !',
                    '*.value.numeric' => 'Số tiền phải là số !'
                ]
            );
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ]);
            }
            foreach ($request->input() as $key => $val) {
                $config_key = ConfigModel::find($val['id']);
                $config_key->value = $val['value'];
                $config_key->save();
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => "Hệ thống đang lỗi vui lòng thử lại sau!"], 400);
        }
    }
}
