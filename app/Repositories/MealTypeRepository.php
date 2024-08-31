<?php

namespace App\Repositories;

use App\Models\MealType;
use App\Repositories\BaseRepository;

class MealTypeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'code',
        'start',
        'end'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return MealType::class;
    }
}
