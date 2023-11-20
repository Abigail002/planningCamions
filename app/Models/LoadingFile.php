<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoadingFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'departCFS',
        'entreeGate3',
        'arriveeGate10',
        'passageGate10',
        'chargementTC',
        'passageScanner',
        'resultatScanner',
        'sortieDouane',
        'sortieGate3',
        'arriveeClient',
        'debutDehargement',
        'finDechargement',
        'departClient',
        'arriveeGate3',
        'arriveeCFS'
    ];
}
