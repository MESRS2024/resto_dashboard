<?php
namespace App\Services\homeServices;
use App\Charts\MonthlyMeals;
use App\Models\Mealstats;
use App\Services\ChartService;
use App\Services\StatisticsService;
use Illuminate\Support\Carbon;

class HomeService
{
   public function adminDashboard(?int $month, ?int $year)
   {
       $statisticsService = new StatisticsService();
       //When the user is a dou.
       $mealsPerDou = $statisticsService
           ->statsPerMealsPerDou(
               Carbon::now()->format('Y-m-d'),
               //'2024-05-15',
               auth()->user()->code_dou);

       //When the user is Onou.

       //When the user is Residence
       $mealsPerDou = $statisticsService
           ->statsPerMealsPerDou(
               Carbon::now()->format('Y-m-d'),
               //'2024-05-15',
               auth()->user()->progres_id);
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
        return view('Home.dfm.dfmdashboard');
    }
}
