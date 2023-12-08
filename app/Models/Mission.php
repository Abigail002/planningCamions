<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'forecast_id',
        'TC1',
        'TC2',
        'user_id',
        'description',
        'truck',
        'trailer',
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function forecast(): BelongsTo
    {
        return $this->belongsTo(Forecast::class);
    }
}
