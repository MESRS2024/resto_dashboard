<?php

namespace App\Services\Account;
use App\Models\User;
use App\Models\Vendeur;
use Illuminate\Support\Facades\Hash;

class AccountService
{
    public function __construct()
    {
    }


    public function updatePassword(User $user, ?string $password, ?string $password_confirmation, ?string $password_old)
    {
        if ($password !== $password_confirmation) {
            return ['message' => 'كلمة المرور غير متطابقة', 'status' => false];
        }

        if (!Hash::check($password_old, $user->password)) {
            return ['message' => 'كلمة المرور القديمة غير صحيحة', 'status' => false];
        }
        #update password
        // if hasRole vendeur chane vendeur password in table vendeurs
        if ($user->hasRole('vendeur')) {
            $vendeur = Vendeur::where('phone', $user->email)->first();
            $vendeur->update(['password' => bcrypt($password)]);
        }

        auth()->user()->update(['password' => bcrypt($password)]);

        return ['message' => 'تم تغيير كلمة المرور بنجاح', 'status' => true];
    }
}
