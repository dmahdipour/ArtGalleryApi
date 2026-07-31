<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TechniqueResource\Pages\ManageTechniques;
use App\Filament\Resources\TechniqueResource\Pages;
use App\Filament\Resources\TechniqueResource\RelationManagers;
use App\Models\Technique;
use BackedEnum;
use UnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TechniqueResource extends Resource
{
    protected static ?string $model = Technique::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCubeTransparent;
    protected static string|UnitEnum|null $navigationGroup = 'پروژه';
    protected static ?string $modelLabel = 'تکنیک';
    protected static ?string $pluralModelLabel = 'تکنیک ها';
    protected static ?int $navigationSort = 24;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name_fa')
                    ->required(),
                TextInput::make('name_en')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('پروژه')
            ->columns([
                TextColumn::make('name_fa')
                    ->searchable(),
                TextColumn::make('name_en')
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
                //
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
            'index' => ManageTechniques::route('/'),
        ];
    }
}
