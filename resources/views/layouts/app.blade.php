<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Saya - @yield('title')</title>
    <meta name="theme-color" content="#FDFBF7">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cream text-espresso font-sans antialiased">

    <!-- Navbar Modern -->
    <nav class="site-navigation sticky top-0 z-50 border-b bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-[4.5rem] items-center justify-between gap-4">
                <div class="flex shrink-0 items-center">
                    <a href="/" class="site-brand rounded-xl focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-terracotta-700">
                        <span class="site-brand__mark" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M4.75 9.25h14.5l-1.1 10.1a1.5 1.5 0 0 1-1.49 1.34H7.59a1.5 1.5 0 0 1-1.49-1.34l-1.35-12.4A1.5 1.5 0 0 0 3.26 5.6H2.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 9.25V6.5a3 3 0 0 1 6 0v2.75" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                            </svg>
                        </span>
                        <span class="text-xl font-extrabold tracking-tight">Toko Saya<span class="text-terracotta-600">.</span></span>
                    </a>
                </div>

                <div class="hidden items-center gap-1 xl:flex">
                    <a href="/" class="site-nav-link">Beranda</a>
                    <a href="/tentang" class="site-nav-link">Tentang</a>
                    <a href="/produk" class="site-nav-link">Produk</a>

                    @if(!auth()->check() || auth()->user()->role === 'pembeli')
                        <a href="{{ route('keranjang.index') }}" class="site-nav-link relative">
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M4.75 9.25h14.5l-1.1 10.1a1.5 1.5 0 0 1-1.49 1.34H7.59a1.5 1.5 0 0 1-1.49-1.34l-1.35-12.4A1.5 1.5 0 0 0 3.26 5.6H2.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 9.25V6.5a3 3 0 0 1 6 0v2.75" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                            </svg>
                            Keranjang
                            @if(session('keranjang') && count(session('keranjang')) > 0)
                                <span class="rounded-full bg-red-500 px-2 py-0.5 text-xs font-bold text-white">
                                    {{ count(session('keranjang')) }}
                                </span>
                            @endif
                        </a>
                    @endif

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('dashboard') }}" class="site-nav-link">Dashboard</a>
                            <a href="/kategori" class="site-nav-link">Kategori</a>
                            <a href="{{ route('admin.pesanan') }}" class="site-nav-link">Pesanan</a>
                        @elseif(auth()->user()->role === 'pembeli')
                            <a href="{{ route('pesanan.riwayat') }}" class="site-nav-link">Pesanan</a>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="site-nav-link">Profil</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="site-nav-link">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="site-nav-link">Masuk</a>
                    @endauth
                </div>

                <details class="site-menu relative xl:hidden">
                    <summary class="flex h-11 w-11 cursor-pointer items-center justify-center rounded-xl text-gray-700 hover:bg-gray-100" aria-label="Buka menu navigasi">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </summary>
                    <div class="site-menu__panel absolute right-0 top-14 z-50 w-72 max-w-[calc(100vw-2rem)] rounded-2xl border p-3">
                        <div class="flex flex-col gap-1">
                            <a href="/" class="site-menu-link">Beranda</a>
                            <a href="/tentang" class="site-menu-link">Tentang</a>
                            <a href="/produk" class="site-menu-link">Produk</a>
                            @if(!auth()->check() || auth()->user()->role === 'pembeli')
                                <a href="{{ route('keranjang.index') }}" class="site-menu-link">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M4.75 9.25h14.5l-1.1 10.1a1.5 1.5 0 0 1-1.49 1.34H7.59a1.5 1.5 0 0 1-1.49-1.34l-1.35-12.4A1.5 1.5 0 0 0 3.26 5.6H2.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M9 9.25V6.5a3 3 0 0 1 6 0v2.75" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                                    </svg>
                                    Keranjang
                                    @if(session('keranjang') && count(session('keranjang')) > 0)
                                        <span class="ml-auto rounded-full bg-red-500 px-2 py-0.5 text-xs font-bold text-white">
                                            {{ count(session('keranjang')) }}
                                        </span>
                                    @endif
                                </a>
                            @endif
                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('dashboard') }}" class="site-menu-link">Dashboard</a>
                                    <a href="/kategori" class="site-menu-link">Kategori</a>
                                    <a href="{{ route('admin.pesanan') }}" class="site-menu-link">Pesanan</a>
                                @elseif(auth()->user()->role === 'pembeli')
                                    <a href="{{ route('pesanan.riwayat') }}" class="site-menu-link">Pesanan</a>
                                @endif
                                <a href="{{ route('profile.edit') }}" class="site-menu-link">Profil</a>
                                <form method="POST" action="{{ route('logout') }}" class="mt-1 border-t border-gray-100 pt-2">
                                    @csrf
                                    <button type="submit" class="site-menu-link w-full text-left text-red-600">Keluar</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="site-menu-link">Masuk</a>
                            @endauth
                        </div>
                    </div>
                </details>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="site-main max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @isset($header)
            <header class="mb-8 rounded-2xl border border-gray-100 bg-white px-6 py-5 shadow-sm sm:px-8">
                {{ $header }}
            </header>
        @endisset

        @isset($slot)
            {{ $slot }}
        @else
            @yield('content')
        @endisset
    </main>

</body>
</html>