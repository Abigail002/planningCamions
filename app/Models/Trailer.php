<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trailer extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'length',
        'status',
    ];

    public function containers(): HasMany
    {
        return $this->hasMany(Container::class);
    }

    public static function countTrailersNotInUse()
    {
        return Trailer::where('status', 'Not in use')->count();
    }
}
