<?php

use App\Http\Controllers\CirculationController;
use App\Http\Controllers\FlixyController;
use App\Http\Controllers\searchableMailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes(['register'=>false]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/stats/{page}', [App\Http\Controllers\HomeController::class, 'stats'])->name('stats');
    Route::get('/account', [App\Http\Controllers\AccountController::class, 'showAccount'])->name('account.show');
    Route::post('/account', [App\Http\Controllers\AccountController::class, 'updateAccount'])->name('account.update');
    Route::get('/vendeurs/stats', [App\Http\Controllers\VendeurController::class, 'stats'])->name('vendeurs.stats');

    Route::resource('administration/users', App\Http\Controllers\UserController::class);
    Route::resource('clients', App\Http\Controllers\ClientsController::class);
    Route::resource('vendeurs', App\Http\Controllers\VendeurController::class);
    Route::resource('dfms', App\Http\Controllers\DfmController::class);
    Route::get('/edit/{id}/password', [App\Http\Controllers\RestoController::class, 'editPassword'])->name('restos.password');
    Route::patch('/edit/{id}/password', [App\Http\Controllers\RestoController::class, 'editPasswordStore'])->name('restos.password.store');
    Route::resource('restos', App\Http\Controllers\RestoController::class);
    Route::resource('meal-types', App\Http\Controllers\MealTypeController::class);
    Route::resource('residences', App\Http\Controllers\ResidencesController::class);
});

Route::group(['middleware'=>'auth'],function(){
    Route::get('/moveSoleToSeller',[FlixyController::class, 'moveSoleToSellerCreate'])->name('moveSoleToSeller.create');
    Route::post('/moveSoleToSeller',[FlixyController::class, 'moveSoleToSeller'])->name('moveSoleToSeller.store');
    Route::post('/transactionsPerDateDouDFM', [FlixyController::class, 'transactionsPerDateDouDFM']);
});
