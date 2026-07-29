<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Subjects\Pages\ManageSubjects;
use App\Filament\Resources\SubjectResource\Pages;
use App\Filament\Resources\SubjectResource\RelationManagers;
use App\Models\Subject;
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

class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleGroup;
    protected static string|UnitEnum|null $navigationGroup = 'پروژه';
    protected static ?string $modelLabel = 'موضوع';
    protected static ?string $pluralModelLabel = 'موضوع ها';
    protected static ?int $navigationSort = 23;

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
            'index' => ManageSubjects::route('/'),
        ];
    }
}
