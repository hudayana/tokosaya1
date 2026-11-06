@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Header Dashboard -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Dashboard Admin</h1>
            <p class="text-gray-500">Selamat datang kembali, <span class="font-semibold text-blue-600">{{ Auth::user()->name }}</span>!</p>
        </div>

        <!-- Kartu Statistik & Aksi Cepat -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Kartu 1: Total Produk -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Produk</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ \App\Models\Produk::count() }}</h3>
                </div>
                <div class="bg-blue-50 text-blue-600 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            </div>

            <!-- Kartu 2: Total Kategori -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Kategori</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ \App\Models\Kategori::count() }}</h3>
                </div>
                <div class="bg-yellow-50 text-yellow-600 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                </div>
            </div>

            <!-- Kartu 3: Aksi Cepat Tambah Produk -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Aksi Cepat</p>
                    <a href="/produk/tambah" class="text-blue-600 font-semibold hover:underline">Tambah Produk &rarr;</a>
                </div>
                <div class="bg-green-50 text-green-600 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
            </div>

            <!-- Kartu 4: Kelola Kategori -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Kelola Kategori</p>
                    <a href="/kategori" class="text-blue-600 font-semibold hover:underline">Buka Kategori &rarr;</a>
                </div>
                <div class="bg-purple-50 text-purple-600 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </div>
            </div>
        </div>

                    <!-- Kartu 5: Riwayat Pesanan -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Riwayat Pesanan</p>
                    <a href="{{ route('admin.pesanan') }}" class="text-blue-600 font-semibold hover:underline">Lihat Pesanan &rarr;</a>
                </div>
                <div class="bg-orange-50 text-orange-600 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
            </div>
        
        <!-- Tombol Lihat Katalog (Full Width) -->
        <div class="mt-6">
            <a href="/produk" class="block w-full text-center bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-semibold py-3 rounded-xl shadow-sm transition duration-300">
                Lihat Halaman Katalog Produk &rarr;
            </a>
        </div>
    </div>
@endsection