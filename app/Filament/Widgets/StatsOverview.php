<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        $todayRevenue = Order::whereDate('created_at', today())
            ->where('status', '!=', 'cancelled')
            ->sum('grand_total');

        $monthRevenue = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->where('status', '!=', 'cancelled')
            ->sum('grand_total');

        $newOrders = Order::where('status', 'paid')
            ->orWhere('status', 'processing')
            ->count();

        $lowStock = Product::where('stock', '<', 5)->where('is_active', true)->count();

        return [
            Stat::make('Pendapatan Hari Ini', 'Rp ' . number_format($todayRevenue, 0, ',', '.'))
                ->description('Total pesanan valid hari ini')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),

            Stat::make('Pendapatan Bulan Ini', 'Rp ' . number_format($monthRevenue, 0, ',', '.'))
                ->description(now()->format('F Y'))
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('info'),

            Stat::make('Pesanan Perlu Diproses', $newOrders)
                ->description('Pesanan yang sudah dibayar')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color($newOrders > 0 ? 'warning' : 'gray'),

            Stat::make('Stok Menipis', $lowStock . ' Produk')
                ->description('Produk dengan stok < 5')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($lowStock > 0 ? 'danger' : 'success'),

            Stat::make('Total Pelanggan', User::where('role', 'customer')->count())
                ->description('Total user terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('Total Produk Aktif', Product::where('is_active', true)->count())
                ->description('Produk yang sedang dijual')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('success'),
        ];
    }
}
