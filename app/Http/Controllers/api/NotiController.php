<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class NotiController extends Controller
{
    public function getNoti(){
        $noti = DB::table('notifications')->first();
        $data = [
            "noti" => $noti,
        ];
        return response()->json($data, Response::HTTP_OK);
    }

    public function editNoti(Request $data){
        try {
            DB::table('notifications')->where('id', '=', $data->id)
                ->update([
                    'is_active' => $data->is_active,
                ]);
            return response()->json(['success' => "Cập nhật thành công"], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => "Hệ thống đang lỗi vui lòng thử lại sau!"], 400);
        }
    }
}