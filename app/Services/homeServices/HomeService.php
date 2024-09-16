<?php
namespace App\Services\homeServices;
use App\Charts\MonthlyMeals;
use App\Models\Mealstats;
use App\Models\Vendeur;
use App\Services\ChartService;
use App\Services\StatisticsService;
use Illuminate\Support\Carbon;

class HomeService
{
   public function adminDashboard(?int $month, ?int $year)
   {
       $statisticsService = new StatisticsService();

       $mealsPerDou = $statisticsService->statsPerMealsPerDou(Carbon::now()->format('Y-m-d'));

       // create a chart for monthly meals
       $month = ($month)?$month: Carbon::now()->month;

       $year = ($year)?$year: Carbon::now()->year;

       $chart = (new ChartService) ->MonthlyMeals($month, $year);

       return view('Home.home.home',
           [
               'mealsPerDou' => $mealsPerDou,
               'chart' => $chart,
               'month' => $month,
               'year' => $year
           ]);
   }


    public  function  dfmDashboard()
    {
        return view('Home.dfm.dashboard');
    }

    public  function  vendeurDashboard()
    {
        $vender = Vendeur::where ('phone', auth()->user()->email)
                ->with('wallet')->first();
        return view('Home.vendeur.dashboard'
            ,['vender'=>$vender]);
    }
}
