<?php

namespace App\Filament\Resources\ForecastResource\RelationManagers;

use App\Http\Controllers\UserController;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ContainersRelationManager extends RelationManager
{
    protected static string $relationship = 'containers';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Properties')
                    ->description('Container properties')
                    ->icon('heroicon-o-cube')
                    //->hidden(!auth()->user()->is_CoordinationOfficer)
                    ->hidden(fn (User $user) => $user->role !== 'CoordinationOfficer')
                    ->schema([
                        Forms\Components\TextInput::make('number')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('weight')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('workOrder')
                            ->required()
                            ->numeric(),
                        Forms\Components\Select::make('container_type_id')
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->required()
                            ->options(fn () => \App\Models\ContainerType::pluck('length', 'id')->mapWithKeys(function ($length, $id) {
                                $container = \App\Models\ContainerType::find($id);
                                return [$id => "{$length} - {$container->height} - {$container->subtype}"];
                            }))
                            ->createOptionForm([
                                Forms\Components\TextInput::make('length')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('height')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('subtype')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                    ])->columns(2),
                Forms\Components\Section::make('Driver et truck')
                    ->description('Select the driver in charge of the delivery and the truck')
                    ->hidden(fn (User $user) => $user->role == 'CoordinationOfficer')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Forms\Components\Select::make('truck_id')
                            ->relationship('truck', 'number')
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('number')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Forms\Components\Select::make('trailer_id')
                            ->relationship('Trailer', 'number')
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('number')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('length')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Forms\Components\Select::make('user_id')
                            ->label('Driver')
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->options(fn () => UserController::getDriversList()),
                    ])->columns(3),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('number')
            ->columns([
                Tables\Columns\TextColumn::make('number'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
