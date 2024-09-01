<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\MealType;

class MealTypesTable extends DataTableComponent
{
    protected $model = MealType::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        MealType::find($id)->delete();
        Flash::success(__('messages.deleted', ['model' => __('models/mealTypes.singular')]));
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make(__('models/mealTypes.fields.name'), "name")
                ->sortable()
                ->searchable(),
            Column::make(__('models/mealTypes.fields.code'), "code")
                ->sortable()
                ->searchable(),
            Column::make(__('models/mealTypes.fields.start'), "start")
                ->sortable()
                ->searchable(),
            Column::make(__('models/mealTypes.fields.end'), "end")
                ->sortable()
                ->searchable(),
            Column::make(__('crud.actions'), 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('meal-types.show', $row->id),
                        'editUrl' => route('meal-types.edit', $row->id),
                        'recordId' => $row->id,
                        'title' => $row->name,
                    ])
                )
        ];
    }
}
