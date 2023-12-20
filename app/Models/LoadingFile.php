<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LoadingFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'departCFS',
        'entreeGate3',
        'arriveeGate10',
        'passageGate10',
        'chargementTC1',
        'chargementTC2',
        'passageScanner',
        'resultatScanner',
        'sortieDouane',
        'sortieGate3',
        'arriveeClient',
        'debutDehargement',
        'finDechargement',
        'departClient',
        'arriveeGate3',
        'arriveeCFS',
    ];

    public function containers(): HasMany
    {
        return $this->hasMany(Container::class);
    }
}
