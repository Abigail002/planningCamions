<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrailerResource\Pages;
use App\Filament\Resources\TrailerResource\RelationManagers;
use App\Models\Trailer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrailerResource extends Resource
{
    protected static ?string $model = Trailer::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('length')
                    ->options([
                        "20'" => "20'",
                        "40'" => "40'",
                        'Dolly' => 'Dolly',
                    ])
                    ->required()
                    ->native(false)
                    ->preload()
                    ->default("20'"),
                Forms\Components\Select::make('status')
                    ->options([
                        'Not in use' => 'Not in use',
                        'In use' => 'In use',
                    ])
                    ->required()
                    ->native(false)
                    ->preload()
                    ->default('Not in use'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('length')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
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
            'index' => Pages\ListTrailers::route('/'),
            'create' => Pages\CreateTrailer::route('/create'),
            'edit' => Pages\EditTrailer::route('/{record}/edit'),
        ];
    }
}
