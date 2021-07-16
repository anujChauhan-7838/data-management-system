<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OtpVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function show(Request $request)
    {   
        return $request->user()->otp_verify
                    ? redirect()->intended(RouteServiceProvider::HOME)
                    : view('auth.verify-otp');
    }


    /**
     * Verify OTP put by users
     */

     public function verify(Request $request){
        
        $postData = $request->all();
        $user     = auth()->user();
        if($user){
             if($user->otp == $postData['otp']){
                $user->otp_verify = 1;
                $user->save();
                return redirect()->intended(RouteServiceProvider::HOME);
             }else{
                throw ValidationException::withMessages([
                    'otp' => __('Invalid OTP')
                ]);
             }
        }else{
            $user->otp = NULL;
            $user->otp_verify = NULL;
           return  redirect()->route('login');
        }

        
     }


     public function cancel(Request $request){
      $user = auth()->user();
      $user->otp = NULL;
      $user->otp_verify = NULL;
      $user->save();
      Auth::guard('web')->logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();
      return redirect('/login');
     }
}
