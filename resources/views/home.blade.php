@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')
    <!-- Original Hero Section (Always visible) -->
    <div
        class="relative bg-gradient-to-br from-green-50 via-white to-green-100 overflow-hidden min-h-[90vh] flex items-center pt-16 md:pt-0">
        <div class="absolute inset-0 z-0">
            <!-- Abstract decorative shapes -->
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-72 h-72 rounded-full bg-green-200 opacity-20 blur-3xl">
            </div>
            <div
                class="absolute bottom-0 left-0 -ml-20 -mb-20 w-96 h-96 rounded-full bg-emerald-300 opacity-20 blur-3xl">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8 items-center">

                <!-- Hero Text -->
                <div class="text-center lg:text-left order-2 lg:order-1 pb-16 lg:pb-0">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-100 text-green-700 font-semibold text-sm mb-6 animate-fade-in-up">
                        <span class="flex h-2 w-2 relative">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-500 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                        </span>
                        Sayuran Organik Pilihan
                    </div>
                    <h1
                        class="text-4xl tracking-tight font-extrabold text-slate-900 sm:text-5xl md:text-6xl lg:text-7xl leading-tight mb-4">
                        <span class="block">Segar Langsung</span>
                        <span
                            class="block text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-400 pb-2">Dari
                            Petani Lokal</span>
                    </h1>
                    <p
                        class="mt-4 text-base text-slate-600 sm:text-lg sm:max-w-xl mx-auto lg:mx-0 md:mt-6 mb-8 lg:mb-10 leading-relaxed font-medium">
                        Belanja kebutuhan sayur, buah, dan bumbu dapur berkualitas premium dengan pengiriman cepat ke
                        depan pintu rumah Anda tanpa repot.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('products.index') }}"
                            class="inline-flex items-center justify-center px-8 py-4 text-base font-bold rounded-full text-white bg-green-600 hover:bg-green-700 shadow-lg shadow-green-200 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-green-100">
                            Mulai Belanja
                            <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                        <a href="#categories"
                            class="inline-flex items-center justify-center px-8 py-4 text-base font-bold rounded-full text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 hover:border-slate-300 shadow-sm transition-all duration-300 transform hover:-translate-y-1">
                            Lihat Kategori
                        </a>
                    </div>

                    <!-- Trust indicators -->
                    <div
                        class="mt-10 sm:mt-12 flex items-center justify-center lg:justify-start gap-6 text-slate-500 text-sm font-semibold">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            100% Segar
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Kirim 24 Jam
                        </div>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="order-1 lg:order-2 relative mt-8 lg:mt-0">
                    <div class="relative w-full aspect-square max-w-md mx-auto lg:max-w-none lg:w-full lg:h-auto">
                        <!-- Accent decorative circle -->
                        <div
                            class="absolute inset-0 bg-gradient-to-tr from-green-300 to-emerald-100 rounded-full blur-2xl opacity-50 transform scale-90 translate-x-4 translate-y-4">
                        </div>
                        <img class="relative w-full h-full object-cover rounded-[3rem] shadow-2xl z-10 border-8 border-white/50 transform hover:scale-[1.02] transition-transform duration-700"
                            src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80&w=1000"
                            alt="Sayuran segar">
                        <!-- Floating Badge -->
                        <div class="absolute -bottom-6 -left-6 z-20 bg-white p-4 rounded-2xl shadow-xl flex items-center gap-4 animate-bounce"
                            style="animation-duration: 3s;">
                            <div class="bg-green-100 p-3 rounded-full text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.514">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-800">4.9/5 Rating</p>
                                <p class="text-xs text-slate-500">10k+ Ulasan Puas</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Promotional Banners Section -->
    @if (isset($banners) && $banners->count() > 0)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div x-data="{ currentSlide: 0, slides: {{ $banners->count() }}, next() { this.currentSlide = (this.currentSlide + 1) % this.slides }, prev() { this.currentSlide = (this.currentSlide - 1 + this.slides) % this.slides } }" x-init="setInterval(() => next(), 5000)" class="relative w-full overflow-hidden rounded-3xl shadow-xl border border-slate-100 bg-slate-100 group">
                
                <div class="flex transition-transform duration-700 ease-in-out"
                    :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
                    @foreach ($banners as $banner)
                        <div class="w-full flex-shrink-0 relative">
                            <a href="{{ $banner->target_url ?? '#' }}" class="block w-full">
                                <img src="{{ Storage::url($banner->image_path) }}" alt="{{ $banner->title }}"
                                    class="w-full h-48 sm:h-64 md:h-80 lg:h-96 object-cover md:object-center">
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Arrows -->
                <button @click="prev()"
                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/70 hover:bg-white text-slate-800 p-2 md:p-3 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition-opacity focus:outline-none z-20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button @click="next()"
                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/70 hover:bg-white text-slate-800 p-2 md:p-3 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition-opacity focus:outline-none z-20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                <!-- Indicators -->
                <div class="absolute bottom-4 md:bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2 md:space-x-3 z-20">
                    @foreach ($banners as $index => $banner)
                        <button @click="currentSlide = {{ $index }}"
                            :class="{
                                'bg-green-600 scale-125': currentSlide ===
                                    {{ $index }},
                                'bg-white/70 hover:bg-white': currentSlide !== {{ $index }}
                            }"
                            class="w-2 h-2 md:w-3 md:h-3 rounded-full transition-all duration-300 shadow-sm"></button>
                    @endforeach
                </div>
            </div>
        </div>
    @endif


    <!-- Categories Section -->
    <div id="categories" class="py-20 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div>
                    <h2 class="text-sm font-bold tracking-widest text-green-600 uppercase mb-2">Eksplorasi</h2>
                    <h3 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Kategori Populer</h3>
                </div>
                <a href="{{ route('categories.index') }}"
                    class="hidden md:flex items-center text-green-600 font-semibold hover:text-green-700 transition">
                    Lihat Semua Kategori <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6 sm:gap-8">
                @forelse($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug ?? $category->id]) }}"
                        class="group block text-center">
                        <div
                            class="relative mx-auto w-24 h-24 sm:w-32 sm:h-32 rounded-full p-1 bg-white border border-slate-100 shadow-sm group-hover:shadow-md group-hover:border-green-200 transition-all duration-300">
                            <div
                                class="w-full h-full rounded-full overflow-hidden bg-slate-50 flex items-center justify-center transform group-hover:scale-105 transition-transform duration-300">
                                @if ($category->image)
                                    <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <svg class="w-10 h-10 text-green-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                        <h4
                            class="mt-4 text-sm sm:text-base font-bold text-slate-800 group-hover:text-green-600 transition-colors">
                            {{ $category->name }}</h4>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 text-slate-400 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <p class="text-slate-500 font-medium">Kategori belum tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8 text-center md:hidden">
                <a href="{{ route('categories.index') }}"
                    class="inline-flex items-center justify-center bg-slate-50 text-slate-700 hover:bg-slate-100 font-semibold py-3 px-6 rounded-full w-full transition border border-slate-200">
                    Lihat Semua Kategori
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section (Moved up for better flow) -->
    <div class="py-16 bg-slate-900 border-y border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div
                    class="flex flex-col items-center sm:flex-row sm:items-start text-center sm:text-left gap-6 group hover:-translate-y-1 transition-transform">
                    <div
                        class="w-16 h-16 shrink-0 bg-slate-800 ring-4 ring-slate-800 group-hover:ring-green-500/30 rounded-2xl flex items-center justify-center text-green-400 transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white mb-2">Kualitas Terjamin</h3>
                        <p class="text-slate-400 text-sm leading-relaxed">Produk disortir dengan ketat sebelum dikirim,
                            memastikan hanya sayuran segar yang sampai ke tangan Anda.</p>
                    </div>
                </div>
                <!-- Feature 2 -->
                <div
                    class="flex flex-col items-center sm:flex-row sm:items-start text-center sm:text-left gap-6 group hover:-translate-y-1 transition-transform">
                    <div
                        class="w-16 h-16 shrink-0 bg-slate-800 ring-4 ring-slate-800 group-hover:ring-green-500/30 rounded-2xl flex items-center justify-center text-green-400 transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white mb-2">Pengiriman Ekspres</h3>
                        <p class="text-slate-400 text-sm leading-relaxed">Pesan hari ini, sampai hari ini. Logistik kami
                            menjamin kesegaran yang sama seperti saat baru dipanen.</p>
                    </div>
                </div>
                <!-- Feature 3 -->
                <div
                    class="flex flex-col items-center sm:flex-row sm:items-start text-center sm:text-left gap-6 group hover:-translate-y-1 transition-transform">
                    <div
                        class="w-16 h-16 shrink-0 bg-slate-800 ring-4 ring-slate-800 group-hover:ring-green-500/30 rounded-2xl flex items-center justify-center text-green-400 transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white mb-2">Aman & Terpercaya</h3>
                        <p class="text-slate-400 text-sm leading-relaxed">Sistem pembayaran yang aman dan jaminan garansi
                            retur jika produk tidak sesuai standar kualitas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div id="products" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div>
                    <h2 class="text-sm font-bold tracking-widest text-green-600 uppercase mb-2">Pilihan Terbaik</h2>
                    <h3 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Produk Terbaru Kami</h3>
                </div>
                <a href="{{ route('products.index') }}"
                    class="mt-4 md:mt-0 inline-flex items-center justify-center px-6 py-2.5 bg-white border border-slate-200 rounded-full text-slate-700 font-semibold hover:bg-slate-50 hover:text-green-600 transition shadow-sm w-fit">
                    Lihat Semua <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-2 gap-y-8 gap-x-4 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 xl:gap-x-8">
                @forelse($products as $product)
                    <div
                        class="group flex flex-col bg-white border border-slate-100 rounded-3xl overflow-hidden hover:shadow-2xl hover:shadow-green-900/5 transition-all duration-300 transform hover:-translate-y-1">
                        <!-- Image Container -->
                        <div class="relative w-full aspect-square bg-slate-50 overflow-hidden">
                            @if ($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-slate-300">
                                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="text-xs">No Image</span>
                                </div>
                            @endif

                            @if ($product->discount_price && $product->discount_price < $product->price)
                                <div
                                    class="absolute top-3 left-3 bg-red-500 text-white text-[10px] uppercase tracking-wider font-extrabold px-3 py-1.5 rounded-full shadow-md">
                                    Diskon
                                </div>
                            @endif

                            <!-- Quick Actions overlay (desktop only) -->
                            <div
                                class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/60 to-transparent p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 hidden md:flex items-end justify-center">
                                <a href="{{ route('products.show', $product->slug) }}"
                                    class="w-full bg-white/90 backdrop-blur text-slate-900 font-bold py-2 rounded-full text-center text-sm shadow-lg hover:bg-green-500 hover:text-white transition">Lihat
                                    Detail</a>
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="p-5 flex flex-col flex-grow justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <p class="text-xs font-semibold uppercase tracking-wider text-green-600">
                                        {{ $product->category->name ?? 'Kategori' }}</p>
                                    <span
                                        class="text-xs text-slate-400 font-medium bg-slate-100 px-2 py-0.5 rounded-full">/{{ $product->unit ?? 'pcs' }}</span>
                                </div>
                                <h3 class="text-base font-bold text-slate-900 line-clamp-2 leading-snug mb-3">
                                    <a href="{{ route('products.show', $product->slug) }}"
                                        class="hover:text-green-600 transition-colors">
                                        {{ $product->name }}
                                    </a>
                                </h3>
                            </div>

                            <div class="flex items-end justify-between mt-auto">
                                <div class="flex flex-col">
                                    @if ($product->discount_price && $product->discount_price < $product->price)
                                        <p class="text-xs text-slate-400 line-through decoration-red-400/50 mb-0.5">Rp
                                            {{ number_format($product->price, 0, ',', '.') }}</p>
                                        <p class="text-lg font-black text-slate-900">Rp
                                            {{ number_format($product->discount_price, 0, ',', '.') }}</p>
                                    @else
                                        <p class="text-lg font-black text-slate-900">Rp
                                            {{ number_format($product->price, 0, ',', '.') }}</p>
                                    @endif
                                </div>

                                <!-- Add to cart quick button (Mobile + Desktop) -->
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="shrink-0">
                                    @csrf
                                    <button type="submit"
                                        class="w-10 h-10 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center text-green-600 hover:bg-green-600 hover:text-white hover:border-transparent transition-all shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full py-20 flex flex-col items-center justify-center bg-white rounded-3xl border border-slate-100 shadow-sm">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 mb-1">Belum Ada Produk</h3>
                        <p class="text-slate-500 text-sm">Kembali lagi nanti untuk melihat produk terbaru kami.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection
