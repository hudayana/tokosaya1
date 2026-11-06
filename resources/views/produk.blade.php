@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <!-- Header Halaman -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Katalog Produk</h1>
            <p class="text-gray-500 mt-1">Temukan produk terbaik untuk Anda.</p>
        </div>
        <a href="/produk/tambah" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-300 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
            Tambah Produk
        </a>
    </div>
    
    <!-- Grid Produk -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @foreach($semua_produk as $p)
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-gray-100 flex flex-col">
                
                <!-- Bagian Gambar -->
                <div class="relative h-56 w-full bg-gray-100">
                    @if($p->gambar)
                        <img src="{{ asset('images/' . $p->gambar) }}" alt="{{ $p->nama }}" class="w-full h-full object-cover">
                    @else
                        <!-- Placeholder Modern jika tidak ada gambar -->
                        <div class="flex items-center justify-center w-full h-full text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Bagian Konten -->
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $p->nama }}</h3>
@if($p->kategori)
    <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-1 rounded mb-2">
        {{ $p->kategori->nama_kategori }}
    </span>
@endif
                    <p class="text-sm text-gray-500 mb-4 flex-grow line-clamp-2">{{ $p->deskripsi }}</p>
                    <div class="text-xl font-extrabold text-blue-600 mb-4">
                        Rp {{ number_format($p->harga, 0, ',', '.') }}
                    </div>

                    <!-- Tombol Tambah ke Keranjang (Bisa diakses publik) -->
<form action="{{ route('keranjang.tambah', $p->id) }}" method="POST" class="mt-2">
    @csrf
    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded-lg transition duration-300 flex items-center justify-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" /></svg>
        Tambah ke Keranjang
    </button>
</form>
                    
                    <!-- Tombol Aksi -->
                    <!-- Tombol Aksi -->
@auth
<div class="flex gap-3 mt-auto">
    <a href="/produk/{{ $p->id }}/edit" class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 rounded-lg transition duration-300">
        Edit
    </a>
    
    <form action="/produk/{{ $p->id }}" method="POST" class="flex-1">
        @csrf
        @method('DELETE')
        <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-600 font-semibold py-2 rounded-lg transition duration-300" onclick="return confirm('Yakin ingin menghapus produk ini?')">
            Hapus
        </button>
    </form>
</div>
@endauth
                </div>
            </div>
        @endforeach
    </div>
@endsection