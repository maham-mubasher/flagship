<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'attention',
        'address',
        'suite',
        'department',
        'country_id',
        'postal_code',
        'city',
        'province',
        'is_residential_address',
        'phone',
        'ext',
        'tax_id',
        'shipping_account',
        'email',
    ];

    public function addressGroup(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AddressGroup::class);
    }
}
