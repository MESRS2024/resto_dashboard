<?php

namespace App\Models\Scopes\resto;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class restoScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     * @param Builder $builder
     * @param Model $model
     * @return void
     * this scope is used to filter the data by the user's code_dou when the authenticated user
     * has a dou role
     */
    public function apply(Builder $builder, Model $model): void
    {
        if (auth()->user()->hasRole('dou'))
            $builder->where('dou_code', auth()->user()->code_dou);

        if (auth()->user()->hasRole('residence'))
            $builder->where('id_progres', auth()->user()->residence_id);

        if (auth()->user()->hasRole('dfm'))
            $builder->where('dou_code', auth()->user()->code_dou);


    }
}
