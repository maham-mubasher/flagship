<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentsPackageItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'length',
        'width',
        'height',
        'weight',
        'description',
    ];

    public function modelable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }
}
