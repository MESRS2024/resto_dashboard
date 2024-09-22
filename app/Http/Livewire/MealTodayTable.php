<?php

namespace App\Http\Livewire;


use App\Models\Mealstatsperday;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;


class MealTodayTable extends DataTableComponent
{
    protected $model = Mealstatsperday::class;


    public function configure(): void
    {
        $this->setPrimaryKey('id')
            // ->setPaginationDisabled()
            ->setEagerLoadAllRelationsEnabled();
    }


    public function columns(): array
    {
        return [
            Column::make(__('models/meals.fields.dou'), 'dou_code')
                ->sortable(),
            Column::make(__('models/meals.fields.resto_name'), 'resto_name')
                ->sortable(),
            Column::make(__('models/meals.fields.count'), 'number_of_repas')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.stats.all', [
                        'color' => 'primary',
                        'count' => $row->number_of_repas
                    ])
                ),
            Column::make(__('models/meals.fields.breakfast'), 'breakfast')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.stats.all', [
                        'color' =>'info',
                        'count' => $row->breakfast
                    ])
                ),
            Column::make(__('models/meals.fields.launch'), 'launch')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.stats.all', [
                        'color' => 'success',
                        'count' => $row->launch
                    ])
                ),
            Column::make(__('models/meals.fields.dinner'), 'dinner')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.stats.all', [
                        'color' => 'warning',
                        'count' => $row->dinner
                    ])
                ),
        ];
    }
}
