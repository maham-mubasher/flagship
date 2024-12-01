<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportQuote extends Model
{
    use HasFactory;

    protected $casts = [
        'pickup' => 'array',
        'delivery' => 'array',
    ];

    protected $fillable = [
        'user_id',
        'shipment_value',
        'package_count',
        'pickup',
        'delivery',
        'type',
        'unit'
    ];

    public function packageItems(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(PackageItem::class, 'modelable');
    }
}
