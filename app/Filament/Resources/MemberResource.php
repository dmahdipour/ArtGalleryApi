<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Members\Pages\ManageMembers;
use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use BackedEnum;
use UnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

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
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('user_name')
                    ->required(),
                TextInput::make('verification_code')
                    ->required()
                    ->numeric(),
                Toggle::make('is_email_verified')
                    ->required(),
                Select::make('member_type_id')
                    ->relationship('memberType', 'name')
                    ->required(),
                TextInput::make('name'),
                DatePicker::make('birthday')
                    ->jalali()->displayFormat('Y/m/d'),
                TextInput::make('place'),
                TextInput::make('major'),
                TextInput::make('university'),
                TextInput::make('activities'),
                TextInput::make('phone')
                    ->tel(),
                TextInput::make('instagram'),
                TextInput::make('linkedin'),
                TextInput::make('website')
                    ->url(),
                Textarea::make('about')
                    ->columnSpanFull(),
                Toggle::make('status')
                    ->required(),
                ImageColumn::make('avatar')
                    ->disk('public'),
                ImageColumn::make('signature')
                    ->disk('public'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->searchable(),
                TextColumn::make('user_name')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('memberType.name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('birthday')
                    ->jalaliDate()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('place')
                    ->searchable(),
                TextColumn::make('major')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('university')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('activities')
                    ->searchable(),
                TextColumn::make('verification_code')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_email_verified')
                    ->boolean(),
                TextColumn::make('phone')
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
                IconColumn::make('status')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
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
