<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Toko Saya') }}</title>
        <meta name="theme-color" content="#FDFBF7">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-cream font-sans text-espresso antialiased">
        @if (request()->routeIs('login', 'register'))
            <div class="min-h-screen bg-slate-50 px-4 py-6 sm:px-6 lg:flex lg:items-center lg:justify-center lg:p-10">
                {{ $slot }}
            </div>
        @else
            <div class="min-h-screen flex flex-col sm:justify-center items-center px-4 py-8 sm:pt-0 bg-gray-100">
                <div>
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </div>

                <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-2xl">
                    {{ $slot }}
                </div>
            </div>
        @endif
    </body>
</html>
