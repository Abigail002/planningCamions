<?php

namespace App\Filament\Resources;

use Filament\Support\Enums\ActionSize;
use App\Filament\Resources\ContainerResource\Pages;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\UserController;
use App\Models\Container;
use App\Models\Trailer;
use App\Models\Truck;
use App\Models\User;
use Filament\Actions\Modal\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Filament\Facades\Filament;
use Filament\Forms\Components\Actions\Action as ActionsAction;
use Filament\Tables\Enums\ActionsPosition;
use Illuminate\Support\Facades\Redirect;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action as TablesActionsAction;
use Filament\Tables\Actions\ActionGroup;

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
                    ->hidden(UserController::coordinationUsers(Auth::user()))
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
                    ->hidden(UserController::coordinationUsers(Auth::user()))
                    ->icon('heroicon-m-shopping-bag')
                    ->schema([
                        Forms\Components\Select::make('forecast_id')
                            ->relationship('forecast', 'id')
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->required()
                            ->options(fn () => \App\Models\Forecast::pluck('BL', 'id')->mapWithKeys(function ($BL, $id) {
                                $forecast = \App\Models\Forecast::find($id);
                                return [$id => "{$forecast->operation} - {$forecast->customer->name} - {$BL}"];
                            })),
                    ]),
                Forms\Components\Section::make('Driver et truck')
                    ->description('Select the driver in charge of the delivery and the truck')
                    ->hidden(!UserController::coordinationUsers(Auth::user()))
                    ->icon('heroicon-o-user')
                    ->schema([
                        Forms\Components\Select::make('truck_id')
                            ->relationship('truck', 'number')
                            ->native(false)
                            ->options(fn () => \App\Models\Truck::pluck('id')->mapWithKeys(function ($id) {
                                $truck = \App\Models\Truck::find($id);
                                return [$id => "{$truck->number} - {$truck->status}"];
                            }))
                            ->searchable()
                            ->afterStateUpdated(function (string $operation, Container $container, Forms\Get $get) {
                                if ($operation === "edit") {
                                    $truck = Truck::where('id', $get('truck_id'))->get()->first();
                                    if ($truck) {
                                        $truck->status = 'In use';
                                    } else {
                                        // Gérez le cas où $truck est null (si nécessaire)
                                        echo "La variable \$truck est null.";
                                    }
                                    $truck->save();
                                }
                            })
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
                            ->afterStateUpdated(function (string $operation, Container $container, Forms\Get $get) {
                                if ($operation === "edit") {
                                    $trailer = Trailer::where('id', $get('trailer_id'))->get()->first();
                                    if ($trailer) {
                                        $trailer->status = 'In use';
                                    } else {
                                        // Gérez le cas où $trailer est null (si nécessaire)
                                        echo "La variable \$truck est null.";
                                    }
                                    $trailer->status = 'In use';
                                    $trailer->save();
                                }
                            })
                            ->searchable()
                            ->options(fn () => \App\Models\Trailer::pluck('id')->mapWithKeys(function ($id) {
                                $trailer = \App\Models\Trailer::find($id);
                                return [$id => "{$trailer->number} - {$trailer->length} - {$trailer->status}"];
                            }))
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
                            ->label("driver")
                            ->native(false)
                            ->afterStateUpdated(function (string $operation, Container $container, Forms\Get $get) {
                                if ($operation === "edit") {
                                    $container->status = 'Waiting for the driver';
                                    $user = User::where('id', $get('user_id'))->get()->first();
                                    $user->status = 'Busy';
                                    $user->save();
                                }
                            })
                            ->searchable()
                            ->preload()
                            ->options(fn () => UserController::getDriversListArray()),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pending' => 'danger',
                        'In progress' => 'info',
                        'Waiting for the driver' => 'info',
                        'Delivered' => 'success',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('containerType.length')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('forecast.BL')
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
<<<<<<< HEAD
                /* Tables\Columns\TextColumn::make('loading_file_id')
                    ->numeric()
                    ->sortable(), */
=======
>>>>>>> develop
                Tables\Columns\TextColumn::make('number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('weight')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('workOrder')
                    ->numeric()
                    ->sortable(),
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
<<<<<<< HEAD
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
=======
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
>>>>>>> develop
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
