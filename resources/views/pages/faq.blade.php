@extends('layouts.app')

@section('title', 'FAQ (Tanya Jawab)')

@section('content')
<div class="bg-white min-h-screen py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Pertanyaan yang Sering Diajukan</h1>
            <p class="mt-4 text-lg text-gray-500">Temukan jawaban atas beberapa pertanyaan umum tentang SayurFresh.</p>
        </div>

        <div class="space-y-8">
            <!-- FAQ 1 -->
            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-2">Bagaimana cara memastikan kualitas dan kesegaran sayuran?</h3>
                <p class="text-gray-600">SayurFresh bekerja sama langsung dengan para petani lokal yang memanen produk mereka setiap pagi. Kami hanya menyortir dan mengirimkan produk dengan kualitas Grade A. Pesanan Anda akan dikemas dengan aman dan diantar di hari yang sama untuk menjaga kesegarannya.</p>
            </div>

            <!-- FAQ 2 -->
            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-2">Apa saja metode pembayaran yang diterima?</h3>
                <p class="text-gray-600">Saat ini, kami melayani sistem Cash on Delivery (COD/Bayar di Tempat) dan Transfer Bank Manual. Informasi nomor rekening akan kami informasikan melalui pesan WhatsApp setelah Anda melakukan pemesanan (checkout).</p>
            </div>

            <!-- FAQ 3 -->
            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-2">Daerah mana saja yang masuk dalam jangkauan pengiriman?</h3>
                <p class="text-gray-600">Untuk saat ini, jangkauan pengiriman SayurFresh masih terbatas pada area Jabodetabek (Jakarta, Bogor, Depok, Tangerang, Bekasi). Kami sedang berusaha keras untuk segera menjangkau kota-kota lainnya di Indonesia!</p>
            </div>

            <!-- FAQ 4 -->
            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-2">Bagaimana jika produk yang dikirim rusak atau tidak segar?</h3>
                <p class="text-gray-600">Kepuasan Anda adalah prioritas kami. Jika Anda menerima barang yang tidak segar, rusak, atau salah pesanan, harap segera hubungi Customer Service kami dalam waktu maksimal 3 jam setelah pesanan diterima. Kami akan melakukan investigasi dan jika terbukti, kami akan memberikan pengembalian dana atau penggantian produk.</p>
            </div>

            <!-- FAQ 5 -->
            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-2">Apakah ada batas minimal belanja atau minimal biaya pengiriman?</h3>
                <p class="text-gray-600">Tidak ada batas minimum pembelanjaan di platform kami. Namun, kami menerapkan Flat Rate Shipping (biaya antar tetap) sebesar Rp 15.000 untuk pengiriman ke seluruh daerah cakupan kami.</p>
            </div>
        </div>

        <div class="mt-16 text-center border-t border-gray-200 pt-12">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Masih punya pertanyaan?</h3>
            <p class="text-gray-600 mb-6">Jika Anda tidak dapat menemukan jawaban atas pertanyaan Anda, silakan hubungi tim dukungan pelanggan kami.</p>
            <a href="{{ route('pages.contact') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Hubungi Kami Sekarang
            </a>
        </div>
    </div>
</div>
@endsection
