<?php

namespace App\Filament\Resources\ForecastResource\Pages;

use App\Filament\Resources\ForecastResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class ListForecasts extends ListRecords
{
    protected static string $resource = ForecastResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'All Pending Forecasts' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Pending')),
            'Today Forecasts' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->whereDate('forecastDate', Carbon::today())),
            'This Week Forecasts' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->whereBetween('forecastDate', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])),
            'In process' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'In process')),
            'Delivered' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Delivered')),
        ];
    }
}
