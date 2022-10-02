<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use App\Models\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AdminController extends Controller
{
    private function guard()
    {
        return Auth::guard();
    }
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
            ])->header('authorization', $tokenResult->accessToken)
                ->header('Access-Control-Expose-Headers', 'Authorization');
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                "message" => $th->getMessage()
            ]);
        }
    }
    public function getUser()
    {
        try {
            $user = Auth::user();
            return response()->json(['data' => $user]);
        } catch (\Throwable $th) {
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }

    public function refresh()
    {
        $user = Auth::user();
        $tokenResult = $user->createToken('Personal Access Token ' . Str::random(10));
        $token = $tokenResult->token;
        if ($token =Auth::user()->refresh()) {
            $token->save();
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization',  $tokenResult->accessToken);
        }
        
        return response()->json(['error' => 'refresh_token_error'], 401);
    }
  
}
