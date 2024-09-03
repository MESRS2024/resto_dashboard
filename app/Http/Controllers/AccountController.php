<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAccountRequest;
use App\Services\Account\AccountService;
use Flash;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //
    public function __construct()
    {

    }

    public function showAccount()
    {
        return view('account.show');
    }

    public function updateAccount(UpdateAccountRequest $request)
    {

        $update = (new AccountService())->updatePassword(
            auth()->user(),
            $request->input('password'),
            $request->input('password_confirmation'),
            $request->input('password_old')
        );
        if(!$update['status']) {
            Flash::error($update['message']);
            return redirect()->back();
        }
        Flash::success($update['message']);
        //disconeect user after change password
        auth()->logout();
        return redirect(route('account.show'));
    }
}
