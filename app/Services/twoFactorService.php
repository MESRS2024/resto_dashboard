<?php


namespace App\Services;

use PragmaRX\Google2FALaravel\Support\Authenticator;

class twoFactorService
{


    public function generateSecret()
    {
        return app('pragmarx.google2fa')->generateSecretKey();
    }

    public function getQRCodeInline($company, $holder, $secret)
    {
        return app('pragmarx.google2fa')->getQRCodeInline(
            $company,
            $holder,
            $secret
        );
    }

    public function verifyKey($secret, $key)
    {
        $authenticator = app(Authenticator::class);
        return $authenticator->verifyKey($secret, $key);
    }
}
