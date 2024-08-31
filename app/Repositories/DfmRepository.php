<?php

namespace App\Repositories;

use App\Models\Dfm;
use App\Repositories\BaseRepository;

class DfmRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'dou_code',
        'name',
        'code',
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
        return Dfm::class;
    }
}
