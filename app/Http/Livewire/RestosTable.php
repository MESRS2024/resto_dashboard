<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Illuminate\Database\Eloquent\Builder;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Resto;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class RestosTable extends DataTableComponent
{
    protected $model = Resto::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        Resto::find($id)->delete();
        Flash::success(__('messages.deleted', ['model' => __('models/restos.singular')]));
        $this->emit('refreshDatatable');
    }

    public function builder(): Builder
    {
        return Resto::query()
            ->join('wallets',
                'restos.id', '=', 'wallets.holder_id')
            ->where('wallets.holder_type', Client::class)
            ->select('restos.*',  'wallets.balance');
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make(__('Models/restos.fields.dou_code'), "dou_code")
                ->sortable()
                ->searchable(),
            Column::make(__('Models/restos.fields.resto_type'), "resto_type")
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.resto.type', [
                        'type' => match ($row->resto_type) {
                            1 => 'Central',
                            2 => 'Residence',
                            3 => 'Integrated',
                            default => 'Other',
                        },
                        'color'=> match ($row->resto_type) {
                            1 => 'success',
                            2 => 'danger',
                            3 => 'warning',
                            default => 'info',
                        }
                    ])
                ),
            Column::make(__('Models/restos.fields.name'), "name")
                ->sortable()
                ->searchable(),
            Column::make(__('Models/restos.fields.code'), "code")
                ->sortable()
                ->searchable(),

            BooleanColumn::make(__('Models/restos.fields.is_active'), "is_active")
                ->setView('common.livewire-tables.resto.active'),
            BooleanColumn::make(__('Models/restos.fields.breakfast'), "breakfast")
                ->setView('common.livewire-tables.resto.active'),
            BooleanColumn::make(__('Models/restos.fields.lunch'), "lunch")
                ->setView('common.livewire-tables.resto.active'),
            BooleanColumn::make(__('Models/restos.fields.dinner'), "dinner")
                ->setView('common.livewire-tables.resto.active'),
            Column::make(__('crud.actions'), 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('restos.show', $row->id),
                        'editUrl' => route('restos.edit', $row->id),
                        'recordId' => $row->id,
                        'title' => $row->name,
                    ])
                )
        ];
    }
}
