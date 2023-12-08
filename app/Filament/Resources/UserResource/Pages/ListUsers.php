<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Http\Controllers\UserController;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTabs(): array
    {
        $customQueryModifier = UserController::getDriversList();

        $tabs = [
            'All users' => Tab::make(),
            'Drivers' => Tab::make()
                ->modifyQueryUsing($customQueryModifier),
            'Free drivers' => Tab::make()
                ->modifyQueryUsing($customQueryModifier),
            'Busy drivers' => Tab::make()
                ->modifyQueryUsing($customQueryModifier),
        ];

        // Condition pour masquer les onglets pour les non-administrateurs
        if (Auth::user()->roles == 'CoordinationOfficer') {
            $users=['Drivers' => $tabs['Drivers']];
            return $users ;
        } else {
            return array_filter($tabs, function ($tab) {
                // Masquer l'onglet s'il n'a pas de conditions spécifiques
                return !isset($tab->conditions);
            });
        }
    }
}
