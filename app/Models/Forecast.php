<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Forecast extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'user_id',
        'operation',
        'BL',
        'vessel',
        'voyage',
        'ETA',
        'idTrakit',
        'forecastDate',
        'numbTruck',
        'loadDate',
        'loadPlace',
        'deliveryPlace',
        'status',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function containers(): HasMany
    {
        return $this->hasMany(Container::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function missions(): HasMany
    {
        return $this->hasMany(Mission::class);
    }
    public static function countTodayForecastsToday()
    {
        return self::whereDate('forecastDate', Carbon::today())->count();
    }
    public static function countDeliveries()
    {
        return self::whereDate('status', 'In progress')->count();
    }

    public static function countForecastsThisWeek()
    {
        $startOfWeek = Carbon::now()->startOfWeek(); // Début de la semaine en cours
        $endOfWeek = Carbon::now()->endOfWeek();     // Fin de la semaine en cours

        return self::whereBetween('forecastDate', [$startOfWeek, $endOfWeek])->count();
    }
}
