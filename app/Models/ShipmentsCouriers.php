<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentsCouriers extends Model
{
    protected $table = 'shipments_courier';

    protected $fillable = [
        'shipment_id',
        'courier_name',
        'service_name',
        'total',
        'details'
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }
}
