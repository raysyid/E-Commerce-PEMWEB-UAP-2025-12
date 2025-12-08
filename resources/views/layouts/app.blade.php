<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Thriftsy') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-white">

    <!-- {{--  NAVBAR CUSTOM --}} -->
    <nav class="w-full flex items-center justify-between px-10 py-6 border-b bg-white">

        <!-- LOGO -->
        <a href="/" class="text-2xl font-bold tracking-wide">
            Thriftsy
        </a>

        <!-- USER -->
        <div class="flex items-center gap-2 text-sm font-medium text-gray-800">
            @auth
                <span>{{ auth()->user()->name }}</span>
            @else
                <span>Guest</span>
            @endauth

            <!-- Dropdown icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mt-0.5"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>

    </nav>

    <!-- --HEADER REGISTER STORE -- -->
    @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- {{-- ISI HALAMAN--}} -->
    <main class="min-h-screen bg-white">

        {{-- Untuk halaman model: <x-app-layout> --}}
        @isset($slot)
            {{ $slot }}
        @endisset

        {{-- Untuk halaman model: @extends --}}
        @yield('content')

    </main>

</body>
</html>
