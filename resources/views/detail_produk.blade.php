@extends('layouts.app')

@section('title', $produk->nama)

@section('content')
    <div class="max-w-5xl mx-auto">
        <!-- Tombol Kembali -->
        <a href="/produk" class="inline-flex items-center text-gray-500 hover:text-blue-600 mb-6 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Kembali ke Katalog
        </a>

        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden flex flex-col md:flex-row">
            <!-- Bagian Gambar -->
            <div class="md:w-1/2 bg-gray-100 relative h-80 md:h-auto">
                @if($produk->gambar)
                    <img src="{{ asset('images/' . $produk->gambar) }}" alt="{{ $produk->nama }}" class="w-full h-full object-cover">
                @else
                    <div class="flex items-center justify-center w-full h-full text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Bagian Informasi -->
            <div class="md:w-1/2 p-8 md:p-10 flex flex-col">
                @if($produk->kategori)
                    <span class="inline-block bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full mb-3 w-max">
                        {{ $produk->kategori->nama_kategori }}
                    </span>
                @endif

                <h1 class="text-3xl font-extrabold text-gray-800 mb-2">{{ $produk->nama }}</h1>
                
                <div class="text-3xl font-black text-blue-600 mb-6">
                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                </div>

                <div class="border-t border-gray-100 pt-6 mb-6">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Deskripsi Produk</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $produk->deskripsi ?? 'Tidak ada deskripsi untuk produk ini.' }}
                    </p>
                </div>

                <div class="mt-auto">
                    <form action="{{ route('keranjang.tambah', $produk->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-xl shadow-lg transition duration-300 flex items-center justify-center gap-3 text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" /></svg>
                            Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection