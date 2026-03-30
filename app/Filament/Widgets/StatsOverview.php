<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Revenue', 'Rp ' . number_format(\App\Models\Order::sum('grand_total'), 0, ',', '.')),
            Stat::make('Total Orders', \App\Models\Order::count()),
            Stat::make('Total Customers', \App\Models\User::count()),
        ];
    }
}
