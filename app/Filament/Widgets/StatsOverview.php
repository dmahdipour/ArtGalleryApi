<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Member;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $allMembersCount=Member::count();
        return [
            Stat::make('اعضای ثبت نام کرده', $allMembersCount.' نفر')
                ->description('پروفایل'),
        ];
    }
}
