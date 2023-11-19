<?php

namespace App\Filament\Resources\ForecastResource\Pages;

use App\Filament\Resources\ForecastResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListForecasts extends ListRecords
{
    protected static string $resource = ForecastResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}