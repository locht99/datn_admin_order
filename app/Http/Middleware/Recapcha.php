<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use ReCaptcha\ReCaptcha as GoogleRecaptcha;

class Recapcha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $response = (new GoogleRecaptcha(config('recaptchav2.secret')))
        // ->verify($request->input('g-recaptcha-response'),$request->ip());
        // if(!$response->isSuccess()){
        //     $message = 'Xác thực thất bại, vui lòng thử lại sau !';
        //     return response()->json(['message'=>$message],422);
        // }
        return $next($request);
    }
}
