<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContainerResource\Pages;
use App\Filament\Resources\ContainerResource\RelationManagers;
use App\Http\Controllers\UserController;
use App\Models\Container;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContainerResource extends Resource
{
    protected static ?string $model = Container::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'About Containers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Properties')
                    ->description('Container properties')
                    ->icon('heroicon-o-cube')
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
                Forms\Components\Section::make('Forecast')
                    ->description('Select the forecast associated')
                    ->icon('heroicon-m-shopping-bag')
                    ->schema([
                        Forms\Components\Select::make('forecast_id')
                            ->relationship('forecast', 'id')
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->required()->options(fn () => \App\Models\Forecast::pluck('BL', 'id')->mapWithKeys(function ($BL, $id) {
                                $forecast = \App\Models\Forecast::find($id);
                                return [$id => "{$forecast->operation} - {$forecast->customer->name} - {$BL}"];
                            })),
                    ]),
                Forms\Components\Section::make('Driver et truck')
                    ->description('Select the driver in charge of the delivery and the truck')
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('container_type_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('forecast.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('truck.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('trailer.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('loading_file_id')
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
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContainers::route('/'),
            'create' => Pages\CreateContainer::route('/create'),
            'edit' => Pages\EditContainer::route('/{record}/edit'),
        ];
    }
}
