<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class MenuIcons extends Widget
{
    use HasWidgetShield;

    protected string $view = 'filament.widgets.menu-icons';
    protected int|string|array $columnSpan = 'full';
    public static function canView(): bool
    {
        return auth()->check();
    }
}
