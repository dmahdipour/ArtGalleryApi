<?php

namespace App\Filament\Pages;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Filament\Widgets\StatsOverviewWidget;
use BackedEnum;
use UnitEnum;
use Filament\Schemas\Schema; 
use Filament\Support\Icons\Heroicon;


class ChangePassword extends Page
{
    protected string $view = 'filament.pages.change-password';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldCheck;
    protected static string|UnitEnum|null $navigationGroup = 'کاربران';
    protected static ?string $navigationLabel = 'تغییر رمز';
    protected static ?string $title = 'تغییر رمز';
    protected static ?int $navigationSort = 33;


    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('current_password')
                    ->label('رمز عبور فعلی')
                    ->password()
                    ->required(),
                TextInput::make('new_password')
                    ->label('رمز عبور جدید')
                    ->password()
                    ->required(),
                TextInput::make('new_password_confirmation')
                    ->label('تایید رمز عبور جدید')
                    ->password()
                    ->same('new_password')
                    ->required(),
            ]);
    }

    public function submit()
    {
        $user = Auth::user();

        // بررسی صحت رمز عبور فعلی
        if (!Hash::check($this->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'رمز عبور فعلی اشتباه است.',
            ]);
        }

        // تغییر رمز عبور
        $user->password = Hash::make($this->new_password);
        $user->save();

        session()->flash('message', 'رمز عبور شما با موفقیت تغییر یافت.');
    }
    public function getHeaderWidgetsColumns(): int | array
    {
        return 3;
    }


}
