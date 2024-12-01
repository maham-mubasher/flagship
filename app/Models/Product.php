<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'hs_code',
        'weight',
        'reference',
        'unit_price',
        'country_id',
        'measurement_unit_id',
        'unit_id',
    ];
}
