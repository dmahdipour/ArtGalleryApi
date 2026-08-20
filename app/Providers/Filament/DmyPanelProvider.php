<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Profile;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use App\Filament\Pages\ChangePassword;
use App\Filament\Widgets;
use App\Filament\Pages\Auth\Register;

use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\FontProviders\LocalFontProvider;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\MenuItem;
use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use AlizHarb\ActivityLog\ActivityLogPlugin;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class DmyPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('dmy')
            ->path('dmy')
            ->login()
            ->registration()
            ->emailVerification() 
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
                
            ])
            ->navigationItems([
                NavigationItem::make('مشاهده وب سایت گالری')
                    ->url('/')
                    ->icon('heroicon-o-globe-alt')
                    ->sort(1), // عدد ۱ یعنی بلافاصله بعد از داشبورد قرار بگیرد
            ])
            ->spa()
            ->widgets([
                Widgets\StatsOverview::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            /** Custom Configs */
            ->brandName('گالری سنفونی رنگ')
            ->sidebarCollapsibleOnDesktop()
            ->sidebarFullyCollapsibleOnDesktop()
            ->sidebarWidth('20rem')
            ->font(
                'YekanBakh-Regular',
                url: asset('fonts/font.css'),
                provider: LocalFontProvider::class,
            )
            ->plugins([
                FilamentShieldPlugin::make(),
                FilamentSpatieRolesPermissionsPlugin::make(),
                ActivityLogPlugin::make()
                    ->label('لاگ')
                    ->pluralLabel('لاگ‌ها')
                    ->navigationGroup('سیستم'),
            ])
            ->navigationGroups([ 
                NavigationGroup::make()
                    ->label('کاربران'),
                NavigationGroup::make()
                    ->label('نقش‌ها و دسترسی‌ها'),
                NavigationGroup::make()
                    ->label('تنظیمات'),
                NavigationGroup::make()
                    ->label('سیستم'),
                NavigationGroup::make()
                    ->label('آمار'), 
                NavigationGroup::make()
                    ->label('خبرنامه'), 
                NavigationGroup::make()
                    ->label('محتوا'), 
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('پروفایل')
                    ->url(fn (): string =>  Profile::getUrl())
                    ->icon('heroicon-o-user'),
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('تغییر رمز')
                    ->url(fn (): string =>  ChangePassword::getUrl())
                    ->icon('heroicon-o-user'),
            ]);
    }
}                     
           