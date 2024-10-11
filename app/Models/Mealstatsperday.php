<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


#[ScopedBy([Scopes\resto\restoScope::class])]
class Mealstatsperday extends Model
{
    use HasFactory;
    protected $table = 'v_mealstatperdays';


    public function scopeByMealsTodayDou($query, $date)
    {
        return $query->select('dou_code','meal_type_id',
                    DB::raw('sum(number_of_repas) as number'))
                    ->whereDate('created_at', '=', DATE($date));
                    //->groupBy(['dou_code','meal_type_id']);

    }

    public function scopeByMealsTodayOnou($query, $date)
    {
        return $query->select('meal_type_id',
            DB::raw('sum(number_of_repas) as number'))
            ->whereDate('created_at', '=', DATE($date));
            //->groupBy(['meal_type_id']);

    }

    public function scopeByMealsTodayResidence($query, $date)
    {
        return $query->select('id_progres','meal_type_id',
            DB::raw('sum(number_of_repas) as number'))
                 ->whereDate('created_at', '=', DATE($date))
                 ->groupBy(['id_progres','meal_type_id']);

    }

}
