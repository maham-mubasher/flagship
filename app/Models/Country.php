<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected static function booted()
    {
        self::addGlobalScope('active', function ($query) {

            $query->where('status', 1);
        });
    }

    public function provinces()
    {
        return $this->hasMany(Province::class);
    }
}
