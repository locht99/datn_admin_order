<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\AdminModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    public function getManager(){
        $managers = DB::table('admins')->where('id', '!=', auth()->id())->select('id', 'username', 'phone', 'role')->paginate(10);
        return response()->json($managers);
    }

    public function getDataUpdate(){
        
    }

    public function postDataUpdate(Request $request){
        try {
            $data = [
                'username' => $request['username'],
                'phone' => $request['phone'],
                'role' => $request['role'],
            ];
            $res = AdminModel::query()->where('id', $request['id'])->update($data);
            $data_resp = [
                'resp_update' => $res
            ];
            return response()->json($data_resp, Response::HTTP_OK);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function postDataAdd(Request $request){
        try {
            $admin = AdminModel::where('username', $request['username'])->first();
            if($admin){
                return response()->json(['error'=>'Tên tài khoản admin đã tồn tại']);
            }
            $data = [
                'partner_id' => 0,
                'username' => $request['username'],
                'password' => Hash::make($request['password']),
                'phone' => $request['phone'],
                'role' => 2,
            ];
            $res = AdminModel::query()->create($data);
            $data_resp = [
                'resp_update' => $res
            ];
            return response()->json($data_resp, Response::HTTP_OK);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
