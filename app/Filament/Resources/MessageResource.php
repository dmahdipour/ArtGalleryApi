<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages\ManageMessages;
use App\Filament\Resources\MessageResource\Pages;
use App\Filament\Resources\MessageResource\RelationManagers;
use App\Models\Message;
use BackedEnum;
use UnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Filament\Forms\Components\RichEditor;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMegaphone;
    protected static string|UnitEnum|null $navigationGroup = 'آموزش';
    protected static ?string $modelLabel = 'پیام';
    protected static ?string $pluralModelLabel = 'پیام‌ها';
    protected static ?int $navigationSort = 6;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('عنوان')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                RichEditor::make('body')
                    ->label('متن پیام')
                    ->required()
                    ->columnSpanFull()
                    ->toolbarButtons([
                        ['bold', 'italic', 'underline', 'strike', 'link', 'textColor'],
                        ['bulletList', 'orderedList', 'blockquote'],
                        ['undo', 'redo'],
                    ])
                    ->textColors([
                        '#b58a3e' => 'طلایی',
                        '#ef4444' => 'قرمز',
                        '#10b981' => 'سبز',
                        '#0ea5e9' => 'آبی',
                        '#8b5cf6' => 'بنفش',
                        '#f59e0b' => 'نارنجی',
                        '#000000' => 'مشکی',
                    ])
                    ->customTextColors(),
                Select::make('type')
                    ->label('نوع پیام')
                    ->options([
                        'info' => 'اطلاعات',
                        'success' => 'موفقیت',
                        'warning' => 'هشدار',
                        'danger' => 'خطر',
                    ])
                    ->default('info')
                    ->required(),

                Toggle::make('is_active')
                    ->label('فعال')
                    ->default(true)
                    ->helperText(
                        'در صورت فعال بودن، پیام برای کاربران نمایش داده می‌شود.'
                    )
                    ->inline(false),
            
                DateTimePicker::make('starts_at')
                    ->label('شروع نمایش')
                    ->jalali()
                    ->displayFormat('Y/m/d H:i')
                    ->seconds(false)
                    ->native(false),

                DateTimePicker::make('expires_at')
                    ->label('پایان نمایش')
                    ->jalali()
                    ->displayFormat('Y/m/d H:i')
                    ->seconds(false)
                    ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('عنوان')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(60),

                TextColumn::make('body')
                    ->label('متن پیام')
                    ->limit(80)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('type')
                    ->label('نوع')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'info' => 'اطلاعات',
                        'success' => 'موفقیت',
                        'warning' => 'هشدار',
                        'danger' => 'خطر',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'info' => 'info',
                        'success' => 'success',
                        'warning' => 'warning',
                        'danger' => 'danger',
                        default => 'gray',
                    }),

                IconColumn::make('is_active')
                    ->label('فعال')
                    ->boolean(),

                TextColumn::make('starts_at')
                    ->label('شروع نمایش')
                    ->jalaliDateTime('Y/m/d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('expires_at')
                    ->label('پایان نمایش')
                    ->jalaliDateTime('Y/m/d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('reads_count')
                    ->label('تعداد خوانده شده')
                    ->counts('reads')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->jalaliDateTime('Y/m/d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('آخرین تغییر')
                    ->jalaliDateTime('Y/m/d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id', 'desc')

            ->filters([
                SelectFilter::make('type')
                    ->label('نوع پیام')
                    ->options([
                        'info' => 'اطلاعات',
                        'success' => 'موفقیت',
                        'warning' => 'هشدار',
                        'danger' => 'خطر',
                    ]),

                TernaryFilter::make('is_active')
                    ->label('وضعیت')
                    ->placeholder('همه')
                    ->trueLabel('فعال')
                    ->falseLabel('غیرفعال'),
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
            'index' => ManageMessages::route('/'),
        ];
    }
}