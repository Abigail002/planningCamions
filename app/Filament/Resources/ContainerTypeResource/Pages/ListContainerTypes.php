<?php

namespace App\Filament\Resources\ContainerTypeResource\Pages;

use App\Filament\Resources\ContainerTypeResource;
use Filament\Actions;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListContainerTypes extends ListRecords
{
    protected static string $resource = ContainerTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

/*     public function getTabs(): array
    {
        return [
            'All' => Tab::make('All Container types'),
            '20' => Tab::make("20' Containers")
                ->modifyQueryUsing(fn (Builder $query) => $query->where('length', "20'")),
        ];
    }
 */}
