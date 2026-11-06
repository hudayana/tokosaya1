@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-gray-100 mt-8">
        <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 tracking-tight mb-6">
            Selamat Datang di <span class="text-blue-600">Toko Saya.</span>
        </h1>
        <p class="text-lg md:text-xl text-gray-500 max-w-2xl mx-auto mb-10 px-4">
            Temukan produk berkualitas dengan harga terbaik. Kami menyediakan berbagai kebutuhan untuk Anda.
        </p>
        <div class="flex justify-center gap-4">
            <a href="/produk" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition duration-300 transform hover:-translate-y-1">
                Lihat Produk
            </a>
            <a href="/tentang" class="bg-white hover:bg-gray-50 text-gray-700 font-bold py-3 px-8 rounded-xl shadow-sm border border-gray-200 transition duration-300">
                Tentang Kami
            </a>
        </div>
    </div>

    <!-- Fitur Unggulan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16 mb-12">
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 text-center">
            <div class="text-blue-600 text-3xl mb-4">🛍️</div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Produk Berkualitas</h3>
            <p class="text-sm text-gray-500">Barang yang kami jual telah melewati seleksi ketat.</p>
        </div>
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 text-center">
            <div class="text-blue-600 text-3xl mb-4">🚚</div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Pengiriman Cepat</h3>
            <p class="text-sm text-gray-500">Pesanan Anda akan dikirim dengan aman dan cepat.</p>
        </div>
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 text-center">
            <div class="text-blue-600 text-3xl mb-4">💬</div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Layanan 24/7</h3>
            <p class="text-sm text-gray-500">Tim kami siap membantu Anda kapan pun dibutuhkan.</p>
        </div>
    </div>
@endsection