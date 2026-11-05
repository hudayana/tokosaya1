<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Saya - @yield('title')</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f3f4f6; }
        .navbar { background-color: #1f2937; padding: 15px 30px; display: flex; gap: 20px; }
        .navbar a { color: white; text-decoration: none; font-weight: bold; }
        .navbar a:hover { color: #ff2d20; }
        .container { max-width: 800px; margin: 40px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    <!-- Ini adalah Navbar yang akan muncul di semua halaman -->
    <div class="navbar">
        <a href="/">Beranda</a>
        <a href="/tentang">Tentang Kami</a>
    </div>

    <!-- Ini adalah tempat di mana isi halaman akan dimasukkan -->
    <div class="container">
        @yield('content')
    </div>

</body>
</html>