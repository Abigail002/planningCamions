<?php

namespace App\Filament\Widgets\Dashoard;

use App\Http\Controllers\UserController;
use App\Models\Trailer;
use App\Models\Truck;
use App\Models\User;
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
            Stat::make('Drivers', function () {
                $driversCount = User::where(UserController::getDriversList())->count();
                return $driversCount;
            })
                ->icon('heroicon-o-truck')
                ->description(UserController::getDriversFreeList()->count() . ' driver(s) not in charge of delivery')
                ->descriptionIcon('heroicon-m-hand-thumb-up')
                ->color('primary'),
        ];
    }
}
