<?php

namespace App\Providers;

use App;
use App\Models\Dossier;
use App\Models\Etablissement;
use App\Models\Register;
use App\Models\Residences;
use App\Models\Resto;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use jeremykenedy\LaravelRoles\Models\Role;
use View;

class ViewServiceProvider extends ServiceProvider
{
    private $nullSelected = [null => 'Select .... '];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.app', function ($view){

        });

        //********* Dashboard Views
        View::composer(['Home.partials.register-stats'], function ($view) {

        });
        //********* Users Views
        View::composer(['users.fields'], function ($view) {
            $rolesItems = $this->nullSelected + Role::all()->pluck('description', 'id')->toArray();
            $view->with('rolesItems', $rolesItems);
        });
        //********* Resto Views
        View::composer(['restos.fields'], function ($view) {
            $residenceItems = $this->nullSelected +
                Cache::remember('residenceItems', 60*60*24, function () {
                    return  Residences::all()->pluck('denomination_ar', 'id_residence')->toArray();
                });
            $douItems = $this->nullSelected +
                Cache::remember('douItems', 60*60*24, function () {
                    return  Resto::select('dou_code')->distinct('dou_code')->pluck('dou_code', 'dou_code')->toArray();
                });
            $activeItems = $this->nullSelected + [0=>__('models/restos.inactive'),1=>__('models/restos.active')];
            $restoTypeItems = $this->nullSelected +
                [
                    2=>__('models/restos.residence'),
                    1=>__('models/restos.central'),
                    3=>__('models/restos.integrated')
                ];
            $view->with('douItems', $douItems)
                    ->with('residenceItems', $residenceItems)
                    ->with('activeItems', $activeItems)
                    ->with('restoTypeItems', $restoTypeItems);
        });

        //********* Vendeur Views
        View::composer(['vendeurs.fields'], function ($view) {
            $RestoItems = $this->nullSelected ;
                $restos =  Resto::get();

            $RestoItems += $restos->map(function ($resto, $RestoItems) {
                    return [$resto->id => $resto->name . ' - ' . $resto->dou_code];
                })->toArray();

            $view->with('RestoItems', $RestoItems);
        });



    }
}
