<?php

namespace App\Http\Livewire;

use App\Models\Mealstats;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

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
            Column::make('Date', 'create_date')
                ->sortable(),
            Column::make('Resto name', 'resto_name')
                ->sortable(),
            Column::make('Number of meals', 'count')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.stats.all', [
                        'color' => 'primary',
                        'count' => $row->count
                    ])
                ),
            Column::make('Number of meals Breakfast', 'breakfast')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.stats.all', [
                        'color' =>'info',
                        'count' => $row->breakfast
                    ])
                ),
            Column::make('Number of meals launch', 'launch')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.stats.all', [
                        'color' => 'success',
                        'count' => $row->launch
                    ])
                ),
            Column::make('Number of meals dinner', 'dinner')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.stats.all', [
                        'color' => 'warning',
                        'count' => $row->dinner
                    ])
                ),
        ];
    }
}
