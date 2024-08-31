<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

#[ScopedBy([Scopes\resto\restoScope::class])]
class Mealstats extends Model
{
    use HasFactory;

    protected $table = 'V_mealstats';

    public static function getMonthMealsStats($month):collection
    {
        $result = Mealstats::whereMonth('create_date', $month)
                            ->select('breakfast','launch','dinner', 'create_date', 'count','resto_name')
                            ->get();
        return collect($result);
    }

}
