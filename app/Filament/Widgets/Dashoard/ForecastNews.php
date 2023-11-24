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
            Stat::make('Today Forecasts', Forecast::countTodayForecastsToday())
                ->icon('heroicon-o-truck')
                ->description(' Assign trucks to these forecasts')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('primary'),
            Stat::make('Forecasts', Forecast::countForecastsThisWeek())
                ->icon('heroicon-o-truck')
                ->description(Forecast::countForecastsThisWeek() . ' forecasts this week. Get trucks ready')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('primary'),

        ];
    }
}