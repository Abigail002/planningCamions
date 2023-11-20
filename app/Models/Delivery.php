<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'user_id',
        'operation',
        'BL',
        'vessel',
        'voyage',
        'ETA',
        'idTrakit',
        'forecastDate',
        'numbTruck',
        'loadDate',
        'loadPlace',
        'deliveryPlace',
        'containers',
    ];
}
