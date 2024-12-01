<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    use HasFactory;
    
    public $timestamps = true;

    protected $table = 'pickups';

    protected $fillable = [
        'user_id',
        'company_name', 
        'sender_name', 
        'country_id', 
        'province_id', 
        'address', 
        'suite', 
        'postal_code', 
        'city', 
        'phone', 
        'ext', 
        'courier_name', 
        'package_count', 
        'unit', 
        'weight', 
        'to_country_id', 
        'pickup_date', 
        'time_from', 
        'time_until', 
        'pickup_location', 
        'pickup_instruction', 
        'is_ground',
        'confirmation_number'
    ];

    
}
