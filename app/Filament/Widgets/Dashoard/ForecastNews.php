<?php

namespace App\Filament\Widgets\Dashoard;

use App\Models\Forecast;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ForecastNews extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make("Today's Forecasts", Forecast::countTodayForecastsToday())
                ->icon('heroicon-o-truck')
                ->description(' Assign trucks to these forecasts')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('primary'),
            Stat::make('Forecast of this week', Forecast::countForecastsThisWeek())
                ->icon('heroicon-o-truck')
                ->description(Forecast::countForecastsThisWeek() . ' forecasts this week. Get trucks ready')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('primary'),
            Stat::make('Deliveries in progress', Forecast::countDeliveries())
                ->icon('heroicon-o-truck')
                ->description(Forecast::countDeliveries())
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('primary'),
        ];
    }
}
