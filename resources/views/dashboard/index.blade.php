@extends('layouts.app')

@section('title', 'Akun Saya - Dashboard')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar -->
            <div class="w-full md:w-1/4">
                <div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden p-6 mb-6">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-bold text-2xl">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">{{ auth()->user()->name }}</h2>
                            <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden">
                    <nav class="flex flex-col">
                        <a href="{{ route('dashboard') }}" class="px-6 py-4 flex items-center gap-3 text-green-600 font-medium bg-green-50 border-l-4 border-green-500 transition">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            Pesanan Saya
                        </a>
                        <!-- Future: Profile Edit, Addresses, etc -->
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="w-full md:w-3/4">
                <div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden p-6 sm:p-8 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Riwayat Pesanan</h2>

                    <!-- Status Tabs -->
                    <div class="border-b border-gray-200 mb-6 overflow-x-auto pb-1">
                        <nav class="-mb-px flex space-x-6 whitespace-nowrap" aria-label="Tabs">
                            @php
                                $tabs = [
                                    'semua' => 'Semua',
                                    'pending' => 'Menunggu Pembayaran',
                                    'paid' => 'Sudah Dibayar',
                                    'processing' => 'Dikemas',
                                    'shipping' => 'Dikirim',
                                    'done' => 'Selesai',
                                    'cancelled' => 'Dibatalkan',
                                ];
                                $currentFilter = request('status', 'semua');
                            @endphp

                            @foreach($tabs as $key => $label)
                                <a href="{{ route('dashboard', ['status' => $key]) }}" 
                                   class="{{ $currentFilter === $key ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap pb-3 px-1 border-b-2 font-medium text-sm transition-colors">
                                    {{ $label }}
                                </a>
                            @endforeach
                        </nav>
                    </div>

                    @if($orders->isEmpty())
                        <div class="text-center py-12">
                            <div class="mx-auto h-24 w-24 text-gray-300 mb-4 flex items-center justify-center">
                                <svg class="h-16 w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pesanan</h3>
                            <p class="text-gray-500 mb-6">Anda belum pernah melakukan pemesanan sebelumnya.</p>
                            <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Mulai Belanja
                            </a>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($orders as $order)
                                <div class="border border-gray-200 rounded-xl overflow-hidden">
                                    <div class="bg-gray-50 px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-gray-200">
                                        <div>
                                            <p class="text-sm text-gray-500 mb-1">Dipesan pada {{ $order->created_at->format('d M Y H:i') }}</p>
                                            <p class="text-sm font-semibold text-gray-900">ID: {{ $order->invoice_num }}</p>
                                        </div>
                                        <div class="flex flex-col items-end gap-2">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                                    'paid' => 'bg-blue-100 text-blue-800',
                                                    'processing' => 'bg-indigo-100 text-indigo-800',
                                                    'shipping' => 'bg-purple-100 text-purple-800',
                                                    'done' => 'bg-green-100 text-green-800',
                                                    'cancelled' => 'bg-red-100 text-red-800',
                                                ];
                                                $statusLabels = [
                                                    'pending' => 'Menunggu Pembayaran',
                                                    'paid' => 'Sudah Dibayar',
                                                    'processing' => 'Sedang Dikemas',
                                                    'shipping' => 'Sedang Dikirim',
                                                    'done' => 'Selesai',
                                                    'cancelled' => 'Dibatalkan',
                                                ];
                                                $colorClass = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800';
                                                $label = $statusLabels[$order->status] ?? ucfirst($order->status);
                                            @endphp
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $colorClass }}">
                                                {{ $label }}
                                            </span>
                                            <p class="text-lg font-bold text-green-600">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <div class="px-6 py-4">
                                        <!-- Iterate max 2 items to show a preview -->
                                        @foreach($order->items->take(2) as $item)
                                            <div class="flex items-center py-2 gap-4">
                                                <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 overflow-hidden">
                                                    @if($item->product && $item->product->image)
                                                        <img src="{{ Storage::url($item->product->image) }}" class="w-full h-full object-cover">
                                                    @else
                                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    @endif
                                                </div>
                                                <div class="flex-1">
                                                    <h4 class="text-sm font-medium text-gray-900">{{ $item->product_name }}</h4>
                                                    <p class="text-sm text-gray-500">{{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                        
                                        @if($order->items->count() > 2)
                                            <p class="text-sm text-gray-500 mt-2">+ {{ $order->items->count() - 2 }} produk lainnya</p>
                                        @endif
                                    </div>
                                    <div class="bg-gray-50 px-6 py-3 flex justify-end gap-3 border-t border-gray-200">
                                        @if($order->status === 'pending')
                                            <a href="{{ route('checkout.success', $order->id) }}" class="text-sm font-medium px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                                Bayar Sekarang
                                            </a>
                                        @endif
                                        <button class="text-sm font-medium px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition" onclick="alert('Fitur Detail Pesanan belum aktif')">
                                            Lihat Detail
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-8">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
