<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\FontProviders\LocalFontProvider;
use Filament\Navigation\NavigationGroup;
use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use App\Filament\Pages\Profile;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Navigation\MenuItem;

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
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->spa()
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                //Widgets\AccountWidget::class,
                //Widgets\FilamentInfoWidget::class,
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
            ->brandName('مدیریت محتوا')
            ->sidebarCollapsibleOnDesktop()
            ->sidebarFullyCollapsibleOnDesktop()
            ->sidebarWidth('20rem')
            ->font(
                'YekanBakh-Regular',
                url: asset('fonts/font.css'),
                provider: LocalFontProvider::class,
            )
            ->plugins([
                FilamentSpatieRolesPermissionsPlugin::make(),
                ActivityLogPlugin::make()
                    ->label('لاگ')
                    ->pluralLabel('لاگ‌ها')
                    ->navigationGroup('سیستم'),
            ])
            //لینک سفارشی در نویگیشن بار
            /*
            ->navigationItems([
                NavigationItem::make('خروج از سیستم')
                    ->url('https://filament.pirsch.io', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-arrow-left-end-on-rectangle')
                    ->group('خروج')
                    ->sort(3),
            ])*/
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('تلگرام')
                    ->icon('heroicon-o-paper-airplane'),
                NavigationGroup::make()
                    ->label('داستان نویسی')
                    ->icon('heroicon-o-book-open'),
                NavigationGroup::make()
                    ->label('محتوا')
                    ->icon('heroicon-o-pencil-square'),
                NavigationGroup::make()
                    ->label('کاربران سیستم')
                    ->icon('heroicon-o-users'),
                NavigationGroup::make()
                    ->label('خبرنامه')
                    ->icon('heroicon-o-newspaper'),
                NavigationGroup::make()
                    ->label('نقش‌ها و دسترسی‌ها')
                    ->icon('heroicon-o-adjustments-vertical'),
                NavigationGroup::make()
                    ->label('آمار')
                    ->icon('heroicon-o-presentation-chart-line'),
                NavigationGroup::make()
                    ->label('تنظیمات')
                    ->icon('heroicon-o-cog-6-tooth'),
                    // ->collapsed(TRUE),                        
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('پروفایل')
                    ->url(fn (): string =>  Profile::getUrl())
                    ->icon('heroicon-o-user'),
            ]);
    }
}
