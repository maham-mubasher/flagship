<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentsInsurance extends Model
{
    protected $table = 'shipments_insurance';

    protected $fillable = [
        'shipment_id',
        'value',
        'description',
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }
}
