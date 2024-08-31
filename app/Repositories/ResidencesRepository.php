<?php

namespace App\Repositories;

use App\Models\Residences;
use App\Repositories\BaseRepository;

class ResidencesRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'code',
        'wilaya',
        'id_residence',
        'denomination_fr',
        'denomination_ar',
        'dou',
        'type_residence'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Residences::class;
    }
}
