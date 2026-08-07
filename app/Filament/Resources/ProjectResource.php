<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages\ManageProjects;
use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use BackedEnum;
use UnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;
    protected static string|UnitEnum|null $navigationGroup = 'پروژه';
    protected static ?string $modelLabel = 'تابلو';
    protected static ?string $pluralModelLabel = 'تابلوها';
    protected static ?int $navigationSort = 21;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('member_id')
                    ->relationship('member', 'name_fa')
                    ->required(),
                TextInput::make('name_fa')
                    ->required(),
                TextInput::make('name_en')
                    ->required(),
                Select::make('technique_id')
                    ->relationship('technique', 'name_fa')
                    ->required(),
                Select::make('style_id')
                    ->relationship('style', 'name_fa')
                    ->required(),
                Select::make('subject_id')
                    ->relationship('subject', 'name_fa')
                    ->required(),
                TextInput::make('height')
                    ->required(),
                TextInput::make('width')
                    ->required(),
                TextInput::make('year')
                    ->required(),
                Textarea::make('member_description')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->columnSpanFull(),
                Textarea::make('about_project')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->required(),
                FileUpload::make('thumbnail')
                    ->image()
                    ->default('images/projects/thumbnails/default.png'),
                FileUpload::make('signature')
                    ->image(),
                TextInput::make('theme'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->disk('public'),
                TextColumn::make('member.name_fa')
                    ->searchable(),
                TextColumn::make('name_fa')
                    ->searchable(),
                TextColumn::make('name_en')
                    ->searchable(),
                TextColumn::make('technique.name_fa')
                    ->searchable(),
                TextColumn::make('style.name_fa')
                    ->searchable(),
                TextColumn::make('subject.name_fa')
                    ->searchable(),
                // ImageColumn::make('image')
                //     ->disk('public'),
                TextColumn::make('height')
                    ->searchable(),
                TextColumn::make('width')
                    ->searchable(),
                TextColumn::make('year')
                    ->searchable(),
                TextColumn::make('description')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('signature')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('theme')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('sells_count')
                    ->label('قیمت')
                    ->counts('sells')
                    ->url(fn ($record) => route('filament.dmy.resources.sells.index', [
                        'filters[project_id][value]' => $record->id
                    ]))
                    ->color('primary')
                    ->extraAttributes(['class' => 'underline hover:text-blue-600']),
            ])
            ->filters([
                SelectFilter::make('member_id')
                    ->label('کاربر')
                    ->relationship('member', 'name_fa')  // یا 'user_name'
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
            'index' => ManageProjects::route('/'),
        ];
    }
}
