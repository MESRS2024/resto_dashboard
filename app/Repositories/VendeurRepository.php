<?php

namespace App\Repositories;

use App\Models\Vendeur;
use App\Repositories\BaseRepository;

class VendeurRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'resto_id',
        'name',
        'phone',
        'password',
        'device_id',
        'photo',
        'ban'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Vendeur::class;
    }
}
