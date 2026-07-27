<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisitResource\Pages;
use App\Filament\Resources\VisitResource\RelationManagers;
use App\Models\Visit;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Schemas\Schema; 

class VisitResource extends Resource
{
    protected static ?string $model = Visit::class;
    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-presentation-chart-line';
    }
    public static function getNavigationGroup(): ?string
    {
        return 'آمار';
    }
    protected static ?string $modelLabel = 'بازدید';
    protected static ?string $pluralModelLabel = 'بازدیدها';


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('ip_address')
                    ->required()
                    ->maxLength(255),
                TextInput::make('url')
                    ->required()
                    ->maxLength(255),
                TextInput::make('parameters')
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('user_id')
                    ->numeric()
                    ->default(null),
                Textarea::make('user_agent')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ip_address')
                    ->searchable(),
                TextColumn::make('url')
                    ->searchable(),
                TextColumn::make('browser')
                    ->searchable(),
                TextColumn::make('platform')
                    ->searchable(),
                TextColumn::make('device')
                    ->searchable(),
                TextColumn::make('user')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->jalaliDate()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageVisits::route('/'),
        ];
    }
}
