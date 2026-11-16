<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Saya - @yield('title')</title>
    
    <!-- Script Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <!-- Navbar Modern -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="text-2xl font-black text-blue-600 tracking-tighter">Toko Saya.</a>
                </div>
                <!-- Menu -->
                <div class="hidden lg:flex items-center gap-4">
                    <a href="/" class="text-gray-600 hover:text-blue-600 font-medium transition">Beranda</a>
                    <a href="/tentang" class="text-gray-600 hover:text-blue-600 font-medium transition">Tentang Kami</a>
                    <a href="/produk" class="text-gray-600 hover:text-blue-600 font-medium transition">Produk</a>
                    
                    @guest
                        <a href="{{ route('keranjang.index') }}" class="text-gray-600 hover:text-blue-600 font-medium transition relative flex items-center gap-1">
                            Keranjang
                            @if(session('keranjang') && count(session('keranjang')) > 0)
                                <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                                    {{ count(session('keranjang')) }}
                                </span>
                            @endif
                        </a>
                    @else
                        @if(auth()->user()->role === 'pembeli')
                            <a href="{{ route('keranjang.index') }}" class="text-gray-600 hover:text-blue-600 font-medium transition relative flex items-center gap-1">
                                Keranjang
                                @if(session('keranjang') && count(session('keranjang')) > 0)
                                    <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                                        {{ count(session('keranjang')) }}
                                    </span>
                                @endif
                            </a>
                        @endif
                    @endguest
                    
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">Dashboard Admin</a>
                            <a href="/produk" class="text-gray-600 hover:text-blue-600 font-medium transition">Manajemen Produk</a>
                            <a href="{{ route('admin.pesanan') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">Manajemen Pesanan</a>
                        @elseif(auth()->user()->role === 'pembeli')
                            <a href="{{ route('pesanan.riwayat') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">Riwayat Pesanan</a>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">Profil</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium transition">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">Login</a>
                    @endauth
                </div>

                <details class="relative lg:hidden">
                    <summary class="flex h-10 w-10 cursor-pointer list-none items-center justify-center rounded-lg text-gray-600 hover:bg-gray-100" aria-label="Buka menu navigasi">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </summary>
                    <div class="absolute right-0 top-12 z-50 w-64 rounded-xl border border-gray-200 bg-white p-3 shadow-lg">
                        <div class="flex flex-col gap-1">
                            <a href="/" class="rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-50">Beranda</a>
                            <a href="/tentang" class="rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-50">Tentang Kami</a>
                            <a href="/produk" class="rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-50">Produk</a>
                            @guest
                                <a href="{{ route('keranjang.index') }}" class="rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-50">Keranjang</a>
                            @else
                                @if(auth()->user()->role === 'pembeli')
                                    <a href="{{ route('keranjang.index') }}" class="rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-50">Keranjang</a>
                                @endif
                            @endguest
                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('dashboard') }}" class="rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-50">Dashboard Admin</a>
                                    <a href="/produk" class="rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-50">Manajemen Produk</a>
                                    <a href="{{ route('admin.pesanan') }}" class="rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-50">Manajemen Pesanan</a>
                                @elseif(auth()->user()->role === 'pembeli')
                                    <a href="{{ route('pesanan.riwayat') }}" class="rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-50">Riwayat Pesanan</a>
                                @endif
                                <a href="{{ route('profile.edit') }}" class="rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-50">Profil</a>
                                <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-100 pt-2">
                                    @csrf
                                    <button type="submit" class="w-full rounded-lg px-3 py-2 text-left font-medium text-red-500 hover:bg-red-50">Logout</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-50">Login</a>
                            @endauth
                        </div>
                    </div>
                </details>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>

</body>
</html>