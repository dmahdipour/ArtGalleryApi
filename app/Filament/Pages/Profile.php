<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema; 


class Profile extends Page
{
    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-user-circle';
    }
    public static function getNavigationGroup(): ?string
    {
        return 'تنظیمات';
    }
    protected static ?string $navigationLabel = 'پروفایل';
    protected static ?string $title = 'پروفایل';
    protected string $view = 'filament.pages.profile';


    public $name;
    public $email;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
            TextInput::make('name')
                ->label('نام')
                ->required(),
            TextInput::make('email')
                ->label('ایمیل')
                ->email()
                ->required(),
            ]);
    }

    public function submit()
    {
        $user = Auth::user();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();

        session()->flash('message', 'پروفایل شما با موفقیت به‌روزرسانی شد.');
    }


}
