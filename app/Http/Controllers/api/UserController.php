<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getUsers(Request $request)
    {
        $search = [
            'from' => $request->from ? $request->from : null,
            'to' => $request->to ? $request->to : null,
            'username' => $request->username ? $request->username : null,
            'phone' => $request->phone ? $request->phone : null,
        ];
        $model = new User();
        $users = $model->getUsers($search);
        return response()->json($users, 200);
    }

    public function updateUser(Request $request)
    {
        $model = new User();
        $resp_find_user = $model->updateUser($request->id);

        $data_resp = [
            'user_find' => $resp_find_user,
            // 'resp_update' => $res
        ];
        return response()->json($data_resp, Response::HTTP_OK);
    }

    public function postUpdateUser(Request $request){
        try{
            $model = new User();
            $resp_find_user = $model->updateUser($request['id']);
            $data = [
                'id' => $request['id'],
                'username' => $request['username'] ? $request['username'] : $resp_find_user->username,
                'phone' => $request['phone'] ? $request['phone'] : $resp_find_user->phone,
                'point' => $request['point'] ? $request['point'] : $resp_find_user->point,
                'is_delete' => $request['is_delete'],
                'vip_level' => $request['vip_level'],
            ];
            $res = $model->saveUpdateUser($data);
            $data_resp = [
                'resp_update' => $res
            ];
            return response()->json($data_resp, Response::HTTP_OK);
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}
