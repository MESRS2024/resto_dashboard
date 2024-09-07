<?php
namespace App\Services;
use App\Charts\MonthlyMeals;
use App\Models\Mealstats;

class ChartService
{
    /*
     *
     */
    public function MonthlyMeals(int $month = null, int $year = null): monthlyMeals
    {
        $chart = new MonthlyMeals();
        if(!isset($year)){ $year = date('Y'); }

        if(isset($month)){
            $dataset = Mealstats::getMonthMealsStats($month);
        }else{
            $dataset = Mealstats::getMonthMealsStats(date('m'));
        }
        //dd($dataset);
        $labels = $dataset->unique('create_date')->
        pluck('create_date')->toArray();
        list($Breakfast, $launch, $dinner) = $this->CreateDatasets($labels, $dataset);

        $chart->labels($labels);
        $chart->dataset(__('home/dashboard.breakfast'), 'bar', array_values($Breakfast))
            ->color("rgb(255, 99, 132)")
            ->backgroundcolor("rgb(255, 99, 132)");
        $chart->dataset(__('home/dashboard.launch'), 'bar', array_values($launch))
            ->color("rgb(99, 255, 132)")
            ->backgroundcolor("rgb(00, 255, 132)");
        $chart->dataset(__('home/dashboard.dinner'), 'bar', array_values($dinner))
            ->color("rgb(132, 99, 255)")
            ->backgroundcolor("rgb(132, 99, 266)");
        return $chart;
    }

    /**
     * @param array $labels
     * @param \Illuminate\Support\Collection $dataset
     * @return array[]
     */
    private function CreateDatasets(array $labels, \Illuminate\Support\Collection $dataset): array
    {
        $Breakfast = [];
        $launch = [];
        $dinner = [];

        foreach ($labels as $label) {
            $Breakfast[$label] = $dataset->where('create_date', $label)
                ->sum('breakfast');
            $launch[$label] = $dataset->where('create_date', $label)
                ->sum('launch');
            $dinner[$label] = $dataset->where('create_date', $label)
                ->sum('dinner');
        }
        return array($Breakfast, $launch, $dinner);
    }
}
