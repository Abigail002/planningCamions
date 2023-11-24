<?php

namespace App\Filament\Resources\ContainerTypeResource\Pages;

use App\Filament\Resources\ContainerTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContainerType extends EditRecord
{
    protected static string $resource = ContainerTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
