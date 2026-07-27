<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
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
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Schemas\Schema; 

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;
    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-user-group';
    }
    public static function getNavigationGroup(): ?string
    {
        return 'تلگرام';
    }
    protected static ?string $modelLabel = 'عضو';
    protected static ?string $pluralModelLabel = 'اعضا';


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('email')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email_confirm_code')
                    ->required(),
                Toggle::make('is_email_confirmed')
                    ->required(),
                Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->disk('public'),
                TextColumn::make('referal_code')
                    ->searchable(),
                TextColumn::make('user_name'),
                TextColumn::make('email')
                    ->searchable(),                
                IconColumn::make('is_email_confirmed')
                    ->boolean(),
                TextColumn::make('email_confirm_code')
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('telegram_id')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                IconColumn::make('status')
                    ->boolean(),
                TextColumn::make('name'),
                TextColumn::make('total_score'),
                TextColumn::make('referee'), 
                TextColumn::make('created_at')
                    ->jalaliDate()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('updated_at')
                    ->jalaliDate()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
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
            'index' => Pages\ManageMembers::route('/'),
        ];
    }
}
