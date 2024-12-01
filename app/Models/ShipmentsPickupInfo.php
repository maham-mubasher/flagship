<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentsPickupInfo extends Model
{
    protected $table = 'shipments_pickup_info';

    protected $fillable = [
        'shipment_id',
        'time_from',
        'time_until',
        'pickup_location',
        'pickup_instruction',
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }
}
