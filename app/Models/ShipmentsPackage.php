<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentsPackage extends Model
{
    use HasFactory;
    protected $fillable = ['package_count', 'type', 'unit'];
    public function items(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(ShipmentsPackageItem::class, 'modelable');
    }
}
