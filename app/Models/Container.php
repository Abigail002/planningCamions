<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Container extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'container_type_id',
        'forecast_id',
        'truck_id',
        'trailer_id',
        'user_id',
        'weight',
        'workOrder',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(ContainerType::class);
    }
    public function forecast(): BelongsTo
    {
        return $this->belongsTo(Forecast::class);
    }
    public function truck(): BelongsTo
    {
        return $this->belongsTo(Truck::class);
    }
    public function trailer(): BelongsTo
    {
        return $this->belongsTo(Trailer::class);
    }
    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
