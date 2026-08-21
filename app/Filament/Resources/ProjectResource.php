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
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;


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
                Hidden::make('member_id')
                    ->required(),
                TextInput::make('name_fa')
                    ->label('نام فارسی اثر')
                    ->required(),
                TextInput::make('name_en')
                    ->label('نام انگلیسی اثر')
                    ->required(),
                Select::make('technique_id')
                    ->label('تکنیک')
                    ->relationship('technique', 'name_fa')
                    ->required(),
                Select::make('style_id')
                    ->label('سبک')
                    ->relationship('style', 'name_fa')
                    ->required(),
                Select::make('subject_id')
                    ->label('موضوع')
                    ->relationship('subject', 'name_fa')
                    ->required(),
                TextInput::make('height')
                    ->label('طول')
                    ->required(),
                TextInput::make('width')
                    ->label('عرض')
                    ->required(),
                TextInput::make('year')
                    ->label('سال')
                    ->required(),
                Textarea::make('member_description')
                    ->label('توصیف هنرمند در مورد اثر')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('توضیح یک سطری')
                    ->columnSpanFull(),
                Textarea::make('about_project')
                    ->label('در مورد موضوع اثر')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('تصویر')
                    ->image()
                    ->disk('public')
                    ->directory('images/projects')
                    ->imageEditor()
                    ->required(),
                FileUpload::make('thumbnail')
                    ->label('تصویر کوچک')
                    ->image()
                    ->disk('public')
                    ->directory('images/projects/thumbnails')
                    ->imageEditor()
                    ->default('images/projects/thumbnails/default.png'),
                FileUpload::make('signature')
                    ->label('امضای خاص اثر')
                    ->image()
                    ->disk('public')
                    ->directory('images/signatures'),
                TextInput::make('theme')
                    ->label('جمله حکیمانه'),
                Toggle::make('status')
                    ->label('نمایش اثر')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('تصویر')
                    ->disk('public'),
                TextColumn::make('member.name_fa')
                    ->label('نام فارسی هنرمند')
                    ->searchable(),
                TextColumn::make('name_fa')
                    ->label('نام فارسی اثر')
                    ->searchable(),
                TextColumn::make('name_en')
                    ->label('نام انگلیسی اثر')
                    ->searchable(),
                TextColumn::make('technique.name_fa')
                    ->label('تکنیک')
                    ->searchable(),
                TextColumn::make('style.name_fa')
                    ->label('سبک')
                    ->searchable(),
                TextColumn::make('subject.name_fa')
                    ->label('موضوع')
                    ->searchable(),
                // ImageColumn::make('image')
                //     ->disk('public'),
                TextColumn::make('height')
                    ->label('طول')
                    ->searchable(),
                TextColumn::make('width')
                    ->label('عرض')
                    ->searchable(),
                TextColumn::make('year')
                    ->label('سال')
                    ->searchable(),
                IconColumn::make('status')
                    ->label('نمایش')
                    ->boolean(),
                TextColumn::make('description')
                    ->label('توضیح یک سطری')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('signature')
                    ->label('امضای خاص اثر')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('theme')
                    ->label('جمله حکیمانه')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('sell_count')
                    ->label('قیمت')
                    ->counts('sell')
                    ->url(fn ($record) => route('filament.dmy.resources.sells.index', [
                        'filters[project_id][value]' => $record->id
                    ]))
                    ->color('primary')
                    ->extraAttributes(['class' => 'underline hover:text-blue-600']),
            ])
            ->filters([
                SelectFilter::make('member_id')
                    ->label('کاربر')
                    // ->relationship('member', 'name_fa')
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

    public static function getEloquentQuery(): Builder
    {
        $userInfo = Auth::user();
        if ($userInfo->hasRole(1)) {
            return parent::getEloquentQuery();
        }
        return parent::getEloquentQuery()->where('member_id', $userInfo->id);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageProjects::route('/'),
        ];
    }
}
