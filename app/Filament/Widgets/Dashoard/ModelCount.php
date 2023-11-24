<?php

namespace App\Filament\Widgets\Dashoard;

use App\Models\Trailer;
use App\Models\Truck;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ModelCount extends BaseWidget
{
    protected static ?int $sort = 0;
    protected function getStats(): array
    {
        return [
            Stat::make('Tractors', Truck::all()->count())
                ->icon('heroicon-o-truck')
                ->description(Truck::countTractorsNotInUse() . ' tractor(s) not in use')
                ->descriptionIcon('heroicon-m-hand-thumb-up')
                ->color('primary'),
            Stat::make('Trailers', Trailer::all()->count())
                ->icon('heroicon-o-truck')
                ->description(Trailer::countTrailersNotInUse() . ' trailer(s) not in use')
                ->descriptionIcon('heroicon-m-hand-thumb-up')
                ->color('primary'),
        ];
    }
}
