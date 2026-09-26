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
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
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
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


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
                Tabs::make('project-tabs')
                    ->tabs([
                        Tab::make('اطلاعات اصلی')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Hidden::make('member_id')
                                    ->default(fn () => Auth::id())
                                    ->required(),
                                FileUpload::make('image')
                                    ->label('تصویر')
                                    ->image()
                                    ->disk('public')
                                    ->directory('images/projects')
                                    ->imageEditor()
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('name_fa')
                                    ->label('نام فارسی اثر')
                                    ->required(),
                                TextInput::make('name_en')
                                    ->label('نام انگلیسی اثر')
                                    ->required(),
                                Select::make('technique_id')
                                    ->label('تکنیک')
                                    ->relationship('technique', 'name_fa')
                                    ->preload()
                                    ->searchable()
                                    ->required(),
                                Select::make('style_id')
                                    ->label('سبک')
                                    ->relationship('style', 'name_fa')
                                    ->preload()
                                    ->searchable()
                                    ->required(),
                                Select::make('subject_id')
                                    ->label('موضوع')
                                    ->relationship('subject', 'name_fa')
                                    ->preload()
                                    ->searchable()
                                    ->required(),
                                TextInput::make('year')
                                    ->label('سال')
                                    ->required(),
                                TextInput::make('height')
                                    ->label('طول')
                                    ->required(),
                                TextInput::make('width')
                                    ->label('عرض')
                                    ->required(),
                                Toggle::make('status')
                                    ->label('نمایش اثر')
                                    ->required(),
                            ])
                            ->columns(2),
                        Tab::make('تکمیلی')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Textarea::make('member_description')
                                    ->label('بیانیه ویا توصیف هنرمند از اثر')
                                    ->columnSpanFull(),
                                Textarea::make('description')
                                    ->label('توصیف یک سطری (زیر اسم انگلیسی هنرمند)')
                                    ->columnSpanFull(),
                                Textarea::make('about_project')
                                    ->label('در مورد موضوع اثر')
                                    ->columnSpanFull(),
                                FileUpload::make('signature')
                                    ->label('امضای خاص اثر')
                                    ->image()
                                    ->disk('public')
                                    ->directory('images/signatures'),
                                TextInput::make('theme')
                                    ->label('جمله حکیمانه'),
                            ])
                            ->columns(2),
                        Tab::make('فروش')
                            ->icon('heroicon-o-shopping-bag')
                            ->schema([
                                TextInput::make('price')
                                    ->label('قیمت')
                                    ->numeric(),
                                TextInput::make('location')
                                    ->label('محل'),
                                TextInput::make('address')
                                    ->label('آدرس'),
                                TextInput::make('phone')
                                    ->label('تلفن')
                                    ->tel(),
                                TextInput::make('sell_description')
                                    ->label('توضیحات فروش')
                                    ->columnSpanFull(),
                                Toggle::make('available')
                                    
                                    ->label('موجود'),
                            ])
                            ->columns(2),
                    ])
                    ->extraAttributes([
                        'class' => 'project-tabs',
                    ])
                    ->columnSpanFull(),
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
                TextColumn::make('height')
                    ->label('طول')
                    ->searchable(),
                TextColumn::make('width')
                    ->label('عرض')
                    ->searchable(),
                TextColumn::make('year')
                    ->label('سال')
                    ->searchable(),
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
            ])
            ->filters([
                SelectFilter::make('member_id')
                    ->label('کاربر')
                    // ->relationship('member', 'name_fa')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                EditAction::make()
                    ->after(function ($record) {
                        self::generateThumbnail($record);
                    }),

                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function generateThumbnail(Project $project): void
    {
        if (! $project->image) {
            return;
        }

        $disk = Storage::disk('public');

        $sourcePath = $disk->path($project->image);

        if (! is_file($sourcePath)) {
            return;
        }

        $manager = new ImageManager(
            new Driver()
        );

        $image = $manager->decodePath($sourcePath);

        $image->scale(
            width: (int) round($image->width() * 0.3),
        );

        $thumbnailPath = 'images/projects/thumbnails/' . basename($project->image);

        $disk->put(
            $thumbnailPath,
            $image->encode()
        );

        $project->updateQuietly([
            'thumbnail' => $thumbnailPath,
        ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $userInfo = Auth::user();
        if ($userInfo->hasRole(1)) {
            return parent::getEloquentQuery()->orderByDesc('created_at');
        }
        return parent::getEloquentQuery()->where('member_id', $userInfo->id)->orderByDesc('created_at');
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageProjects::route('/'),
        ];
    }
}
