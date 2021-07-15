<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EnsureOtpVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
        if(auth()->user()){
            $user = auth()->user();
            if($user->otp_verify == 0){
                return redirect('verify-otp');
            }else{
                return $next($request);
            }
        }else{
            return route('login');
        }
       
    }
}
