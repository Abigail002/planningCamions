<?php

namespace App\Filament\Resources\ContainerResource\Pages;

use App\Filament\Resources\ContainerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListContainers extends ListRecords
{
    protected static string $resource = ContainerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs() : array{
        return['all' => Tab::make(),
        'Pending' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Pending')),
        'Waiting for the driver' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Waiting for the driver')),
        'In progress' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'In progress')),
        'Delivered' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Delivered')),];
    }
}
