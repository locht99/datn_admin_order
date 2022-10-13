<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getUsers()
    {
        $model = new User();
        $users = $model->getUsers();
        return response()->json($users, 200);
    }

    public function updateUser(Request $request)
    {
        $model = new User();
        $resp_find_user = $model->updateUser($request->id);

        if ($request->isMethod('post')) {
            // $validator = Validator::make($request->all(), [
            //     "email" => "required",
            //     "phone" => "required",
            //     "point" => "required",
            // ], [
            //     "email.required" => "Email không được để trống",
            //     "phone.required" => "Số điện thoại không được để trống",
            //     "point.required" => "Điểm không được để trống",
            // ]);
            // if ($validator->fails()) {
            //     return response()->json([
            //         'message' => $validator->errors()->first()
            //     ], 400);
            // }
            $data = [
                'id' => $request->id,
                'email' => $request->email ? $request->email : $resp_find_user->email,
                'phone' => $request->phone ? $request->phone : $resp_find_user->phone,
                'point' => $request->point ? $request->point : $resp_find_user->point,
                'is_delete' => $request->is_delete,
                'vip_level' => $request->vip_level,
            ];
            $model = new User();
            $res = $model->saveUpdateUser($data);
        }
        $data_resp = [
            'user_find' => $resp_find_user,
            'resp_update' => $res
        ];
        return response()->json($data_resp, Response::HTTP_OK);
    }
}
