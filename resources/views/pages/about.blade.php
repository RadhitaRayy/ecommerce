@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<div class="bg-white">
    <!-- Hero Section -->
    <div class="relative bg-green-600">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover opacity-30" src="https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" alt="Sayuran Segar">
            <div class="absolute inset-0 bg-green-600 mix-blend-multiply"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">Tentang SayurFresh</h1>
            <p class="mt-6 max-w-3xl mx-auto text-xl text-green-100">
                Menghubungkan Anda langsung dengan petani lokal untuk kualitas terbaik setiap hari.
            </p>
        </div>
    </div>

    <!-- Content Section -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Cerita Kami</h2>
                <p class="text-lg text-gray-500 mb-6">
                    SayurFresh berawal dari sebuah ide sederhana: bagaimana caranya agar masyarakat perkotaan bisa menikmati sayur dan buah yang benar-benar segar dengan harga yang adil, sekaligus membantu meningkatkan kesejahteraan petani lokal.
                </p>
                <p class="text-lg text-gray-500 mb-8">
                    Sejak tahun 2021, kami telah bekerja sama dengan lebih dari 50 kelompok tani di berbagai daerah. Kami memotong jalur distribusi yang panjang sehingga produk yang kami tawarkan tidak hanya lebih murah, tapi juga jauh lebih segar karena dikirim langsung dari kebun.
                </p>
                
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Visi Kami</h3>
                <p class="text-lg text-gray-500 mb-6">
                    Menjadi platform penyedia produk segar terdepan yang berkontribusi pada kesehatan masyarakat dan kesejahteraan petani di Indonesia.
                </p>
            </div>
            
            <div class="grid grid-cols-2 gap-6">
                <img class="rounded-2xl shadow-lg w-full h-64 object-cover" src="https://images.unsplash.com/photo-1595858694851-40e9d6dca3bb?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" alt="Petani di kebun">
                <img class="rounded-2xl shadow-lg w-full h-64 object-cover mt-12" src="https://images.unsplash.com/photo-1488459716781-31db52582fe9?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" alt="Sayuran segar kemasan">
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <p class="text-5xl font-extrabold text-green-600">50+</p>
                    <p class="mt-2 text-lg font-medium text-gray-500">Mitra Petani</p>
                </div>
                <div>
                    <p class="text-5xl font-extrabold text-green-600">300+</p>
                    <p class="mt-2 text-lg font-medium text-gray-500">Produk Segar</p>
                </div>
                <div>
                    <p class="text-5xl font-extrabold text-green-600">10k+</p>
                    <p class="mt-2 text-lg font-medium text-gray-500">Pelanggan Setia</p>
                </div>
                <div>
                    <p class="text-5xl font-extrabold text-green-600">99%</p>
                    <p class="mt-2 text-lg font-medium text-gray-500">Kepuasan Pelanggan</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
