<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoryResource\Pages\ManageStories;
use App\Models\Member;
use App\Models\Story;
use BackedEnum;
use UnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StoryResource extends Resource
{
    protected static ?string $model = Story::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPlayCircle;
    protected static string|UnitEnum|null $navigationGroup = 'پروژه';
    protected static ?string $modelLabel = 'استوری';
    protected static ?string $pluralModelLabel = 'استوری‌ها';
    protected static ?int $navigationSort = 22;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('محتوای استوری')
                ->schema([
                    Hidden::make('member_id')
                        ->default(fn () => Auth::user()?->member?->getKey())
                        ->required(),
                    FileUpload::make('media_path')
                        ->label('عکس یا ویدئو')
                        ->disk('public')
                        ->directory('images/stories')
                        ->acceptedFileTypes([
                            'image/jpeg',
                            'image/png',
                            'image/webp',
                            'image/gif',
                            'video/mp4',
                            'video/webm',
                            'video/quicktime',
                        ])
                        ->maxSize(51200)
                        ->required()
                        ->columnSpanFull()
                        ->helperText('فرمت‌های عکس و ویدئو؛ حداکثر حجم ۵۰ مگابایت.'),
                    Select::make('media_type')
                        ->label('نوع فایل')
                        ->options([
                            'image' => 'تصویر',
                            'video' => 'ویدئو',
                        ])
                        ->required(),
                    Textarea::make('caption')
                        ->label('توضیح کوتاه')
                        ->maxLength(500)
                        ->rows(2)
                        ->columnSpanFull(),
                    Toggle::make('is_active')
                        ->label('نمایش در سایت')
                        ->default(true)
                        ->required(),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('media_path')
                    ->label('پیش‌نمایش')
                    ->disk('public')
                    ->square(),
                TextColumn::make('member.name_fa')
                    ->label('هنرمند')
                    ->formatStateUsing(fn ($state, Story $record) => filled($state)
                        ? $state
                        : 'هنرمند #' . $record->member_id)
                    ->searchable(),
                TextColumn::make('media_type')
                    ->label('نوع')
                    ->formatStateUsing(fn ($state) => $state === 'video' ? 'ویدئو' : 'تصویر'),
                TextColumn::make('caption')->label('توضیح')->limit(40),
                IconColumn::make('is_active')->label('فعال')->boolean(),
                TextColumn::make('created_at')->label('تاریخ ثبت')->dateTime('Y/m/d H:i')->sortable(),
            ])
            ->filters([
                SelectFilter::make('member_id')
                    ->label('هنرمند')
                    ->options(fn (): array => Member::query()
                        ->orderBy('name_fa')
                        ->get()
                        ->mapWithKeys(fn (Member $member): array => [
                            $member->getKey() => filled($member->name_fa)
                                ? $member->name_fa
                                : 'هنرمند #' . $member->getKey(),
                        ])
                        ->all())
                    ->searchable()
                    ->preload(),
                SelectFilter::make('media_type')
                    ->label('نوع فایل')
                    ->options([
                        'image' => 'تصویر',
                        'video' => 'ویدئو',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()->after(function (Story $record): void {
                    if ($record->media_path) {
                        Storage::disk('public')->delete($record->media_path);
                    }
                }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        $query = parent::getEloquentQuery()->with('member')->latest();

        if ($user && $user->hasRole(1)) {
            return $query;
        }

        return $query->where('member_id', $user?->member?->getKey() ?? 0);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageStories::route('/'),
        ];
    }
}
