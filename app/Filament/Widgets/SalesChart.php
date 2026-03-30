<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class SalesChart extends ChartWidget
{
    protected ?string $heading = 'Sales Chart';

    protected function getData(): array
    {
        $orders = \App\Models\Order::selectRaw('DATE(created_at) as date, SUM(grand_total) as total')
            ->whereMonth('created_at', date('m'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = $orders->pluck('date')->toArray();
        $data = $orders->pluck('total')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Daily Revenue',
                    'data' => $data,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
