<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    protected $table = 'shipments';

    protected $fillable = [
        'user_id',
        'country_id',
        'shipment_date',
        'reference',
        'driver_instructions',
        'signature_required',
        'saturday_delivery',
        'payment_payer',
        'payment_account_number',
        'is_schedule_pickup',
        'is_cod',
        'is_insurance',
        'is_qoute',
        'confirmation_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addresses()
    {
        return $this->hasMany(ShipmentsAddress::class, 'shipment_id');
    }

    public function cod()
    {
        return $this->hasOne(ShipmentsCod::class, 'shipment_id');
    }

    public function insurance()
    {
        return $this->hasOne(ShipmentsInsurance::class, 'shipment_id');
    }
    public function courier()
    {
        return $this->hasOne(ShipmentsCouriers::class, 'shipment_id');
    }

    public function pickupInfo()
    {
        return $this->hasOne(ShipmentsPickupInfo::class, 'shipment_id');
    }

    public function packages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ShipmentsPackage::class, 'shipment_id');
    }
}
