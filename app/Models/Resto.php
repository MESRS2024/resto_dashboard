<?php

namespace App\Models;

use App\Models\Scopes\resto\restoScope;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Interfaces\WalletFloat;
use Bavix\Wallet\Traits\HasWalletFloat;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;


#[ScopedBy([Scopes\resto\restoScope::class])]
class Resto extends Model implements Wallet, WalletFloat
{
    use HasFactory,HasApiTokens;
    use SoftDeletes;
    use HasWalletFloat;
    use HasFactory;

    public static mixed $rules = [
        'name' =>'required|string|max:255',
        'code' =>'required|string|max:255',
        'dou_code' =>'required|string|max:255',
        'resto_type' =>'required|string|max:255',
        'is_active' =>'required|boolean',

     ];
    protected $guarded = ['id'];
    protected $hidden = [
        'password',
    ];

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }

    public function dfm()
    {
        return Dfm::where('dou_coude',$this->dou_code)->first();
    }


    public function vendeurs()
    {
        return $this->hasMany(Vendeur::class);
    }

    public function flixy()
    {
        return $this->hasMany(Flixy::class);
    }

    public function clients()
    {
        return $this->meals()->select('client_id')->groupBy('client_id')->distinct()->pluck('client_id')->toArray();
    }



}
