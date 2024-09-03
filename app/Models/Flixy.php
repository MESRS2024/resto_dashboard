<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Flixy extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $guarded=[];
    public function resto()
    {
        return $this->belongsTo(Resto::class , 'resto_id', 'id');
    }

    public function vendeur()
    {
        return $this->belongsTo(Vendeur::class , 'vendeur_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class , 'client_id', 'id');
    }

    public function scopeByVendeur($query, $vendeur)
    {
        return $query->where('vendeur_id', $vendeur);
    }

    public function scopeByDate($query, $date)
    {
        return $query->whereDate('created_at', '=', DATE($date));
    }

    public function scopeByVendeurPerDou($query, $dou_code, $column)
    {
        return $query->whereIn($column, Resto::select('id')->where('dou_code', $dou_code));
    }

    public function scopeByGroupeDate($query, $dou_code){
        return $query->select(DB::raw('DATE(flixies.created_at) as create_date'),
                                'flixies.resto_id',
                                'vendeur_id',
                                'vendeurs.name',
                                'restos.name as resto',
                                DB::raw('count(*) as count'),
                                DB::raw('sum(amount)/100 as sum'),
                                )
                     ->join('vendeurs', 'vendeurs.id', '=', 'flixies.vendeur_id')
                     ->join('restos', 'restos.id', '=', 'vendeurs.resto_id')
                     ->whereNull('vendeurs.deleted_at')
                     ->byVendeurPerDou($dou_code, 'flixies.resto_id')
                     ->groupBy(['vendeur_id','flixies.resto_id','create_date','vendeurs.name','restos.name']);

    }


    public function scopeByGroupeDateVendeur($query, $vendor_id){
        return $query->select(DB::raw('DATE(flixies.created_at) as create_date'),

                                'vendeur_id',


                                DB::raw('count(*) as count'),
                                DB::raw('sum(amount)/100 as sum'),
                                )
                     ->join('vendeurs', 'vendeurs.id', '=', 'flixies.vendeur_id')
                     ->join('restos', 'restos.id', '=', 'vendeurs.resto_id')
                     ->whereNull('vendeurs.deleted_at')
                     ->byVendeur($vendor_id)
                     ->groupBy(['vendeur_id','create_date'])
            ->orderBy('create_date', 'desc');

    }
}
