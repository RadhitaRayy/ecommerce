@extends('layouts.app')

@section('title', 'Checkout Pengiriman')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex items-center gap-3 mb-8">
            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Checkout Pesanan</h1>
        </div>

        @if(session('error'))
            <div class="mb-8 bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-2xl flex items-start gap-3 shadow-sm transform animate-fade-in-up" role="alert">
                <svg class="w-6 h-6 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div class="font-semibold text-sm">{{ session('error') }}</div>
            </div>
        @endif

        <div class="lg:grid lg:grid-cols-12 lg:gap-x-10 lg:items-start">
            <div class="lg:col-span-7 xl:col-span-8">
                <!-- Shipping Form Section -->
                <div class="bg-white shadow-sm border border-slate-100 rounded-[2rem] overflow-hidden p-6 sm:p-10">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center font-bold">1</div>
                        <h2 class="text-xl font-bold text-slate-900">Alamat Pengiriman</h2>
                    </div>

                    <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
                        @csrf
                        
                        <!-- Hidden inputs for calculated items -->
                        <input type="hidden" name="shipping_cost" id="hidden_shipping_cost" value="0">
                        <input type="hidden" name="grand_total" id="hidden_grand_total" value="{{ $total }}">
                        <input type="hidden" name="weight" id="weight" value="1000"> <!-- Default 1kg -->

                        <div class="grid grid-cols-1 gap-y-8 sm:grid-cols-2 sm:gap-x-6">
                            
                            <!-- Name -->
                            <div class="sm:col-span-2">
                                <label for="recipient_name" class="block text-sm font-bold text-slate-700 mb-2">Nama Penerima</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                    <input type="text" id="recipient_name" name="recipient_name" required value="{{ old('recipient_name') }}" class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 focus:bg-white rounded-xl text-sm transition-all focus:ring-4 focus:ring-green-100 focus:border-green-400 outline-none" placeholder="Masukkan nama lengkap">
                                </div>
                                @error('recipient_name') <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p> @enderror
                            </div>

                            <!-- Phone -->
                            <div class="sm:col-span-2">
                                <label for="phone" class="block text-sm font-bold text-slate-700 mb-2">Nomor WhatsApp / Telepon</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                    <input type="tel" id="phone" name="phone" required value="{{ old('phone') }}" class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 focus:bg-white rounded-xl text-sm transition-all focus:ring-4 focus:ring-green-100 focus:border-green-400 outline-none" placeholder="Contoh: 081234567890">
                                </div>
                                @error('phone') <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p> @enderror
                            </div>

                            <!-- Destination Search -->
                            <div class="sm:col-span-2 relative">
                                <label for="destination_search" class="block text-sm font-bold text-slate-700 mb-2">Kecamatan / Kota / Kabupaten Tujuan</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    </div>
                                    <input type="text" id="destination_search" autocomplete="off" placeholder="Ketik minimal 3 huruf kecamatan atau kota..." class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 focus:bg-white rounded-xl text-sm transition-all focus:ring-4 focus:ring-green-100 focus:border-green-400 outline-none">
                                    
                                    <!-- Search Results Dropdown -->
                                    <ul id="destination_results" class="absolute z-20 mt-2 w-full bg-white shadow-2xl rounded-2xl border border-slate-100 py-2 text-sm overflow-auto max-h-64 hidden origin-top animate-fade-in-up">
                                    </ul>
                                </div>
                                <div class="mt-3 flex items-start gap-2 hidden" id="selected_destination_label">
                                    <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <p class="text-sm text-green-700 font-bold leading-snug" id="selected_destination_text"></p>
                                </div>
                                
                                <!-- Hidden inputs for CheckoutController -->
                                <input type="hidden" name="city_id" id="city_id" required>
                                <input type="hidden" name="province_name" id="province_name">
                                <input type="hidden" name="city_name" id="city_name">
                                <input type="hidden" name="district_name" id="district_name">
                                <input type="hidden" name="zip_code" id="zip_code">
                            </div>

                            <!-- Full Address -->
                            <div class="sm:col-span-2">
                                <label for="address" class="block text-sm font-bold text-slate-700 mb-2">Alamat Detail (Jalan, RT/RW, Blok, Patokan)</label>
                                <textarea id="address" name="address" rows="3" required placeholder="Contoh: Jl. Merdeka No 12, RT 01/RW 02, Patokan: Sebelah Masjid Raya" class="block w-full p-4 bg-slate-50 border border-slate-200 focus:bg-white rounded-xl text-sm transition-all focus:ring-4 focus:ring-green-100 focus:border-green-400 outline-none leading-relaxed">{{ old('address') }}</textarea>
                                @error('address') <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p> @enderror
                            </div>

                            <!-- Courier -->
                            <div class="sm:col-span-1">
                                <label for="courier" class="block text-sm font-bold text-slate-700 mb-2">Pilih Kurir</label>
                                <div class="relative">
                                    <select id="courier" name="courier" required disabled class="block w-full pl-4 pr-10 py-3.5 bg-slate-50 border border-slate-200 focus:bg-white rounded-xl text-sm transition-all focus:ring-4 focus:ring-green-100 focus:border-green-400 outline-none disabled:opacity-50 disabled:cursor-not-allowed appearance-none cursor-pointer">
                                        <option value="">Pilih Kurir Ekspedisi</option>
                                        <option value="jne">JNE Express</option>
                                        <option value="pos">POS Indonesia</option>
                                        <option value="tiki">TIKI</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Courier Service -->
                            <div class="sm:col-span-1">
                                <label for="courier_service_select" class="block text-sm font-bold text-slate-700 mb-2">Layanan Pengiriman</label>
                                <div class="relative">
                                    <select id="courier_service_select" required disabled class="block w-full pl-4 pr-10 py-3.5 bg-slate-50 border border-slate-200 focus:bg-white rounded-xl text-sm transition-all focus:ring-4 focus:ring-green-100 focus:border-green-400 outline-none disabled:opacity-50 disabled:cursor-not-allowed appearance-none cursor-pointer">
                                        <option value="">Pilih Layanan</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                    <input type="hidden" name="courier_service" id="courier_service_hidden">
                                </div>
                            </div>

                            <!-- Notes -->
                            <div class="sm:col-span-2">
                                <label for="notes" class="block text-sm font-bold text-slate-700 mb-2">Catatan Pesanan (Opsional)</label>
                                <textarea id="notes" name="notes" rows="2" placeholder="Catatan tambahan untuk kurir atau penjual..." class="block w-full p-4 bg-slate-50 border border-slate-200 focus:bg-white rounded-xl text-sm transition-all focus:ring-4 focus:ring-green-100 focus:border-green-400 outline-none">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="mt-10 lg:mt-0 lg:col-span-5 xl:col-span-4">
                <div class="bg-white shadow-sm border border-slate-100 rounded-[2rem] p-6 sm:p-8 sticky top-28">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-slate-100 text-slate-700 flex items-center justify-center font-bold">2</div>
                        <h2 class="text-xl font-bold text-slate-900">Pesanan Anda</h2>
                    </div>

                    <!-- Cart Items Preview -->
                    <ul role="list" class="divide-y divide-slate-100 my-6 max-h-[30vh] overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($cart as $id => $details)
                            <li class="flex py-4 group">
                                <div class="flex-shrink-0">
                                    @if($details['image'])
                                        <img src="{{ Storage::url($details['image']) }}" alt="{{ $details['name'] }}" class="w-16 h-16 rounded-xl object-cover object-center border border-slate-100 bg-slate-50">
                                    @else
                                        <div class="w-16 h-16 rounded-xl border border-slate-100 flex items-center justify-center bg-slate-50 text-slate-300">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>

                                <div class="ml-4 flex-1 flex flex-col justify-center">
                                    <div class="flex justify-between items-start">
                                        <h4 class="text-sm font-bold text-slate-800 line-clamp-2 pr-4">{{ $details['name'] }}</h4>
                                        <p class="text-sm font-black text-slate-900 whitespace-nowrap">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</p>
                                    </div>
                                    <p class="mt-1 text-xs font-semibold text-slate-500">{{ $details['quantity'] }} &times; Rp {{ number_format($details['price'], 0, ',', '.') }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Subtotals -->
                    <dl class="space-y-4 border-t border-slate-100 pt-6">
                        <div class="flex items-center justify-between">
                            <dt class="text-sm font-medium text-slate-500">Subtotal Produk</dt>
                            <dd class="text-sm font-bold text-slate-900" id="summary_subtotal" data-value="{{ $total }}">Rp {{ number_format($total, 0, ',', '.') }}</dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt class="text-sm font-medium text-slate-500">Estimasi Ongkir</dt>
                            <dd class="text-sm font-bold text-slate-900" id="summary_shipping"><span class="text-slate-400 italic font-normal">Pilih kurir...</span></dd>
                        </div>
                        
                        <!-- Decorative dashed line -->
                        <div class="w-full h-px border-t-2 border-dashed border-slate-200 my-2"></div>
                        
                        <div class="flex items-center justify-between pt-2">
                            <dt class="text-base font-black text-slate-900">Total Pembayaran</dt>
                            <dd class="text-2xl font-black text-green-600" id="summary_total">Rp {{ number_format($total, 0, ',', '.') }}</dd>
                        </div>
                    </dl>

                    <div class="mt-8">
                        <button type="submit" form="checkout-form" id="btn-submit" disabled class="w-full bg-green-600 border border-transparent rounded-full shadow-lg shadow-green-600/30 py-4 px-4 text-base font-bold text-white hover:bg-green-700 hover:shadow-xl hover:shadow-green-700/40 focus:outline-none focus:ring-4 focus:ring-green-100 flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none disabled:shadow-none">
                            Isi Form & Hitung Ongkir
                        </button>
                        
                        <div class="mt-4 flex items-center justify-center gap-2 text-xs font-medium text-slate-400">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            Pembayaran Aman Terenkripsi via Midtrans
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom scrollbar class for the tiny cart preview */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background-color: #cbd5e1;
    border-radius: 20px;
}
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('destination_search');
        const resultsBox = document.getElementById('destination_results');
        const selectedLabel = document.getElementById('selected_destination_label');
        const selectedLabelText = document.getElementById('selected_destination_text');
        
        const cityIdHidden = document.getElementById('city_id');
        const provinceHidden = document.getElementById('province_name');
        const cityHidden = document.getElementById('city_name');
        const districtHidden = document.getElementById('district_name');
        const zipHidden = document.getElementById('zip_code');

        const courierSelect = document.getElementById('courier');
        const serviceSelect = document.getElementById('courier_service_select');
        const serviceHidden = document.getElementById('courier_service_hidden');
        
        const summaryShipping = document.getElementById('summary_shipping');
        const summaryTotal = document.getElementById('summary_total');
        const hiddenShippingCost = document.getElementById('hidden_shipping_cost');
        const hiddenGrandTotal = document.getElementById('hidden_grand_total');
        const btnSubmit = document.getElementById('btn-submit');
        
        const subtotal = parseInt(document.getElementById('summary_subtotal').dataset.value);
        let availableServices = [];
        let debounceTimer;

        // Format number to Rupiah
        const formatRupiah = (number) => {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
        };

        // Autocomplete Search
        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const query = this.value.trim();
            
            if (query.length < 3) {
                resultsBox.classList.add('hidden');
                return;
            }

            debounceTimer = setTimeout(() => {
                fetch(`{{ route('api.destinations') }}?search=${encodeURIComponent(query)}`)
                    .then(res => res.json())
                    .then(data => {
                        resultsBox.innerHTML = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                const li = document.createElement('li');
                                li.className = 'cursor-pointer select-none relative py-3 pl-4 pr-9 hover:bg-green-50 text-slate-800 border-b border-slate-100 last:border-0 transition-colors';
                                li.innerHTML = `<span class="block font-bold truncate">${item.subdistrict_name}, ${item.city_name}</span>
                                                <span class="block text-xs text-slate-500 font-medium truncate mt-0.5">${item.label}</span>`;
                                
                                li.addEventListener('click', () => {
                                    // Set Hidden Inputs
                                    cityIdHidden.value = item.id;
                                    provinceHidden.value = item.province_name;
                                    cityHidden.value = item.city_name;
                                    districtHidden.value = item.district_name;
                                    zipHidden.value = item.zip_code;

                                    // Update UI
                                    searchInput.value = item.label;
                                    selectedLabelText.innerText = item.label;
                                    selectedLabel.classList.remove('hidden');
                                    resultsBox.classList.add('hidden');
                                    
                                    // Enable courier
                                    courierSelect.disabled = false;
                                    courierSelect.value = "";
                                    
                                    // Reset services
                                    serviceSelect.innerHTML = '<option value="">Pilih Layanan Ekspedisi</option>';
                                    serviceSelect.disabled = true;
                                    resetShipping();
                                });
                                resultsBox.appendChild(li);
                            });
                            resultsBox.classList.remove('hidden');
                        } else {
                            resultsBox.innerHTML = '<li class="text-slate-500 italic py-4 px-4 text-sm font-medium text-center">Lokasi tidak ditemukan...</li>';
                            resultsBox.classList.remove('hidden');
                        }
                    });
            }, 500); 
        });

        // Hide dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !resultsBox.contains(e.target)) {
                resultsBox.classList.add('hidden');
            }
        });

        // Allow clearing input
        searchInput.addEventListener('change', function() {
            if(this.value === '') {
                cityIdHidden.value = '';
                selectedLabel.classList.add('hidden');
                courierSelect.value = '';
                courierSelect.disabled = true;
                serviceSelect.innerHTML = '<option value="">Pilih Layanan</option>';
                serviceSelect.disabled = true;
                resetShipping();
            }
        });

        // Load Costs when Courier changes
        courierSelect.addEventListener('change', function() {
            const cityId = cityIdHidden.value;
            const courier = this.value;
            const weight = document.getElementById('weight').value;
            
            serviceSelect.innerHTML = '<option value="">Sedang memuat harga...</option>';
            serviceSelect.disabled = true;
            resetShipping();

            if (cityId && courier) {
                fetch('{{ route("api.cost") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        destination: cityId,
                        weight: weight,
                        courier: courier
                    })
                })
                .then(res => res.json())
                .then(data => {
                    serviceSelect.innerHTML = '<option value="">Pilih Layanan</option>';
                    if (data && data.length > 0) {
                        availableServices = data;
                        serviceSelect.disabled = false;
                        
                        availableServices.forEach((service, index) => {
                            const cost = service.cost;
                            const etd = service.etd ? ` (Estimasi: ${service.etd})` : '';
                            const option = document.createElement('option');
                            option.value = index; 
                            option.text = `${service.service} - ${formatRupiah(cost)}${etd}`;
                            serviceSelect.add(option);
                        });
                    } else {
                        serviceSelect.innerHTML = '<option value="">Layanan logistik tidak tersedia</option>';
                        serviceSelect.disabled = true;
                    }
                })
                .catch(err => {
                    serviceSelect.innerHTML = '<option value="">Gagal mendapatkan ongkir</option>';
                    serviceSelect.disabled = true;
                    console.error(err);
                });
            }
        });

        // Update Totals when Service changes
        serviceSelect.addEventListener('change', function() {
            if (this.value !== "") {
                const service = availableServices[this.value];
                const cost = service.cost;
                
                serviceHidden.value = service.service;
                hiddenShippingCost.value = cost;
                hiddenGrandTotal.value = subtotal + cost;
                
                summaryShipping.innerText = formatRupiah(cost);
                summaryTotal.innerText = formatRupiah(subtotal + cost);
                
                btnSubmit.disabled = false;
                btnSubmit.innerHTML = `Lanjutkan Pembayaran <svg class="ml-2 -mr-1 w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>`;
            } else {
                serviceHidden.value = "";
                resetShipping();
            }
        });

        function resetShipping() {
            hiddenShippingCost.value = 0;
            hiddenGrandTotal.value = subtotal;
            summaryShipping.innerHTML = '<span class="text-slate-400 italic font-normal">Pilih kurir...</span>';
            summaryTotal.innerText = formatRupiah(subtotal);
            btnSubmit.disabled = true;
            btnSubmit.innerText = "Isi Form & Hitung Ongkir";
        }
    });
</script>
@endpush
@endsection
