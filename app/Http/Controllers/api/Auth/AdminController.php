<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AdminController extends Controller
{
    public function getLogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "username" => "required",
                "password" => "required"
            ], [
                "username.required" => "Tài khoản không được để trống",
                "password.required" => "Mật khẩu không được để trống",
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first()
                ], ResponseAlias::HTTP_BAD_REQUEST);
            }
    
            $credentials = request(['username', 'password']);
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Tài khoản hoặc mật khẩu không đúng.'
                ], ResponseAlias::HTTP_UNAUTHORIZED);
            }
            $user = Auth::user();
            $tokenResult = $user->createToken('Personal Access Token ' . Str::random(10));
            $token = $tokenResult->token;
            $token->save();
    
            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                "message" => $th->getMessage()
            ]); 
        }
        
    }
    
}
