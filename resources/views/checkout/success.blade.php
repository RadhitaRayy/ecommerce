@extends('layouts.app')

@section('title', 'Status Pesanan')

@section('content')
<div class="bg-slate-50 min-h-[90vh] py-16 flex items-center justify-center relative overflow-hidden">
    
    <!-- Background decorations -->
    <div class="absolute top-0 left-0 w-full h-96 bg-gradient-to-b from-green-50 to-slate-50 z-0"></div>
    <div class="absolute top-20 right-20 w-64 h-64 bg-green-200 rounded-full blur-3xl opacity-20 z-0 pointer-events-none"></div>
    <div class="absolute bottom-20 left-20 w-80 h-80 bg-emerald-200 rounded-full blur-3xl opacity-20 z-0 pointer-events-none"></div>

    <div class="max-w-3xl w-full mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="bg-white rounded-[2rem] shadow-xl border border-slate-100 overflow-hidden transform animate-fade-in-up">
            
            <!-- Header Section -->
            <div class="p-8 sm:p-12 text-center bg-gradient-to-b from-white to-slate-50 border-b border-slate-100 relative">
                <div class="w-24 h-24 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm shadow-green-100 ring-8 ring-green-50">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                </div>
                
                @if($order->payment && $order->payment->status == 'pending')
                    <h1 class="text-3xl font-black text-slate-900 mb-3 tracking-tight">Menunggu Pembayaran!</h1>
                    <p class="text-slate-500 font-medium">Pesanan dengan nomor tagihan <strong class="text-slate-800">#{{ $order->invoice_num }}</strong> telah dibuat.</p>
                @else
                    <h1 class="text-3xl font-black text-slate-900 mb-3 tracking-tight">Pesanan Berhasil!</h1>
                    <p class="text-slate-500 font-medium">Terima kasih. Pesanan dengan Invoice <strong class="text-slate-800">#{{ $order->invoice_num }}</strong> akan segera kami proses.</p>
                @endif
            </div>

            <div class="p-8 sm:p-12">
                
                <!-- Payment Action Component -->
                <div class="bg-slate-50 border border-slate-200 rounded-3xl p-8 mb-10 text-center flex flex-col items-center shadow-inner relative overflow-hidden group">
                    <div class="absolute inset-0 bg-green-600 opacity-0 group-hover:opacity-[0.02] transition-opacity duration-300"></div>

                    <p class="text-slate-500 font-bold uppercase tracking-widest text-xs mb-2">Total Tagihan Pembayaran</p>
                    <p class="text-5xl font-black text-slate-900 mb-8 tracking-tight">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                    
                    @if($order->payment && $order->payment->status == 'pending')
                        <button id="pay-button" class="px-10 py-4 w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white text-lg font-bold rounded-full shadow-lg shadow-green-600/30 transition-all duration-300 transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-green-100">
                            Bayar Sekarang via Midtrans
                        </button>
                        
                        <div class="flex items-center gap-2 mt-5 text-sm font-medium text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            Koneksi aman terenkripsi 256-bit
                        </div>
                    @elseif($order->payment && $order->payment->status == 'settlement' || $order->status == 'paid')
                        <span class="inline-flex items-center gap-2 px-6 py-3 rounded-full text-base font-bold bg-emerald-100 text-emerald-800 border border-emerald-200 shadow-sm animate-pulse-soft">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Pembayaran Telah Lunas
                        </span>
                    @endif
                </div>

                <!-- Delivery Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">
                        <div class="flex items-center gap-3 mb-4 border-b border-slate-100 pb-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <h3 class="font-bold text-slate-900">Alamat Tujuan</h3>
                        </div>
                        <div class="text-sm text-slate-600 space-y-2">
                            @if($order->address)
                                <p class="font-bold text-slate-900">{{ $order->address->recipient_name }}</p>
                                <p class="text-slate-500">{{ $order->address->phone }}</p>
                                <p class="mt-2">{{ $order->address->address }}</p>
                                <p>{{ $order->address->district }}, {{ $order->address->city }}</p>
                                <p>{{ $order->address->province }}</p>
                            @else
                                <p class="italic text-slate-400">Detail alamat tidak tersedia.</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">
                        <div class="flex items-center gap-3 mb-4 border-b border-slate-100 pb-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                            <h3 class="font-bold text-slate-900">Kurir Pengiriman</h3>
                        </div>
                        <div class="text-sm text-slate-600">
                            <p class="font-bold text-slate-900 uppercase tracking-widest">{{ $order->courier }}</p>
                            <p class="text-slate-500 mt-1">Layanan: <span class="font-semibold">{{ $order->courier_service }}</span></p>
                            <div class="mt-4 bg-slate-50 p-3 rounded-xl border border-slate-100 inline-block w-full text-center">
                                <p class="font-semibold text-slate-800 text-xs uppercase tracking-wider">Estimasi Ongkir</p>
                                <p class="font-bold text-green-600">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Navigation -->
                <div class="mt-12 text-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-green-600 bg-slate-50 hover:bg-slate-100 px-6 py-3 rounded-full transition-colors border border-slate-200">
                        Kembali ke Dashboard & Status Pesanan 
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@if($order->payment && $order->payment->status == 'pending')
    <!-- Midtrans Snap JS -->
    @if(env('MIDTRANS_IS_PRODUCTION', false))
        <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    @else
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    @endif
    
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            snap.pay('{{ $order->payment->snap_token }}', {
                onSuccess: function(result){
                    window.location.href = "{{ route('dashboard') }}";
                },
                onPending: function(result){
                    window.location.href = "{{ route('dashboard') }}";
                },
                onError: function(result){
                    alert("Maaf, Transaksi Pembayaran Gagal!");
                }
            });
        };
    </script>
@endif
@endsection
