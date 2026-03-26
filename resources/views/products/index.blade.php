@extends('layouts.app')

@section('title', 'Belanja Sayur')

@section('content')
<div class="bg-slate-50 min-h-[80vh]" x-data="{ mobileFiltersOpen: false }">

    <!-- Mobile filter dialog -->
    <div x-show="mobileFiltersOpen" class="relative z-40 lg:hidden" role="dialog" aria-modal="true" style="display: none;">
        <div x-show="mobileFiltersOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>

        <div class="fixed inset-0 z-40 flex">
            <div x-show="mobileFiltersOpen" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-2xl">
                <div class="flex items-center justify-between px-4 mt-2">
                    <h2 class="text-xl font-bold text-slate-900">Filter & Urutkan</h2>
                    <button type="button" @click="mobileFiltersOpen = false" class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-slate-400 hover:text-slate-500 hover:bg-slate-100 transition-colors">
                        <span class="sr-only">Close menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <!-- Filters for mobile -->
                <form class="mt-4 border-t border-slate-200" id="filter-form-mobile" action="{{ route('products.index') }}" method="GET">
                    @if(request('q'))
                        <input type="hidden" name="q" value="{{ request('q') }}">
                    @endif
                    <div class="px-4 py-6">
                        <h3 class="font-bold text-slate-900 mb-4">Kategori</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input id="cat-all-m" name="category" value="" type="radio" class="h-5 w-5 border-slate-300 text-green-600 focus:ring-green-500" {{ request('category') == '' ? 'checked' : '' }} onchange="document.getElementById('filter-form-mobile').submit();">
                                <label for="cat-all-m" class="ml-3 text-sm font-medium text-slate-600">Semua Kategori</label>
                            </div>
                            @foreach($categories as $category)
                            <div class="flex items-center">
                                <input id="cat-{{ $category->id }}-m" name="category" value="{{ $category->slug }}" type="radio" class="h-5 w-5 border-slate-300 text-green-600 focus:ring-green-500" {{ request('category') == $category->slug ? 'checked' : '' }} onchange="document.getElementById('filter-form-mobile').submit();">
                                <label for="cat-{{ $category->id }}-m" class="ml-3 text-sm font-medium text-slate-600">{{ $category->name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="border-t border-slate-200 px-4 py-6">
                        <h3 class="font-bold text-slate-900 mb-4">Urutkan</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input id="sort-newest-m" name="sort" value="newest" type="radio" class="h-5 w-5 border-slate-300 text-green-600 focus:ring-green-500" {{ request('sort') == 'newest' || !request('sort') ? 'checked' : '' }} onchange="document.getElementById('filter-form-mobile').submit();">
                                <label for="sort-newest-m" class="ml-3 text-sm font-medium text-slate-600">Terbaru</label>
                            </div>
                            <div class="flex items-center">
                                <input id="sort-price-asc-m" name="sort" value="price_asc" type="radio" class="h-5 w-5 border-slate-300 text-green-600 focus:ring-green-500" {{ request('sort') == 'price_asc' ? 'checked' : '' }} onchange="document.getElementById('filter-form-mobile').submit();">
                                <label for="sort-price-asc-m" class="ml-3 text-sm font-medium text-slate-600">Harga Terendah</label>
                            </div>
                            <div class="flex items-center">
                                <input id="sort-price-desc-m" name="sort" value="price_desc" type="radio" class="h-5 w-5 border-slate-300 text-green-600 focus:ring-green-500" {{ request('sort') == 'price_desc' ? 'checked' : '' }} onchange="document.getElementById('filter-form-mobile').submit();">
                                <label for="sort-price-desc-m" class="ml-3 text-sm font-medium text-slate-600">Harga Tertinggi</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-16">
        
        <!-- Breadcrumb -->
        <nav aria-label="Breadcrumb" class="mb-8 hidden sm:block">
            <ol role="list" class="flex items-center space-x-2 text-sm text-slate-500">
                <li><a href="{{ url('/') }}" class="hover:text-green-600 font-medium transition-colors">Beranda</a></li>
                <li><svg class="h-5 w-5 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" /></svg></li>
                <li><a href="{{ route('products.index') }}" class="hover:text-green-600 font-medium transition-colors">Semua Produk</a></li>
                @if(request('category'))
                <li><svg class="h-5 w-5 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" /></svg></li>
                <li class="font-bold text-slate-800">{{ $categories->where('slug', request('category'))->first()->name ?? 'Kategori' }}</li>
                @endif
            </ol>
        </nav>

        <div class="flex items-baseline justify-between border-b border-slate-200 pb-6 mb-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">
                @if(request('q'))
                    Pencarian <span class="text-green-600">"{{ request('q') }}"</span>
                @elseif(request('category'))
                    Kategori <span class="text-green-600">{{ $categories->where('slug', request('category'))->first()->name ?? 'Semua' }}</span>
                @else
                    Semua Produk
                @endif
            </h1>

            <div class="flex items-center">
                <button type="button" @click="mobileFiltersOpen = true" class="-m-2 ml-4 p-2 text-slate-400 hover:text-slate-500 hover:bg-slate-100 rounded-lg sm:ml-6 lg:hidden flex items-center gap-2 transition">
                    <span class="text-sm font-semibold">Filter</span>
                    <svg class="h-5 w-5" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Sidebar Desktop -->
            <aside class="hidden lg:block lg:w-1/4 xl:w-1/5 shrink-0">
                <form id="filter-form-desktop" action="{{ route('products.index') }}" method="GET" class="sticky top-28 bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    @if(request('q'))
                        <input type="hidden" name="q" value="{{ request('q') }}">
                    @endif
                    
                    <div class="mb-8">
                        <h3 class="text-base font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">Kategori</h3>
                        <div class="space-y-3 mt-4">
                            <div class="flex items-center">
                                <input id="cat-all" name="category" value="" type="radio" class="h-4 w-4 border-slate-300 text-green-600 focus:ring-green-500 cursor-pointer" {{ request('category') == '' ? 'checked' : '' }} onchange="document.getElementById('filter-form-desktop').submit();">
                                <label for="cat-all" class="ml-3 text-sm font-medium text-slate-700 hover:text-green-600 cursor-pointer transition">Semua Kategori</label>
                            </div>
                            @foreach($categories as $category)
                            <div class="flex items-center group">
                                <input id="cat-{{ $category->id }}" name="category" value="{{ $category->slug }}" type="radio" class="h-4 w-4 border-slate-300 text-green-600 focus:ring-green-500 cursor-pointer" {{ request('category') == $category->slug ? 'checked' : '' }} onchange="document.getElementById('filter-form-desktop').submit();">
                                <label for="cat-{{ $category->id }}" class="ml-3 text-sm font-medium text-slate-700 group-hover:text-green-600 cursor-pointer transition">{{ $category->name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="text-base font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">Urutkan</h3>
                        <div class="space-y-3 mt-4">
                            <div class="flex items-center">
                                <input id="sort-newest" name="sort" value="newest" type="radio" class="h-4 w-4 border-slate-300 text-green-600 focus:ring-green-500 cursor-pointer" {{ request('sort') == 'newest' || !request('sort') ? 'checked' : '' }} onchange="document.getElementById('filter-form-desktop').submit();">
                                <label for="sort-newest" class="ml-3 text-sm font-medium text-slate-700 hover:text-green-600 cursor-pointer transition">Terbaru</label>
                            </div>
                            <div class="flex items-center">
                                <input id="sort-price-asc" name="sort" value="price_asc" type="radio" class="h-4 w-4 border-slate-300 text-green-600 focus:ring-green-500 cursor-pointer" {{ request('sort') == 'price_asc' ? 'checked' : '' }} onchange="document.getElementById('filter-form-desktop').submit();">
                                <label for="sort-price-asc" class="ml-3 text-sm font-medium text-slate-700 hover:text-green-600 cursor-pointer transition">Harga Terendah</label>
                            </div>
                            <div class="flex items-center">
                                <input id="sort-price-desc" name="sort" value="price_desc" type="radio" class="h-4 w-4 border-slate-300 text-green-600 focus:ring-green-500 cursor-pointer" {{ request('sort') == 'price_desc' ? 'checked' : '' }} onchange="document.getElementById('filter-form-desktop').submit();">
                                <label for="sort-price-desc" class="ml-3 text-sm font-medium text-slate-700 hover:text-green-600 cursor-pointer transition">Harga Tertinggi</label>
                            </div>
                        </div>
                    </div>
                </form>
            </aside>

            <!-- Product Grid -->
            <div class="w-full lg:flex-1">
                @if($products->isEmpty())
                    <div class="text-center py-20 bg-white rounded-3xl border border-slate-200 shadow-sm flex flex-col items-center justify-center">
                        <div class="w-24 h-24 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mb-6">
                            <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Produk Tidak Ditemukan</h3>
                        <p class="text-slate-500 mb-8 max-w-sm">Maaf, kami tidak dapat menemukan produk yang sesuai dengan filter atau pencarian Anda.</p>
                        <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-bold rounded-full text-white bg-green-600 hover:bg-green-700 shadow-lg shadow-green-200 focus:outline-none transition transform hover:-translate-y-1">
                            Reset Pencarian
                        </a>
                    </div>
                @else
                    <div class="mb-4 text-sm text-slate-500 font-medium">Menampilkan {{ $products->count() }} produk dari {{ $products->total() }} total</div>
                    
                    <div class="grid grid-cols-2 gap-y-8 gap-x-4 sm:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-6">
                        @foreach($products as $product)
                        <div class="group flex flex-col bg-white border border-slate-100 rounded-3xl overflow-hidden hover:shadow-2xl hover:shadow-green-900/5 transition-all duration-300 transform hover:-translate-y-1">
                            <!-- Image Container -->
                            <div class="relative w-full aspect-square bg-slate-50 overflow-hidden">
                                @if($product->image)
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-300">
                                        <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span class="text-xs">No Image</span>
                                    </div>
                                @endif
                                
                                @if($product->discount_price && $product->discount_price < $product->price)
                                    <div class="absolute top-3 left-3 bg-red-500 text-white text-[10px] uppercase tracking-wider font-extrabold px-3 py-1.5 rounded-full shadow-md">
                                        Diskon
                                    </div>
                                @endif
                                
                                <!-- Quick Actions overlay (desktop only) -->
                                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/60 to-transparent p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 hidden md:flex items-end justify-center">
                                    <a href="{{ route('products.show', $product->slug) }}" class="w-full bg-white/90 backdrop-blur text-slate-900 font-bold py-2 rounded-full text-center text-sm shadow-lg hover:bg-green-500 hover:text-white transition">Lihat Detail</a>
                                </div>
                            </div>
                            
                            <!-- Product Info -->
                            <div class="p-5 flex flex-col flex-grow justify-between">
                                <div>
                                    <div class="flex items-center justify-between mb-1.5">
                                        <p class="text-xs font-semibold uppercase tracking-wider text-green-600">{{ $product->category->name ?? 'Kategori' }}</p>
                                        <span class="text-xs text-slate-400 font-medium bg-slate-100 px-2 py-0.5 rounded-full">/{{ $product->unit ?? 'pcs' }}</span>
                                    </div>
                                    <h3 class="text-base font-bold text-slate-900 line-clamp-2 leading-snug mb-3">
                                        <a href="{{ route('products.show', $product->slug) }}" class="hover:text-green-600 transition-colors">
                                            {{ $product->name }}
                                        </a>
                                    </h3>
                                </div>
                                
                                <div class="flex items-end justify-between mt-auto">
                                    <div class="flex flex-col">
                                        @if($product->discount_price && $product->discount_price < $product->price)
                                            <p class="text-xs text-slate-400 line-through decoration-red-400/50 mb-0.5">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                            <p class="text-lg font-black text-slate-900">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</p>
                                        @else
                                            <p class="text-lg font-black text-slate-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                        @endif
                                    </div>
                                    
                                    <!-- Add to cart quick button -->
                                    <form action="{{ route('cart.add') }}" method="POST" class="shrink-0">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="w-10 h-10 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center text-green-600 hover:bg-green-600 hover:text-white hover:border-transparent transition-all shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif

                <div class="mt-12 flex justify-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
