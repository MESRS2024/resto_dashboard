<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Flixy;

class FlixyTable extends DataTableComponent
{
    //protected $model = Flixy::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Flixy::byGroupeDateVendeur(auth()->user()->id_vendeur);
    }

    public function columns(): array
    {
        return [

            Column::make(__('models/vendeurs.fields.created_at'))
                ->label(
                    fn($row, Column $column) => $row->create_date
                )
                ->searchable(),

            Column::make( __('home/dashboard.count'))
                ->label(
                    fn($row, Column $column) => $row->count
                )
                ->sortable(),
            Column::make(__('home/dashboard.sum'))
                ->label(
                    fn($row, Column $column) => formatBalance($row->sum) . ' ' . __('home/dashboard.currency')
                )
                ->sortable(),
        ];
    }
}
