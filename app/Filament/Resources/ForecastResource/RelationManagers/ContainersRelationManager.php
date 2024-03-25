<?php

namespace App\Filament\Resources\ForecastResource\RelationManagers;

use App\Http\Controllers\UserController;
use App\Models\Container;
use App\Models\User;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Enums\FontFamily;
use Filament\Tables\Enums\ActionsPosition;
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
                    ->hidden(UserController::coordinationUsers(Auth::user()))
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
                    ->icon('heroicon-o-user')
                    ->hidden(!UserController::coordinationUsers(Auth::user()))
                    ->schema([
                        Forms\Components\Select::make('truck_id')
                            ->relationship('truck', 'number')
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->afterStateUpdated(function (string $operation, Container $container) {
                                if ($operation === "edit") {
                                    $container->status = 'Waiting for the driver';
                                }
                            })
                            ->default(null)
                            ->createOptionForm([
                                Forms\Components\TextInput::make('number')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Forms\Components\Select::make('trailer_id')
                            ->relationship('Trailer', 'number')
                            ->native(false)
                            ->default(null)
                            ->searchable()
                            ->preload()
                            ->afterStateUpdated(function (string $operation, Container $container) {
                                if ($operation === "edit") {
                                    $container->status = 'Waiting for the driver';
                                }
                            })
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
                            ->afterStateUpdated(function (string $operation, Container $container) {
                                if ($operation === "edit") {
                                    $container->status = 'Waiting for the driver';
                                }
                            })
                            ->searchable()
                            ->default(null)
                            ->preload()
                            ->options(fn () => UserController::getDriversListArray()),
                    ])->columns(3),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('number')
            ->columns([
                Tables\Columns\TextColumn::make('status')
                    ->numeric()
                    ->fontFamily(FontFamily::Mono)
                    ->color('primary')
                    ->sortable(),
                Tables\Columns\TextColumn::make('containerType.length')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('truck.number')
                    ->label('Tractor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('trailer.number')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Driver')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('weight')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('workOrder')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(function (Container $container) {
                        return $container->status !== 'Delivered';
                    }),
                ActionGroup::make([
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\Action::make('download loading file')
                        ->icon('heroicon-o-document-arrow-down')
                        ->url(fn (Container $container) => route('file.generate', $container->id))
                        ->openUrlInNewTab()
                        ->visible(fn (Container $container) => $container->loading_file_id !== null),
                ])
                    ->label('More actions')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->size(ActionSize::Small)
                    ->color('info')
                    ->button()
            ], position: ActionsPosition::BeforeCells)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
