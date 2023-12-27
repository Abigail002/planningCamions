<?php

namespace App\Filament\Resources\TruckResource\Pages;

use App\Filament\Resources\TruckResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords;

class ListTrucks extends ListRecords
{
    protected static string $resource = TruckResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'not_in_used' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Free')),
            'in_use' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'In use')),
            'garage' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'At the garage')),
        ];
    }
}
