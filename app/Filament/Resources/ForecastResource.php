<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ForecastResource\Pages;
use App\Filament\Resources\ForecastResource\RelationManagers;
use App\Models\Forecast;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ForecastResource extends Resource
{
    protected static ?string $model = Forecast::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('operation')
                    ->options([
                        'Import' => 'Import',
                        'Export' => 'Export',
                        'Fridge' => 'Fridge',
                        'BLD' => 'BLD',
                    ])
                    ->native(false)
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('BL')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('vessel')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('voyage')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('ETA')
                    ->required(),
                Forms\Components\TextInput::make('idTrakit')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('forecastDate')
                    ->required(),
                Forms\Components\TextInput::make('numbTruck')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('loadDate')
                    ->required(),
                Forms\Components\DatePicker::make('loadPlace')
                    ->required(),
                Forms\Components\TextInput::make('deliveryPlace')
                    ->required()
                    ->maxLength(255),
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
                    ->label('Created by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('operation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('BL')
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
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('loadDate')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('loadPlace')
                    ->date()
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
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListForecasts::route('/'),
            'create' => Pages\CreateForecast::route('/create'),
            'edit' => Pages\EditForecast::route('/{record}/edit'),
        ];
    }
}
