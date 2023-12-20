<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'user_id',
        'description',
        'truck',
        'trailer',
        'first_container_id',
        'second_container_id'
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
