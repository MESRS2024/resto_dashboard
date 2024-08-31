<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Vendeur;


class VendeursTable extends DataTableComponent
{
    //protected $model = Vendeur::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        Vendeur::find($id)->delete();
        Flash::success(__('messages.deleted', ['model' => __('models/vendeurs.singular')]));
        $this->emit('refreshDatatable');
    }

    public function builder(): Builder
    {
        return Vendeur::query()
                        ->join('restos',
                            'vendeurs.resto_id', '=', 'restos.id')
                        ->join('wallets',
                            'vendeurs.id', '=', 'wallets.holder_id')
                        ->where('wallets.holder_type', Vendeur::class)
                        ->select('vendeurs.*', 'restos.name as resto_name', 'wallets.balance');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Dou Code", "resto.dou_code")
                ->eagerLoadRelations()
                ->sortable()
                ->searchable(),
            Column::make("Resto Id", "resto.name")
                ->eagerLoadRelations()
                ->sortable()
                ->searchable(),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Ballance", "wallet.balance")
                ->eagerLoadRelations()
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.clients.balance', [
                        'balance' => $row->wallet->balance / 100 ,
                        'color'=> $row->wallet->balance > 0 ? 'success' : 'danger'
                    ])
                )
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('vendeurs.show', $row->id),
                        'editUrl' => route('vendeurs.edit', $row->id),
                        'recordId' => $row->id,
                        'title' => $row->name,
                    ])
                )
        ];
    }
}
