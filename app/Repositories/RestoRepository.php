<?php

namespace App\Repositories;

use App\Models\Resto;
use App\Repositories\BaseRepository;

class RestoRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'code',
        'password',
        'is_active',
        'breakfast',
        'lunch',
        'dinner',
        'b_start',
        'b_end',
        'l_start',
        'l_end',
        'd_start',
        'd_end',
        'dou_code',
        'resto_type',
        'id_progres'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Resto::class;
    }
}
