<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSupply extends Model
{
    use HasFactory;

    protected $casts = [
        'ups' => 'array',
        'dhl' => 'array',
        'fedex' => 'array',
        'purolator' => 'array',
        'gls' => 'array',
        'nationex' => 'array',
        'to' => 'array'
    ];
    protected $fillable = [
        'user_id',
        'ups',
        'dhl',
        'fedex',
        'purolator',
        'gls',
        'nationex',
        'to'
    ];
}
