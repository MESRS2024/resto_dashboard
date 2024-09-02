<?php

namespace App\Services;



use App\Models\Vendeur;

class DfmService
{
    public function getSeller($phone, $dou_code)
    {
        return Vendeur::where('phone', $phone)
                        ->Dou($dou_code)
                        ->first();
    }
}
