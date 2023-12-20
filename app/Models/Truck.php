<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Truck extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'status',
    ];

    public function containers(): HasMany
    {
        return $this->hasMany(Container::class);
    }
    public static function countTractorsNotInUse()
    {
        return Truck::where('status', 'Not in use')->count();
    }
}
