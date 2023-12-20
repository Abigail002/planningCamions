<?php

namespace App\Filament\Resources\TrailerResource\Pages;

use App\Filament\Resources\TrailerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;


class ListTrailers extends ListRecords
{
    protected static string $resource = TrailerResource::class;

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
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Not in use')),
            'in_use' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'In use')),
        ];
    }
}
