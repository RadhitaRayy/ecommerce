<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'eCommerce Sayur') }} - @yield('title', 'Belanja Sayur Segar')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Alpine.js for Interactions -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900 selection:bg-green-500 selection:text-white min-h-screen flex flex-col">
        <!-- Navbar -->
        @include('partials.navbar')

        <!-- Page Content -->
        <main class="flex-grow w-full">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('partials.footer')
        
        @stack('scripts')
    </body>
</html>
