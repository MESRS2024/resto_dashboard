<?php

namespace App\Traits\Clients;

use App\Models\Client;
use Flash;

trait WithClientsActions
{
    public function deleteRecord($id)
    {
        Client::find($id)->delete();
        Flash::success(__('messages.deleted', ['model' => __('models/clients.singular')]));
        $this->emit('refreshDatatable');
    }

    public function switchActive($id)
    {
        $client = Client::find($id);
        $client->active = !$client->active;
        $client->save();
        Flash::success(__('messages.updated', ['model' => __('models/clients.singular')]));
        $this->emit('refreshDatatable');
    }

    public function switchDuplicate($id)
    {
        $client = Client::find($id);
        $client->duplicate = !$client->duplicate;
        $client->save();
        Flash::success(__('messages.updated', ['model' => __('models/clients.singular')]));
        $this->emit('refreshDatatable');
    }
}
