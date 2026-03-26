<nav x-data="{ open: false, isScrolled: false }" 
     @scroll.window="isScrolled = (window.pageYOffset > 20)"
     :class="{ 'bg-white/80 backdrop-blur-md shadow-md': isScrolled, 'bg-white border-b border-gray-100 shadow-sm': !isScrolled }"
     class="sticky top-0 z-50 transition-all duration-300 w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 sm:h-20">
            <!-- Logo & Brand -->
            <div class="flex items-center shrink-0">
                <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                    <div class="p-2 bg-green-50 rounded-xl group-hover:bg-green-100 transition-colors">
                        <svg class="w-7 h-7 text-green-600 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <span class="font-extrabold text-2xl tracking-tight text-slate-800">Sayur<span class="text-green-500">Fresh</span></span>
                </a>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="relative text-sm font-semibold {{ request()->routeIs('home') ? 'text-green-600' : 'text-slate-600 hover:text-green-600' }} transition-colors duration-200 group">
                    Beranda
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-500 transition-all duration-300 group-hover:w-full {{ request()->routeIs('home') ? 'w-full' : '' }}"></span>
                </a>
                <a href="{{ route('products.index') }}" class="relative text-sm font-semibold {{ request()->routeIs('products.*') ? 'text-green-600' : 'text-slate-600 hover:text-green-600' }} transition-colors duration-200 group">
                    Belanja
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-500 transition-all duration-300 group-hover:w-full {{ request()->routeIs('products.*') ? 'w-full' : '' }}"></span>
                </a>
                <a href="{{ route('categories.index') }}" class="relative text-sm font-semibold {{ request()->routeIs('categories.*') ? 'text-green-600' : 'text-slate-600 hover:text-green-600' }} transition-colors duration-200 group">
                    Kategori
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-500 transition-all duration-300 group-hover:w-full {{ request()->routeIs('categories.*') ? 'w-full' : '' }}"></span>
                </a>
            </div>
            
            <div class="flex items-center gap-4 lg:gap-6">
                <!-- Search (Desktop) -->
                <form action="{{ route('products.index') }}" method="GET" class="hidden lg:block relative group">
                    <input type="text" name="q" placeholder="Cari sayuran segar..." class="w-56 xl:w-72 pl-11 pr-4 py-2 bg-slate-100 hover:bg-slate-200 focus:bg-white border-transparent focus:border-green-400 rounded-full text-sm transition-all duration-300 focus:ring-4 focus:ring-green-100 outline-none">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-hover:text-green-500 transition-colors">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </form>

                <!-- Cart -->
                @php
                    $cartCount = 0;
                    if(session('cart')) {
                        foreach(session('cart') as $item) {
                            $cartCount += $item['quantity'];
                        }
                    }
                @endphp
                <a href="{{ route('cart.index') }}" class="relative p-2 text-slate-600 hover:text-green-600 transition-colors group">
                    <svg class="w-6 h-6 transition-transform group-hover:-translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    @if($cartCount > 0)
                        <span class="absolute top-0 right-0 flex items-center justify-center min-w-[18px] h-[18px] text-[10px] font-bold text-white bg-red-500 rounded-full ring-2 ring-white transform translate-x-1/4 -translate-y-1/4 shadow-sm animate-pulse">{{ $cartCount }}</span>
                    @endif
                </a>

                <!-- User/Auth (Desktop) -->
                <div class="hidden md:flex items-center gap-4">
                    @auth
                        <div class="relative" x-data="{ userMenuOpen: false }">
                            <button @click="userMenuOpen = !userMenuOpen" @click.away="userMenuOpen = false" class="flex items-center gap-2 text-sm font-semibold text-slate-700 hover:text-green-600 transition-colors focus:outline-none">
                                <div class="w-8 h-8 bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold shadow-inner">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <span class="hidden lg:block">{{ explode(' ', auth()->user()->name)[0] }}</span>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': userMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            
                            <!-- Dropdown -->
                            <div x-show="userMenuOpen" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 translate-y-2"
                                 class="absolute right-0 mt-3 w-48 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50 text-sm" style="display: none;">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-slate-700 hover:bg-slate-50 hover:text-green-600 transition-colors">Dashboard Akun</a>
                                <div class="border-t border-slate-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition-colors">Keluar</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-green-600 transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent rounded-full shadow-sm text-sm font-bold text-white bg-green-600 hover:bg-green-700 hover:shadow-md hover:shadow-green-200 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Daftar
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button @click="open = !open" type="button" class="md:hidden inline-flex items-center justify-center p-2 rounded-xl text-slate-500 hover:text-green-600 hover:bg-slate-100 focus:outline-none transition-colors" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon when menu is closed -->
                    <svg x-show="!open" class="block w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Icon when menu is open -->
                    <svg x-show="open" class="block w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Drawer (Slide Down) -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="-translate-y-full opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="translate-y-0 opacity-100"
         x-transition:leave-end="-translate-y-full opacity-0"
         class="md:hidden absolute w-full bg-white border-b border-gray-100 shadow-xl z-40" style="display: none;">
        
        <div class="px-4 pt-4 pb-6 space-y-2">
            <!-- Mobile Search -->
            <form action="{{ route('products.index') }}" method="GET" class="mb-6 relative">
                <input type="text" name="q" placeholder="Cari sayuran..." class="w-full pl-11 pr-4 py-3 bg-slate-50 rounded-xl border border-slate-200 focus:border-green-400 focus:bg-white text-sm outline-none transition-all">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </form>

            <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('home') ? 'bg-green-50 text-green-700' : 'text-slate-700 hover:bg-slate-50' }} transition-colors">Beranda</a>
            <a href="{{ route('products.index') }}" class="block px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('products.*') ? 'bg-green-50 text-green-700' : 'text-slate-700 hover:bg-slate-50' }} transition-colors">Belanja</a>
            <a href="{{ route('categories.index') }}" class="block px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('categories.*') ? 'bg-green-50 text-green-700' : 'text-slate-700 hover:bg-slate-50' }} transition-colors">Kategori</a>
            
            <div class="border-t border-slate-100 pt-4 mt-2">
                @auth
                    <div class="flex items-center gap-3 px-4 py-2 mb-4">
                        <div class="w-10 h-10 bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold text-lg">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-500">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <a href="{{ route('dashboard') }}" class="block w-full text-left px-4 py-3 rounded-xl text-slate-700 font-semibold hover:bg-slate-50 transition-colors">Dashboard Akun</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-3 rounded-xl text-red-600 font-semibold hover:bg-red-50 transition-colors mt-1">Keluar</button>
                    </form>
                @else
                    <div class="grid grid-cols-2 gap-4 px-2">
                        <a href="{{ route('login') }}" class="flex items-center justify-center py-3 px-4 border border-slate-200 rounded-xl text-slate-700 font-bold hover:bg-slate-50 transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="flex items-center justify-center py-3 px-4 bg-green-600 rounded-xl text-white font-bold shadow-md shadow-green-200 hover:bg-green-700 transition-colors">Daftar</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
