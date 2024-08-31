<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\BaseRepository;

class ClientsRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'resto_id',
        'type',
        'name',
        'card',
        'code',
        'duplicate',
        'progres_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Client::class;
    }
}
