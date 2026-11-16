<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class MenuIcons extends Widget
{
    protected string $view = 'filament.widgets.menu-icons';
    protected int|string|array $columnSpan = 'full';
    public static function canView(): bool
    {
        return auth()->check();
    }
}
