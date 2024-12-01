<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'package_count', 'type', 'unit', 'packages_documents_only'];
    public function items(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(PackageItem::class, 'modelable');
    }
}
