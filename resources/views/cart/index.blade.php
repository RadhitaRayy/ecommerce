@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex items-center gap-3 mb-8">
            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Keranjang Anda</h1>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 p-4 rounded-2xl flex items-start gap-3 transform animate-fade-in-up">
                <svg class="w-6 h-6 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-sm font-semibold text-emerald-800">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 p-4 rounded-2xl flex items-start gap-3 transform animate-fade-in-up">
                <svg class="w-6 h-6 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-sm font-semibold text-red-800">{{ session('error') }}</span>
            </div>
        @endif

        @if(empty($cart))
            <!-- Empty State -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-12 text-center max-w-2xl mx-auto flex flex-col items-center">
                <div class="h-32 w-32 bg-slate-50 rounded-full flex items-center justify-center mb-6 text-slate-300">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-slate-900 mb-2">Keranjang Kosong</h2>
                <p class="text-slate-500 mb-8 max-w-md">Yuk isi keranjangmu dengan sayuran segar pilihan kami sekarang juga.</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-8 py-3.5 border border-transparent text-sm font-bold rounded-full shadow-lg shadow-green-200 text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-100 transition duration-300 transform hover:-translate-y-1">
                    Mulai Belanja Sekarang
                </a>
            </div>
        @else
            <!-- Cart Content -->
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-10 lg:items-start" x-data="cartForm">
                <div class="lg:col-span-8">
                    <!-- Cart List Container -->
                    <div class="bg-white shadow-sm border border-slate-100 rounded-[2rem] overflow-hidden p-2 sm:p-4">
                        <ul role="list" class="divide-y divide-slate-100">
                            @foreach($cart as $id => $details)
                                <li class="py-6 px-4">
                                    <div class="flex flex-col sm:flex-row gap-6">
                                        <!-- Image -->
                                        <div class="flex-shrink-0 relative">
                                            @if($details['image'])
                                                <img src="{{ Storage::url($details['image']) }}" alt="{{ $details['name'] }}" class="w-full h-32 sm:w-32 sm:h-32 rounded-2xl object-cover object-center border border-slate-100 bg-slate-50">
                                            @else
                                                <div class="w-full h-32 sm:w-32 sm:h-32 rounded-2xl border border-slate-100 bg-slate-50 flex items-center justify-center text-slate-300">
                                                    <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Item Details -->
                                        <div class="flex-1 flex flex-col justify-between">
                                            <div>
                                                <div class="flex justify-between flex-col sm:flex-row sm:items-start gap-2 sm:gap-4 mb-2">
                                                    <h4 class="text-xl font-bold text-slate-900 leading-tight">
                                                        <a href="{{ route('products.show', $details['slug'] ?? '#') }}" class="hover:text-green-600 transition-colors">{{ $details['name'] }}</a>
                                                    </h4>
                                                    <p class="text-lg font-black text-slate-900">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</p>
                                                </div>
                                                <p class="text-sm font-medium text-slate-500">Rp {{ number_format($details['price'], 0, ',', '.') }} / {{ $details['unit'] ?? 'pcs' }}</p>
                                            </div>

                                            <div class="mt-6 flex flex-wrap items-center justify-between gap-4">
                                                <!-- Update Quantity Form -->
                                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center gap-3">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    
                                                    <div class="flex items-center border border-slate-200 bg-slate-50 rounded-full h-10 w-28 overflow-hidden">
                                                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="px-2 h-full text-slate-400 hover:text-slate-800 hover:bg-slate-200 transition-colors focus:outline-none">
                                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                                        </button>
                                                        <input type="number" name="quantity" min="1" max="{{ $details['max_stock'] ?? 100 }}" value="{{ $details['quantity'] }}" class="w-full h-full text-center text-sm font-bold text-slate-900 bg-transparent border-none focus:ring-0 p-0" onchange="this.form.submit()">
                                                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="px-2 h-full text-slate-400 hover:text-slate-800 hover:bg-slate-200 transition-colors focus:outline-none">
                                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                                        </button>
                                                    </div>
                                                    
                                                    <button type="submit" class="text-xs font-bold text-green-600 hover:text-green-700 bg-green-50 px-3 py-2 rounded-full hidden sm:block">Update</button>
                                                </form>

                                                <!-- Remove Button -->
                                                <form action="{{ route('cart.remove') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    <button type="submit" class="text-sm font-bold text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-full flex items-center transition-colors px-4">
                                                        <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Order Summary Panel -->
                <div class="mt-8 lg:mt-0 lg:col-span-4 sticky top-28 bg-white shadow-sm border border-slate-100 rounded-[2rem] p-6 sm:p-8 relative overflow-hidden">
                    <!-- Subtle background decoration -->
                    <div class="absolute top-0 right-0 -mr-10 -mt-10 w-32 h-32 rounded-full bg-green-100 opacity-50 blur-2xl pointer-events-none"></div>

                    <h2 class="text-xl font-bold text-slate-900 border-b border-slate-100 pb-4 relative z-10">Ringkasan</h2>

                    <dl class="mt-6 space-y-4 relative z-10">
                        <div class="flex items-center justify-between text-sm">
                            <dt class="text-slate-500 font-medium">Subtotal Produk</dt>
                            <dd class="font-bold text-slate-900">Rp {{ number_format($total, 0, ',', '.') }}</dd>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <dt class="text-slate-500 font-medium">Estimasi Ongkir</dt>
                            <dd class="font-bold text-slate-400 italic">Dihitung di Checkout</dd>
                        </div>
                        
                        <div class="flex items-center justify-between border-t border-slate-100 pt-6 mt-6">
                            <dt class="text-base font-bold text-slate-900">Total Belanja</dt>
                            <dd class="text-2xl font-black text-green-600">Rp {{ number_format($total, 0, ',', '.') }}</dd>
                        </div>
                    </dl>

                    <div class="mt-8 relative z-10">
                        <a href="{{ url('/checkout') }}" class="w-full bg-green-600 border border-transparent rounded-full shadow-lg shadow-green-600/30 py-4 px-4 text-sm font-bold text-white hover:bg-green-700 hover:shadow-xl hover:shadow-green-700/40 focus:outline-none focus:ring-4 focus:ring-green-100 flex items-center justify-center transition duration-300 transform hover:-translate-y-1">
                            Lanjut ke Pengiriman
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                    
                    <div class="mt-6 text-center relative z-10">
                        <a href="{{ route('products.index') }}" class="text-sm font-bold text-slate-500 hover:text-green-600 transition-colors inline-block pb-1 border-b-2 border-transparent hover:border-green-600">
                            Lanjut Berbelanja
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('cartForm', () => ({
            // Add custom logic if needed for debounce forms
        }))
    });
</script>
@endsection
