<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentsAddress extends Model
{
    use HasFactory;
    protected $table = 'shipments_address';

    protected $fillable = [
        'shipment_id',
        'country_id',
        'province_id',
        'address',
        'address_type',
        'tracking_email',
        'company_name',
        'attention',
        'suite',
        'department',
        'postal_code',
        'city',
        'phone',
        'ext',
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }
}
