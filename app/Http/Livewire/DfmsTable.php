<?php

namespace App\Http\Livewire;

use App\Models\Vendeur;
use Illuminate\Database\Eloquent\Builder;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Dfm;

class DfmsTable extends DataTableComponent
{
    protected $model = Dfm::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        Dfm::find($id)->delete();
        Flash::success(__('messages.deleted', ['model' => __('models/dfms.singular')]));
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Dfm::query()
            ->join('wallets',
                'dfms.id', '=', 'wallets.holder_id')
            ->where('wallets.holder_type', Dfm::class)
            ->select('dfms.*',  'wallets.balance');
    }
    public function columns(): array
    {
        return [
            Column::make(__('models/dfms.fields.dou_code'), "dou_code")
                ->sortable()
                ->searchable(),
            Column::make(__('models/dfms.fields.name'), "name")
                ->sortable()
                ->searchable(),
            Column::make(__('models/dfms.fields.code'), "code")
                ->sortable()
                ->searchable(),
            Column::make(__('app.balance'), "wallet.balance")
                ->eagerLoadRelations()
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.clients.balance', [
                        'balance' => $row->wallet->balance / 100 ,
                        'color'=> $row->wallet->balance > 0 ? 'success' : 'danger'
                    ])
                )
                ->sortable()
                ->searchable(),

            Column::make(__('crud.actions'), 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('dfms.show', $row->id),
                        'editUrl' => route('dfms.edit', $row->id),
                        'recordId' => $row->id,
                        'title' => $row->name,
                    ])
                )
        ];
    }
}
