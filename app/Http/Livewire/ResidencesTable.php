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
            Column::make("Code", "code")
                ->sortable()
                ->searchable(),
            Column::make("Wilaya", "wilaya")
                ->sortable()
                ->searchable(),
            Column::make("Id Residence", "id_residence")
                ->sortable()
                ->searchable(),
            Column::make("Denomination Fr", "denomination_fr")
                ->sortable()
                ->searchable(),
            Column::make("Denomination Ar", "denomination_ar")
                ->sortable()
                ->searchable(),
            Column::make("Dou", "dou")
                ->sortable()
                ->searchable(),
            Column::make("Type Residence", "type_residence")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
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
