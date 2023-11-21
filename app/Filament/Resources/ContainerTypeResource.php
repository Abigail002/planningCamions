<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContainerTypeResource\Pages;
use App\Filament\Resources\ContainerTypeResource\RelationManagers;
use App\Models\ContainerType;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContainerTypeResource extends Resource
{
    protected static ?string $model = ContainerType::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'About Containers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('length')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('height')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('subtype')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('length')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('height')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('subtype')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListContainerTypes::route('/'),
            'create' => Pages\CreateContainerType::route('/create'),
            'edit' => Pages\EditContainerType::route('/{record}/edit'),
        ];
    }
}
