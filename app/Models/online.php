<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class online extends Model
{
    use HasFactory;

    protected $table = 'onlines';

    protected $guarded = ['id'];

    protected $fillable = ['resto_id', 'time_offline', 'time_online'];

    public function resto()
    {
        return $this->belongsTo(Resto::class);
    }

}
