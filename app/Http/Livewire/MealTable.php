<?php

namespace App\Http\Livewire;

use App\Models\Mealstats;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;


class MealTable extends DataTableComponent
{
    protected $model = Mealstats::class;


    public function configure(): void
    {
        $this->setPrimaryKey('id')
            // ->setPaginationDisabled()
            ->setEagerLoadAllRelationsEnabled();
    }

    public function filters(): array

    {

        return [
            DateFilter::make('Verified From')
                ->filter(function (Builder $builder, string $value) {
                    $builder->whereDate('create_date', $value);
                }),

        ];

    }

    public function columns(): array
    {
        return [
            Column::make(__('models/meals.fields.create_date'), 'create_date')
                ->sortable(),
            Column::make(__('models/meals.fields.resto_name'), 'resto_name')
                ->sortable(),
            Column::make(__('models/meals.fields.count'), 'count')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.stats.all', [
                        'color' => 'primary',
                        'count' => $row->count
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
