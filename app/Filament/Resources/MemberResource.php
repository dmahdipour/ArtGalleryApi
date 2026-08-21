<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages\ManageMembers;
use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use App\Models\User;
use BackedEnum;
use UnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;
    protected static string|UnitEnum|null $navigationGroup = 'اعضا';
    protected static ?string $modelLabel = 'عضو';
    protected static ?string $pluralModelLabel = 'اعضا';
    protected static ?int $navigationSort = 1;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('verification_code')
                    ->required()
                    ->numeric(),
                Toggle::make('is_email_verified')
                    ->required(),
                Select::make('member_type_id')
                    ->relationship('memberType', 'name')
                    ->required(),
                TextInput::make('name_fa')
                    ->label('نام و نام خانوادگی'),
                TextInput::make('name_en')
                    ->label('نام و نام خانوادگی به انگلیسی'),
                DatePicker::make('birthday')
                    ->label('تاریخ تولد')
                    ->jalali()->displayFormat('Y/m/d'),
                TextInput::make('place')
                    ->label('محل تولد'),
                TextInput::make('major')
                    ->label('رشته تحصیلی'),
                TextInput::make('university')
                    ->label('دانشگاه'),
                TextInput::make('activities')
                    ->label('فعالیت ها'),
                TextInput::make('phone')
                    ->label('شماره تماس')
                    ->tel(),
                TextInput::make('instagram'),
                TextInput::make('linkedin'),
                TextInput::make('website')
                    ->url(),
                Textarea::make('about')
                    ->label('در مورد هنرمند')
                    ->columnSpanFull(),
                FileUpload::make('signature')
                    ->label('امضای کاری')
                    ->image()
                    ->disk('public')
                    ->directory('images/signatures'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('user.avatar')
                    ->disk('public'),
                TextColumn::make('name_fa')
                    ->label('نام و نام خانوادگی')
                    ->searchable(),
                TextColumn::make('name_en')
                    ->label('نام و نام خانوادگی به انگلیسی')
                    ->searchable(),
                TextColumn::make('memberType.name')
                    ->label('نوع کاربری')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('نام کاربری')
                    ->searchable(),
                TextColumn::make('user.email')
                    ->label('ایمیل')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('birthday')
                    ->label('تاریخ تولد')
                    ->jalaliDate()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('place')
                    ->label('محل تولد')
                    ->searchable(),
                TextColumn::make('major')
                    ->label('رشته تحصیلی')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('university')
                    ->label('دانشگاه')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('activities')
                    ->label('فعالیت ها')
                    ->searchable(),
                TextColumn::make('verification_code')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_email_verified')
                    ->boolean(),
                TextColumn::make('phone')
                    ->label('شماره تماس')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('instagram')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('linkedin')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('website')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('user.is_active')
                    ->label('فعال')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('projects_count')
                    ->label('پروژه‌ها')
                    ->counts('projects')
                    ->url(fn ($record) => route('filament.dmy.resources.projects.index', [
                        'filters[member_id][value]' => $record->id
                    ]))
                    ->color('primary')
                    ->extraAttributes(['class' => 'underline hover:text-blue-600']),
            ])
            ->defaultSort('id', 'desc')
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
            'index' => ManageMembers::route('/'),
        ];
    }
}
