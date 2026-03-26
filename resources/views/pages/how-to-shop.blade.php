@extends('layouts.app')

@section('title', 'Cara Belanja')

@section('content')
<div class="bg-gray-50 min-h-screen py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Cara Belanja di SayurFresh</h1>
            <p class="mt-4 text-lg text-gray-500">Langkah mudah dan cepat untuk mendapatkan sayuran segar langsung di depan pintu Anda.</p>
        </div>

        <div class="space-y-12">
            <!-- Step 1 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 flex flex-col md:flex-row gap-8 items-center">
                <div class="flex-shrink-0 w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-3xl font-bold">
                    1
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Pilih Produk Segar</h3>
                    <p class="text-gray-600">Telusuri berbagai kategori sayur, buah, dan kebutuhan dapur lainnya di halaman "Shop" atau "Kategori". Gunakan fitur pencarian untuk menemukan produk yang spesifik.</p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 flex flex-col md:flex-row gap-8 items-center">
                <div class="flex-shrink-0 w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-3xl font-bold">
                    2
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Tambahkan ke Keranjang</h3>
                    <p class="text-gray-600">Setelah menemukan produk yang diinginkan, atur jumlahnya dan klik tombol "Tambah ke Keranjang". Anda dapat selalu melihat ringkasan belanja dengan mengklik ikon keranjang di atas.</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 flex flex-col md:flex-row gap-8 items-center">
                <div class="flex-shrink-0 w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-3xl font-bold">
                    3
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Checkout & Isi Data Diri</h3>
                    <p class="text-gray-600">Buka keranjang belanja Anda lalu pilih "Checkout". Isi dengan lengkap detail pengiriman seperti Nama Penerima, Nomor WhatsApp yang aktif, dan Alamat Lengkap.</p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 flex flex-col md:flex-row gap-8 items-center">
                <div class="flex-shrink-0 w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-3xl font-bold">
                    4
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Konfirmasi & Pembayaran</h3>
                    <p class="text-gray-600">Buat pesanan dan Anda akan mendapatkan nomor Invoice. Untuk saat ini kami mendukung pembayaran langsung di tempat (COD) atau Transfer Bank secara manual (akan diinfokan lewat WhatsApp).</p>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 flex flex-col md:flex-row gap-8 items-center">
                <div class="flex-shrink-0 w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-3xl font-bold">
                    5
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Tunggu Pesanan Tiba</h3>
                    <p class="text-gray-600">Duduk manis dan tunggu sayuran segar Anda tiba. Kami memastikan produk dikirim dengan aman untuk tetap menjaga kualitas kesegarannya.</p>
                </div>
            </div>
        </div>

        <div class="mt-16 text-center">
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-lg font-medium rounded-full shadow-sm text-white bg-green-600 hover:bg-green-700 transition transform hover:-translate-y-1">
                Mulai Belanja Sekarang
            </a>
        </div>
    </div>
</div>
@endsection
