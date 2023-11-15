<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContainerType extends Model
{
    use HasFactory;

    protected $fillable = [
        'length',
        'height',
        'subtype',
    ];

    public function containers(): HasMany
    {
        return $this->hasMany(Container::class);
    }
}
