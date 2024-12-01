<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentsCod extends Model
{
    protected $table = 'shipments_cod';

    protected $fillable = [
        'shipment_id',
        'payment_method',
        'payable_to',
        'reciever_phone',
        'amount',
        'currency',
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }
}
