<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

#[ScopedBy([Scopes\resto\restoScope::class])]
class Mealstats extends Model
{
    use HasFactory;

    protected $table = 'v_mealstats';

    public static function getMonthMealsStats($month):collection
    {
        $result = Mealstats::whereMonth('create_date', $month)
                            ->select('create_date',
                            DB::raw('sum(breakfast) as breakfast'),
                            DB::raw('sum(launch) as launch'),
                            DB::raw('sum(dinner) as dinner'))
                            ->groupBy('create_date')
                            ->get();
        return collect($result);
    }

}
