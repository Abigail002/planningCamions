<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Forecast extends Model
{
    use HasFactory;

    protected $fillable = [
        'operation',
        'BL',
        'consignee',
        'vessel',
        'voyage',
        'ETA',
        'idTrakit',
        'forecastDate',
        'numbTruck',
        'loadDate',
        'loadPlace',
        'deliveryPlace',
        'state',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function deliveries(): HasMany
    {
        return $this->hasMany(Delivery::class);
    }
}
