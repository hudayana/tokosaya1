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
                <div class="flex space-x-8 items-center">
                    <a href="/" class="text-gray-600 hover:text-blue-600 font-medium transition">Beranda</a>
                    <a href="/tentang" class="text-gray-600 hover:text-blue-600 font-medium transition">Tentang Kami</a>
                    <a href="/produk" class="text-gray-600 hover:text-blue-600 font-medium transition">Produk</a>
                    
                    <!-- MENU KERANJANG DITAMBAHKAN DI SINI -->
                    <a href="{{ route('keranjang.index') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">Keranjang</a>
                    
                    @auth
                        <!-- Tampil jika sudah login -->
                        <a href="/dashboard" class="text-gray-600 hover:text-blue-600 font-medium transition">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium transition">Logout</button>
                        </form>
                    @else
                        <!-- Tampil jika belum login -->
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>

</body>
</html>