@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <!-- Header & Form Pencarian -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Katalog Produk</h1>
                <p class="text-gray-500 mt-1">Temukan produk terbaik untuk Anda.</p>
            </div>
            
            <!-- Tombol Tambah Produk (Hanya Admin) -->
            @if(auth()->check() && auth()->user()->role == 'admin')
                <a href="/produk/tambah" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-300 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                    Tambah Produk
                </a>
            @endif
        </div>

        <!-- FORM PENCARIAN & FILTER -->
        <form action="/produk" method="GET" class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col sm:flex-row gap-3">
            <div class="relative flex-grow">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..." class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <select name="kategori" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white sm:w-48">
                <option value="">Semua Kategori</option>
                @foreach($semua_kategori as $k)
                    <option value="{{ $k->id }}" {{ request('kategori') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>

            <div class="flex gap-2">
                <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-semibold py-2 px-6 rounded-lg transition">
                    Cari
                </button>
                @if(request('search') || request('kategori'))
                    <a href="/produk" class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-semibold py-2 px-4 rounded-lg transition flex items-center justify-center" title="Reset Pencarian">
                        &times;
                    </a>
                @endif
            </div>
        </form>
    </div>
    
    <!-- Grid Produk -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @forelse($semua_produk as $p)
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-gray-100 flex flex-col">
                
                <!-- Bagian Gambar (Bisa Diklik) -->
                <a href="{{ route('produk.detail', $p->id) }}" class="relative h-56 w-full bg-gray-100 block overflow-hidden group">
                    @if($p->gambar)
                        <img src="{{ asset('images/' . $p->gambar) }}" alt="{{ $p->nama }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="flex items-center justify-center w-full h-full text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                </a>

                <!-- Bagian Konten -->
                <div class="p-6 flex flex-col flex-grow">
                    <a href="{{ route('produk.detail', $p->id) }}" class="hover:text-blue-600 transition">
                        <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $p->nama }}</h3>
                    </a>
                    @if($p->kategori)
                        <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-1 rounded mb-2 w-max">
                            {{ $p->kategori->nama_kategori }}
                        </span>
                    @endif
                    <p class="text-sm text-gray-500 mb-4 flex-grow line-clamp-2">{{ $p->deskripsi }}</p>
                    <div class="text-xl font-extrabold text-blue-600 mb-4">
                        Rp {{ number_format($p->harga, 0, ',', '.') }}
                    </div>

                    <!-- Tombol Tambah ke Keranjang -->
                    <form action="{{ route('keranjang.tambah', $p->id) }}" method="POST" class="mt-auto">
                        @csrf
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded-lg transition duration-300 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" /></svg>
                            Tambah ke Keranjang
                        </button>
                    </form>
                    
                    <!-- Tombol Edit & Hapus (Hanya Admin) -->
                    @if(auth()->check() && auth()->user()->role == 'admin')
                        <div class="flex gap-3 mt-3">
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
                    @endif
                </div>
            </div>
        @empty
            <!-- Pesan Jika Produk Tidak Ditemukan -->
            <div class="col-span-full bg-white rounded-2xl shadow-sm border border-gray-100 p-16 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Produk Tidak Ditemukan</h3>
                <p class="text-gray-500">Maaf, kami tidak menemukan produk yang sesuai dengan pencarian Anda.</p>
                <a href="/produk" class="inline-block mt-4 text-blue-600 hover:underline font-semibold">Lihat Semua Produk</a>
            </div>
        @endforelse
    </div>
@endsection