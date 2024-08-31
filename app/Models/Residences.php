<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
class Residences extends Model
{
    use HasFactory;    public $table = 'residences';

    public $fillable = [
        'code',
        'wilaya',
        'id_residence',
        'denomination_fr',
        'denomination_ar',
        'dou',
        'type_residence'
    ];

    protected $casts = [
        'code' => 'string',
        'wilaya' => 'string',
        'denomination_fr' => 'string',
        'denomination_ar' => 'string',
        'dou' => 'string',
        'type_residence' => 'string'
    ];

    public static array $rules = [
        'code' => 'nullable|string|max:30',
        'wilaya' => 'nullable|string|max:255',
        'id_residence' => 'nullable',
        'denomination_fr' => 'nullable|string|max:250',
        'denomination_ar' => 'nullable|string|max:250',
        'dou' => 'nullable|string|max:250',
        'type_residence' => 'nullable|string|max:255'
    ];

    
}
