@extends('layouts.app')

@section('title', 'Hubungi Kami')

@section('content')
<div class="bg-gray-50 min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Hubungi Kami</h1>
            <p class="mt-4 text-lg text-gray-500">Apakah Anda memiliki pertanyaan atau masukan? Jangan ragu untuk menghubungi kami!</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <!-- Contact Info -->
                <div class="bg-green-600 p-8 sm:p-12 text-white flex flex-col justify-center">
                    <h3 class="text-2xl font-bold mb-6">Informasi Kontak</h3>
                    <p class="text-green-100 mb-8">Tim support kami selalu siap sedia membantu Anda dari hari Senin hingga Sabtu pada pukul 08:00 - 18:00 WIB.</p>
                    
                    <ul class="space-y-6">
                        <li class="flex items-start gap-4">
                            <div class="flex-shrink-0 bg-green-500 p-3 rounded-full">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Alamat Kantor</h4>
                                <p class="text-green-100 mt-1">Gedung SayurFresh Lt. 4<br>Jl. Jenderal Sudirman Kav. 12<br>Selatan Jakarta 12190</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="flex-shrink-0 bg-green-500 p-3 rounded-full">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Alamat Email</h4>
                                <p class="text-green-100 mt-1">support@sayurfresh.com<br>info@sayurfresh.com</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="flex-shrink-0 bg-green-500 p-3 rounded-full">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Telepon / WhatsApp</h4>
                                <p class="text-green-100 mt-1">CS: +62 812 3456 7890<br>(021) 500-SAYUR</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Contact Form -->
                <div class="p-8 sm:p-12">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h3>
                    
                    <form action="#" method="POST" class="space-y-6" onsubmit="event.preventDefault(); alert('Terima kasih! Pesan Anda telah terkirim.');">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700">Nama Depan</label>
                                <div class="mt-1">
                                    <input type="text" name="first_name" id="first_name" required class="py-3 px-4 block w-full shadow-sm focus:ring-green-500 focus:border-green-500 border-gray-300 rounded-md">
                                </div>
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700">Nama Belakang</label>
                                <div class="mt-1">
                                    <input type="text" name="last_name" id="last_name" required class="py-3 px-4 block w-full shadow-sm focus:ring-green-500 focus:border-green-500 border-gray-300 rounded-md">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email" required class="py-3 px-4 block w-full shadow-sm focus:ring-green-500 focus:border-green-500 border-gray-300 rounded-md">
                            </div>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                            <div class="mt-1">
                                <input type="text" name="phone" id="phone" class="py-3 px-4 block w-full shadow-sm focus:ring-green-500 focus:border-green-500 border-gray-300 rounded-md">
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Pesan Anda</label>
                            <div class="mt-1">
                                <textarea id="message" name="message" rows="4" required class="py-3 px-4 block w-full shadow-sm focus:ring-green-500 focus:border-green-500 border border-gray-300 rounded-md"></textarea>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Kirim Pesan Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
