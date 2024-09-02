<?php

namespace App\Models\Scopes\vendeur;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class vendeurScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     * this scope is used to filter the data by the user's code_dou when the authenticated user
     *  has a dou role
     */
    public function apply(Builder $builder, Model $model): void
    {
        if(auth()->user()->hasRole('dou'))
            $builder->whereHas('resto', function ($query) {
                $query->where('dou_code', auth()->user()->code_dou);
            });

        if(auth()->user()->hasRole('residence'))
            $builder->whereHas('resto', function ($query) {
                $query->where('id_progres', auth()->user()->residence_id);
            });

        if(auth()->user()->hasRole('dfm'))
            $builder->whereHas('resto', function ($query) {
                $query->where('dou_code', auth()->user()->code_dou);
            });
    }
}
