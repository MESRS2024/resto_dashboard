<?php

namespace App\Http\Livewire;

use App\Traits\clients\WithClientsActions;
use App\Models\Dfm;
use Illuminate\Database\Eloquent\Builder;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Client;


class ClientsTable extends DataTableComponent
{
    use WithClientsActions;
    protected $model = Client::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function builder(): Builder
    {
        return Client::query()
            ->join('wallets',
                'clients.id', '=', 'wallets.holder_id')
            ->where('wallets.holder_type', Client::class)
            ->select('clients.*',  'wallets.balance');
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPaginationMethod('simple');
        $this->setFilterSlideDownDefaultStatusDisabled();

    }

    public function columns(): array
    {
        return [
            Column::make(__('models/clients.fields.type'), "type")
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.clients.type', [
                        'type' => $row->type,
                        'color'=> $row->type == 'Student' ? 'primary' :
                                                ($row->type == 'Worker' ? 'danger' :
                                                    ($row->type == 'Para_medical' ? 'warning' : 'info')
                                                )
                    ])
                )
                ->sortable()
                ->searchable(),
            Column::make(__('models/clients.fields.name'), "name")
                ->sortable()
                ->searchable(),
            Column::make(__('models/clients.fields.card'), "card")
                ->sortable()
                ->searchable(),
            Column::make(__('models/clients.fields.code'), "code")
                ->sortable()
                ->searchable(),
            Column::make(__('models/clients.ballance'), "wallet.balance")
                ->eagerLoadRelations()
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.clients.balance', [
                        'balance' => $row->wallet->balance / 100 ,
                        'color'=> $row->wallet->balance > 0 ? 'success' : 'danger'
                    ])
                )
                ->sortable()
                ->searchable(),
            Column::make(__('models/clients.fields.duplicate'), 'duplicate')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.clients.duplicate', [
                        'status' => $row->duplicate,
                        'successValue' => $row->duplicate===1,
                        'action'=>'switchDuplicate',
                        'recordId' => $row->id,
                    ])
                ),
            Column::make(__('models/clients.fields.active'), 'active')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.clients.duplicate', [
                        'status' => $row->active,
                        'successValue' => $row->active,
                        'action'=>'switchActive',
                        'recordId' => $row->id,
                    ])
                ),
            Column::make(__('crud.actions'), 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('clients.show', $row->id),
                        'editUrl' => route('clients.edit', $row->id),
                        'recordId' => $row->id,
                        'title' => $row->name,
                    ])
                )
        ];
    }
}
