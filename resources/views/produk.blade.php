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
    
    @php
        $productsByCategory = $semua_produk->groupBy('kategori_id');
    @endphp

    @if($productsByCategory->isEmpty())
        <div class="mx-auto max-w-2xl rounded-2xl border border-gray-100 bg-white p-10 text-center shadow-sm sm:p-16">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Produk Tidak Ditemukan</h3>
                <p class="text-gray-500">Maaf, kami tidak menemukan produk yang sesuai dengan pencarian Anda.</p>
                <a href="/produk" class="inline-block mt-4 text-blue-600 hover:underline font-semibold">Lihat Semua Produk</a>
        </div>
    @else
        <div class="space-y-10 sm:space-y-14">
            @foreach($productsByCategory as $categoryProducts)
                @php
                    $categoryName = $categoryProducts->first()->kategori?->nama_kategori ?? 'Produk lainnya';
                    $carouselId = 'product-carousel-' . $loop->index;
                @endphp

                <section class="min-w-0" aria-labelledby="category-title-{{ $loop->index }}">
                    <div class="mb-3 flex items-end justify-between gap-4 sm:mb-5">
                        <div class="min-w-0">
                            <p class="mb-1 text-xs font-semibold uppercase tracking-[0.16em] text-terracotta-600">Koleksi {{ sprintf('%02d', $loop->iteration) }}</p>
                            <h2 id="category-title-{{ $loop->index }}" class="truncate text-2xl font-extrabold tracking-tight text-gray-800 sm:text-3xl">{{ $categoryName }}</h2>
                            <p class="mt-1 text-sm text-gray-500">
                                {{ $categoryProducts->count() }} produk
                                <span class="sm:hidden">· Geser untuk melihat</span>
                            </p>
                        </div>

                        <div class="product-carousel-controls" data-carousel-controls="{{ $carouselId }}">
                            <button type="button" class="product-carousel-control" data-carousel-target="{{ $carouselId }}" data-carousel-direction="previous" aria-label="Geser {{ $categoryName }} ke kiri" aria-controls="{{ $carouselId }}">
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="m15 18-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <button type="button" class="product-carousel-control" data-carousel-target="{{ $carouselId }}" data-carousel-direction="next" aria-label="Geser {{ $categoryName }} ke kanan" aria-controls="{{ $carouselId }}">
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div id="{{ $carouselId }}" class="product-carousel" tabindex="0" aria-label="Produk kategori {{ $categoryName }}">
                        @foreach($categoryProducts as $p)
                            <article class="product-carousel__item overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition-shadow duration-300 hover:shadow-xl">
                                <a href="{{ route('produk.detail', $p->id) }}" class="group relative block h-48 overflow-hidden bg-gray-100 sm:h-52">
                                    @if($p->gambar)
                                        <img src="{{ asset('images/' . $p->gambar) }}" alt="{{ $p->nama }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </a>

                                <div class="flex min-h-[17rem] flex-col p-5 sm:p-6">
                                    <a href="{{ route('produk.detail', $p->id) }}" class="transition hover:text-terracotta-700">
                                        <h3 class="line-clamp-1 text-lg font-bold text-gray-800">{{ $p->nama }}</h3>
                                    </a>
                                    <p class="mt-2 line-clamp-2 min-h-10 flex-grow text-sm leading-5 text-gray-500">{{ $p->deskripsi }}</p>
                                    <div class="mb-4 mt-4 text-xl font-extrabold text-terracotta-600">
                                        Rp {{ number_format($p->harga, 0, ',', '.') }}
                                    </div>

                                    <form action="{{ route('keranjang.tambah', $p->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-terracotta-600 py-2.5 font-bold text-white shadow-sm transition duration-300 hover:bg-terracotta-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" /></svg>
                                            Tambah ke Keranjang
                                        </button>
                                    </form>

                                    @if(auth()->check() && auth()->user()->role == 'admin')
                                        <div class="mt-3 flex gap-3">
                                            <a href="/produk/{{ $p->id }}/edit" class="flex-1 rounded-lg bg-gray-100 py-2 text-center font-semibold text-gray-700 transition duration-300 hover:bg-gray-200">
                                                Edit
                                            </a>

                                            <form action="/produk/{{ $p->id }}" method="POST" class="flex-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full rounded-lg bg-red-50 py-2 font-semibold text-red-600 transition duration-300 hover:bg-red-100" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>
    @endif
@endsection