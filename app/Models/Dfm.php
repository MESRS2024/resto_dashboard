<?php

namespace App\Models;

use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Interfaces\WalletFloat;
use Bavix\Wallet\Models\Transfer;
use Bavix\Wallet\Traits\HasWalletFloat;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;


#[ScopedBy([Scopes\dfm\dfmScope::class])]
class Dfm extends Model implements Wallet, WalletFloat
{
    use HasFactory,HasApiTokens;
    use SoftDeletes;
    use HasWalletFloat;

    protected $hidden = [
        'password',
    ];


    public function restos()
    {
        return Resto::where('dou_coude',$this->dou_code)->get();
    }

    public function transfersToVendeur(): HasMany
    {
        return $this->transfers()->where('to_type', Vendeur::class);
    }

}
