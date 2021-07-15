<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {    
        $request->authenticate();
        
        $request->session()->regenerate();
        $this->generateTwoFactorCode();
        return redirect()->intended(RouteServiceProvider::VERIFYOTP);
    }

    /**
     * Tow factor authentication code generation
     */
    public function generateTwoFactorCode()
    {       
            $user = auth()->user();
            $user->otp = rand(100000, 999999);
            $user->otp_verify = '0';
            $user->save();
            return $this->sendOtp($user->otp,$user->email);
    }


    /**
     * Send Otp for verification
     */
    public function sendOtp($otp ,$userEmail){
        $details = [
            'title' => 'Otp | Admin Login Verification',
            'subject' => 'Otp | Admin Login Verifcation',
            'otp' => $otp

        ];
        $mailRes = \Mail::to($userEmail)->send(new \App\Mail\OtpMail($details));
        return $mailRes;
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {   
        $user = auth()->user();
        $user->otp = NULL;
        $user->otp_verify = NULL;
        $user->save();
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
