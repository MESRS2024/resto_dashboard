<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Residences;

class ResidencesTable extends DataTableComponent
{
    protected $model = Residences::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        Residences::find($id)->delete();
        Flash::success(__('messages.deleted', ['model' => __('models/residences.singular')]));
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make(__('Models/residences.fields.code'), "code")
                ->sortable()
                ->searchable(),
            Column::make(__('Models/residences.fields.wilaya'), "wilaya")
                ->sortable()
                ->searchable(),
            Column::make(__('Models/residences.fields.id_residence'), "id_residence")
                ->sortable()
                ->searchable(),
            Column::make(__('Models/residences.fields.denomination_fr'), "denomination_fr")
                ->sortable()
                ->searchable(),
            Column::make(__('Models/residences.fields.denomination_ar'), "denomination_ar")
                ->sortable()
                ->searchable(),
            Column::make(__('Models/residences.fields.dou'), "dou")
                ->sortable()
                ->searchable(),
            Column::make(__('Models/residences.fields.type_residence'), "type_residence")
                ->sortable()
                ->searchable(),
            Column::make(__('crud.actions'), 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('residences.show', $row->id),
                        'editUrl' => route('residences.edit', $row->id),
                        'title' => $row->denomination_fr,
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
