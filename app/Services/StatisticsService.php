<?php

namespace App\Services;

use App\Models\Mealstatsperday;
use App\Services\RestoService;
use App\Models\Meal;
use App\Models\MealType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsService
{
    /**
     * @param $date
     * @param $resto_id
     * @return \Illuminate\Support\Collection
     * this method will return the number of meals per type for a specific date and resto
     */
    public function statsPerMeals($date, $resto_id): \Illuminate\Support\Collection
    {
        $mealsTypes = MealType::all();
        foreach ($mealsTypes as $mealType) {
            $result[$mealType->name] = Meal::byMealsPerDate($date)
                ->byMealsPerResto($resto_id)
                ->byMealsPerType($mealType->id)
                ->count();
        }
        return collect($result);
    }
    /**
     * @return \Illuminate\Support\Collection
     * this method will return the number of meals per type for the current date and the connected resto
     */
    public function mealsCountId(): \Illuminate\Support\Collection
    {

        $mealType = (new RestoService())->getOpenedMealType();

        $currentDate = Carbon::now()->format('Y-m-d');

        $result = Meal::byMealsPerDate($currentDate)
            ->byMealsPerResto(Auth::user()->id)
            ->byMealsPerType($mealType)
            ->count();
        return collect(['meal_type'=>$mealType,'meals'=>$result]);
    }
    /**
     * @param $date
     * @param $dou_code
     * @return \Illuminate\Support\Collection
     * this method will return the number of meals per type for a specific date and dou
     */
    public function statsPerMealsPerDou($date): array|\Illuminate\Support\Collection
    {
        $result = [];
        $mealsTypes = MealType::orderBy('id')->get();
        foreach ($mealsTypes as $mealType) {
            //if the user is a dou then we will get the number of meals per type for the current date and the connected dou
            if(auth()->user()->hasRole('dou'))
                    $result[$mealType->name] =  Mealstatsperday::byMealsTodayDou($date)
                                                ->where('meal_type_id', $mealType->id)
                                                ->sum($mealType->column_name);

            //if the user is an onou or admin then we will get the number of meals per type for the current date and the connected
            if(auth()->user()->hasRole('onou') || auth()->user()->hasRole('admin'))
                    $result[$mealType->name] = Mealstatsperday::byMealsTodayOnou($date)
                                                 ->where('meal_type_id', $mealType->id)
                                                 ->sum($mealType->column_name);


            //if the user is a residence or admin then we will get the number of meals per type for the current date and the connected
            if(auth()->user()->hasRole('residence'))
                $result[$mealType->name] = Mealstatsperday::byMealsTodayResidence($date)
                                                ->where('meal_type_id', $mealType->id)
                                                ->sum($mealType->column_name);
        }
        return  $result;
    }
    /**
     * @param $dou_code
     * @return \Illuminate\Http\JsonResponse
     * this method will return the number of meals per type for the current date and the connected dou
     */
    function statsPerDouGroupedByDate($dou_code){
        return Meal::byMealsGroupByResto($dou_code)->get();
    }
}
