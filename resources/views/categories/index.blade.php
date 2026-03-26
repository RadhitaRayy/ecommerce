@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Semua Kategori Belanja</h1>
            <p class="text-gray-500 max-w-2xl mx-auto">Temukan berbagai macam sayur, buah, bumbu, dan produk segar lainnya dari berbagai kategori yang kami sediakan khusus untuk Anda.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group block relative rounded-2xl overflow-hidden bg-white shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-100">
                        @if($category->image)
                            <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-center object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 group-hover:scale-105 transition duration-300">
                                <svg class="h-16 w-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-sm font-medium">No Image</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent"></div>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <h3 class="text-lg font-bold text-white">{{ $category->name }}</h3>
                        <p class="text-sm text-gray-200 line-clamp-2 mt-1">{{ $category->description ?? 'Lihat produk di kategori ini' }}</p>
                    </div>
                </a>
            @endforeach
        </div>
        
        @if($categories->isEmpty())
            <div class="text-center py-12">
                <div class="mx-auto h-24 w-24 text-gray-300 mb-4 flex items-center justify-center">
                    <svg class="h-16 w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada kategori</h3>
                <p class="text-gray-500">Saat ini belum ada kategori belanja yang tersedia.</p>
            </div>
        @endif
    </div>
</div>
@endsection
