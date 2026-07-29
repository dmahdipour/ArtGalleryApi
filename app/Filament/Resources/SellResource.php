<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Sells\Pages\ManageSells;
use App\Filament\Resources\SellResource\Pages;
use App\Filament\Resources\SellResource\RelationManagers;
use App\Models\Sell;
use BackedEnum;
use UnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class SellResource extends Resource
{
    protected static ?string $model = Sell::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCurrencyDollar;
    protected static string|UnitEnum|null $navigationGroup = 'پروژه';
    protected static ?string $modelLabel = 'فروش';
    protected static ?string $pluralModelLabel = 'فروش ها';
    protected static ?int $navigationSort = 21;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('project_id')
                    ->relationship('project', 'name_fa')
                    ->required(),
                TextInput::make('price')
                    ->required(),
                TextInput::make('count')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('location'),
                TextInput::make('address'),
                TextInput::make('phone')
                    ->tel(),
                TextInput::make('description'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.name_fa')
                    ->searchable(),
                TextColumn::make('price')
                    ->searchable(),
                TextColumn::make('count')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('location')
                    ->searchable(),
                TextColumn::make('address')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('description')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('project_id')
                    ->label('پروژه')
                    ->relationship('project', 'name_fa')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageSells::route('/'),
        ];
    }
}
