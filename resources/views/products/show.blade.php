@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="bg-slate-50 min-h-screen pb-20 md:pb-12" x-data="{ quantity: 1, max: {{ $product->stock }} }">
    <!-- Breadcrumb -->
    <div class="bg-white border-b border-slate-200 pt-4 pb-4">
        <nav aria-label="Breadcrumb" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <ol role="list" class="flex items-center space-x-2 text-sm text-slate-500 overflow-x-auto whitespace-nowrap scrollbar-hide">
                <li><a href="{{ url('/') }}" class="hover:text-green-600 font-medium transition-colors">Beranda</a></li>
                <li><svg class="h-4 w-4 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" /></svg></li>
                <li><a href="{{ route('products.index') }}" class="hover:text-green-600 font-medium transition-colors">Produk</a></li>
                @if($product->category)
                <li><svg class="h-4 w-4 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" /></svg></li>
                <li><a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-green-600 font-medium transition-colors">{{ $product->category->name }}</a></li>
                @endif
                <li><svg class="h-4 w-4 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" /></svg></li>
                <li class="font-bold text-slate-800">{{ Str::limit($product->name, 20) }}</li>
            </ol>
        </nav>
    </div>

    <!-- Product Details -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
        <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16 bg-white rounded-3xl p-6 sm:p-8 lg:p-12 shadow-sm border border-slate-100">
            <!-- Image Section -->
            <div class="lg:col-span-1">
                <div class="aspect-square rounded-2xl overflow-hidden bg-slate-100 border border-slate-200 relative">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover hover:scale-105 transition-transform duration-700 ease-in-out cursor-zoom-in">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                            <svg class="h-20 w-20 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="font-medium text-sm">Belum Ada Gambar</p>
                        </div>
                    @endif
                    
                    @if($product->discount_price && $product->discount_price < $product->price)
                        <div class="absolute top-4 left-4 bg-red-500 text-white text-xs font-black uppercase tracking-wider px-4 py-2 rounded-full shadow-lg">
                            Diskon Terbatas
                        </div>
                    @endif
                </div>
            </div>

            <!-- Content Section -->
            <div class="lg:col-span-1 mt-10 lg:mt-0 flex flex-col h-full">
                <!-- Badges -->
                <div class="flex flex-wrap items-center gap-3 mb-6">
                    @if($product->category)
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-green-100 text-green-700">
                            {{ $product->category->name }}
                        </span>
                    @endif
                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider {{ $product->stock > 0 ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                        {{ $product->stock > 0 ? 'Stok: ' . $product->stock : 'Habis' }}
                    </span>
                </div>
                
                <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-slate-900 mb-4 leading-tight">
                    {{ $product->name }}
                </h1>

                <!-- Price Area -->
                <div class="mb-8">
                    @if($product->discount_price && $product->discount_price < $product->price)
                        <div class="flex flex-col sm:flex-row sm:items-baseline gap-2 sm:gap-4 mb-2">
                            <p class="text-4xl sm:text-5xl font-black text-slate-900">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</p>
                            <div class="flex items-center gap-2">
                                <p class="text-xl text-slate-400 line-through decoration-red-400/50">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-1 rounded">Hemat Rp {{ number_format($product->price - $product->discount_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @else
                        <p class="text-4xl sm:text-5xl font-black text-slate-900 mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    @endif
                    <p class="text-sm text-slate-500 font-medium">Harga per {{ $product->unit ?? 'satuan' }}</p>
                </div>
                
                <!-- Quick Info Blocks -->
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="bg-slate-50 border border-slate-100 p-4 rounded-2xl flex items-center gap-4">
                        <div class="bg-white p-2 rounded-xl border border-slate-200 text-green-600 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-medium mb-0.5">Bobot / Berat</p>
                            <p class="text-sm font-bold text-slate-900">{{ $product->weight_grams }} Gram</p>
                        </div>
                    </div>
                    <div class="bg-slate-50 border border-slate-100 p-4 rounded-2xl flex items-center gap-4">
                        <div class="bg-white p-2 rounded-xl border border-slate-200 text-green-600 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-medium mb-0.5">Kualitas</p>
                            <p class="text-sm font-bold text-slate-900">Segar & Terjamin</p>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-10 lg:flex-grow">
                    <h3 class="text-base font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">Informasi Produk</h3>
                    <div class="prose prose-sm prose-slate max-w-none text-slate-600 leading-relaxed">
                        {!! $product->description ?? 'Belum ada deskripsi lengkap untuk produk ini. Namun kami jamin kesegaran dan kualitasnya.' !!}
                    </div>
                </div>

                <!-- Add to Cart Area (Desktop Inline, Mobile Sticky Bottom) -->
                <div class="fixed bottom-0 left-0 right-0 z-40 bg-white border-t border-slate-200 p-4 md:relative md:bg-transparent md:border-t-0 md:p-0 mt-auto drop-shadow-2xl md:drop-shadow-none shadow-[0_-5px_20px_rgba(0,0,0,0.05)] md:shadow-none">
                    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4 sm:gap-6">
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-1 flex items-center gap-4 sm:gap-6">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <!-- Quantity Selector using Alpine -->
                            <div class="flex items-center w-32 shrink-0 bg-slate-50 border border-slate-200 rounded-full h-12 sm:h-14 overflow-hidden">
                                <button type="button" @click="if(quantity > 1) quantity--" class="w-10 h-full flex items-center justify-center text-slate-500 hover:bg-slate-200 hover:text-slate-800 transition-colors focus:outline-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                </button>
                                <input type="number" name="quantity" x-model="quantity" min="1" :max="max" class="w-12 h-full text-center text-slate-900 font-bold bg-transparent border-none focus:ring-0 p-0" readonly>
                                <button type="button" @click="if(quantity < max) quantity++" class="w-10 h-full flex items-center justify-center text-slate-500 hover:bg-slate-200 hover:text-slate-800 transition-colors focus:outline-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                </button>
                            </div>

                            <button type="submit" {{ $product->stock < 1 ? 'disabled' : '' }} class="flex-1 lg:max-w-xs bg-green-600 text-white rounded-full h-12 sm:h-14 flex items-center justify-center text-sm sm:text-base font-bold shadow-lg shadow-green-600/30 hover:bg-green-700 hover:shadow-xl hover:shadow-green-700/40 focus:outline-none focus:ring-4 focus:ring-green-100 disabled:opacity-50 disabled:cursor-not-allowed transition duration-300 transform hover:-translate-y-0.5 active:translate-y-0 relative overflow-hidden group">
                                <span class="relative z-10 flex items-center">
                                    <svg class="w-5 h-5 mr-2 transition-transform group-hover:-rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    {{ $product->stock < 1 ? 'Stok Habis' : 'Ke Keranjang' }}
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="hidden md:flex mt-6 items-center gap-6 text-xs font-semibold text-slate-500 mt-auto pt-6 border-t border-slate-100">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Tebar Segar Langsung
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pengiriman Kilat
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-20">
            <h2 class="text-2xl font-black tracking-tight text-slate-900 mb-8 border-b border-slate-200 pb-4">Produk Serupa Lainnya</h2>
            
            <div class="grid grid-cols-2 gap-y-8 gap-x-4 sm:grid-cols-3 lg:grid-cols-4 xl:gap-x-6">
                @foreach($relatedProducts as $related)
                <div class="group flex flex-col bg-white border border-slate-100 rounded-3xl overflow-hidden hover:shadow-xl hover:shadow-green-900/5 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative w-full aspect-square bg-slate-50 overflow-hidden">
                        @if($related->image)
                            <img src="{{ Storage::url($related->image) }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        
                        @if($related->discount_price && $related->discount_price < $related->price)
                            <div class="absolute top-2 left-2 bg-red-500 text-white text-[10px] uppercase font-bold px-2 py-1 rounded-full shadow-md">
                                Diskon
                            </div>
                        @endif
                        
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/60 to-transparent p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 hidden md:flex items-end justify-center">
                            <a href="{{ route('products.show', $related->slug) }}" class="w-full bg-white/90 backdrop-blur text-slate-900 font-bold py-2 rounded-full text-center text-xs shadow-lg hover:bg-green-500 hover:text-white transition">Lihat Detail</a>
                        </div>
                    </div>
                    
                    <div class="p-4 flex flex-col flex-grow justify-between">
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-wider text-green-600 mb-1">{{ $related->category->name ?? 'Kategori' }}</p>
                            <h3 class="text-sm font-bold text-slate-900 line-clamp-2 leading-snug mb-2">
                                <a href="{{ route('products.show', $related->slug) }}" class="hover:text-green-600 transition-colors">
                                    {{ $related->name }}
                                </a>
                            </h3>
                        </div>
                        
                        <div class="flex items-end justify-between mt-auto">
                            <div class="flex flex-col">
                                @if($related->discount_price && $related->discount_price < $related->price)
                                    <p class="text-xs text-slate-400 line-through mb-0.5">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                                    <p class="text-base font-black text-slate-900">Rp {{ number_format($related->discount_price, 0, ',', '.') }}</p>
                                @else
                                    <p class="text-base font-black text-slate-900">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                                @endif
                            </div>
                            
                            <form action="{{ route('cart.add') }}" method="POST" class="shrink-0">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $related->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="w-8 h-8 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center text-green-600 hover:bg-green-600 hover:text-white hover:border-transparent transition-all shadow-sm focus:outline-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
