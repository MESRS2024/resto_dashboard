<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FALaravel\Support\Authenticator;

class TwoFaController extends Controller
{
    //
    public function __construct()
    {

    }

    public function index()
    {
        // if 2FA is already enabled, redirect to home
        if (auth()->user()->active2fa) {
            // redirect()->route('home');
            session()->flash('status', true);
            return view('auth.two-factor-authentication')->with([
                'qrCodeUrl' => ''
            ]);
        }
        // else, show the 2FA setup page
        $user = auth()->user();
        $authenticator = app(Authenticator::class);
        $secret = $authenticator->generateSecretKey();
        $user->two_factor_secret = $secret;
        $user->save();
        $qrCodeUrl = $authenticator->getQRCodeInline(
            config('app.name'),
            $user->email,
            $secret
        );
        return view('auth.two-factor-authentication')->with([
            'secret' => $secret,
            'qrCodeUrl' => $qrCodeUrl
        ]);
    }


    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);
        $authenticator = app(Authenticator::class);
        $valid = $authenticator->verifyKey(
            auth()->user()->two_factor_secret,
            $request->otp
        );
        if ($valid) {
            auth()->user()->active2fa = true;
            auth()->user()->save();
            return redirect()->route('2fa.index');
        }
        return back()->withErrors([
            'otp' => 'Invalid code. Please try again.'
        ]);
    }

}
