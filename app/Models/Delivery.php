<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mockery\Matcher\Contains;

class Delivery extends Model
{
    use HasFactory;

    public function forecasts(): BelongsTo
    {
        return $this->belongsTo(Forecast::class);
    }

    public function containers(): BelongsTo
    {
        return $this->belongsTo(Container::class);
    }

    public function trucks(): BelongsTo
    {
        return $this->belongsTo(Truck::class);
    }

    public function trailers(): BelongsTo
    {
        return $this->belongsTo(Trailer::class);
    }
}
