<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ForecastResource\Pages;
use App\Filament\Resources\ForecastResource\RelationManagers;
use App\Filament\Resources\ForecastResource\RelationManagers\ContainersRelationManager;
use App\Models\Forecast;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ForecastResource extends Resource
{
    protected static ?string $model = Forecast::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Author and Customer')
                    ->description('Just select the customer')
                    ->icon('heroicon-o-users')
                    ->schema([
                        Forms\Components\Select::make('customer_id')
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->required()
                            ->relationship('Customer', 'name')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('address')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Forms\Components\TextInput::make('user_name')
                            ->label("Responsible person")
                            ->default(Auth::user()->name)
                            ->readonly(),
                        Forms\Components\Hidden::make('user_id')
                            ->default(Auth::user()->id)
                            ->required(),
                    ])->columns(2),
                Forms\Components\Section::make('Properties')
                    ->description('Forecast properties')
                    ->icon('heroicon-o-cube')
                    ->schema([
                        Forms\Components\Select::make('operation')
                            ->options([
                                'Import' => 'Import',
                                'Export' => 'Export',
                                'Frigo' => 'Frigo',
                                'BLD' => 'BLD',
                            ])
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('BL')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('numbTruck')
                            ->label("Number of truck needed")
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('idTrakit')
                            ->required()
                            ->numeric(),
                    ])->columns(2),
                Forms\Components\Section::make('Shippement')
                    ->description('About the vessel')
                    ->icon('heroicon-o-banknotes')
                    ->schema([
                        Forms\Components\TextInput::make('vessel')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('voyage')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('ETA')
                            ->native(false)
                            ->required(),
                    ])->columns(3),
                Forms\Components\Section::make('Delivery')
                    ->icon('heroicon-o-cube')
                    ->schema([
                        Forms\Components\DatePicker::make('forecastDate')
                            ->native(false)
                            ->required(),
                        Forms\Components\DatePicker::make('loadDate')
                            ->native(false)
                            ->required(),
                        Forms\Components\Select::make('loadPlace')
                            ->options([
                                'LCT' => 'LCT',
                                'PAL' => 'PAL',
                            ])
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('deliveryPlace')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label("Responsible")
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('operation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('BL')
                    ->label("BL")
                    ->searchable(),
                Tables\Columns\TextColumn::make('vessel')
                    ->searchable(),
                Tables\Columns\TextColumn::make('voyage')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ETA')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('idTrakit')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('forecastDate')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('numbTruck')
                    ->label("Number of truck")
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('loadDate')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('loadPlace')
                    ->sortable(),
                Tables\Columns\TextColumn::make('deliveryPlace')
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ], position: ActionsPosition::BeforeCells)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ContainersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForecasts::route('/'),
            'create' => Pages\CreateForecast::route('/create'),
            'edit' => Pages\EditForecast::route('/{record}/edit'),
        ];
    }
}
