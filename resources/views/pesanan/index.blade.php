@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
    <div class="mx-auto max-w-5xl">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Riwayat Pesanan</h1>
                <p class="mt-1 text-sm text-gray-500">Lihat status dan rincian pesanan Anda.</p>
            </div>
            <a href="/produk" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2 font-semibold text-white hover:bg-blue-700">
                Kembali Belanja
            </a>
        </div>

        @forelse($pesanans as $pesanan)
            <article class="mb-4 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:p-6">
                <div class="flex flex-col gap-3 border-b border-gray-100 pb-4 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <h2 class="font-bold text-gray-800">Pesanan #{{ $pesanan->id }}</h2>
                        <p class="mt-1 text-sm text-gray-500">Tanggal: {{ $pesanan->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <x-status-pesanan :status="$pesanan->status" />
                </div>

                <div class="grid gap-4 py-4 sm:grid-cols-2">
                    <div>
                        <p class="mb-1 text-sm font-medium text-gray-500">Produk</p>
                        <ul class="space-y-1 text-sm text-gray-700">
                            @forelse($pesanan->details as $item)
                                <li>{{ $item->nama_produk }} <span class="text-gray-500">({{ $item->quantity }} barang)</span></li>
                            @empty
                                <li class="text-gray-500">Detail produk tidak tersedia.</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Jumlah Barang</p>
                            <p class="font-semibold text-gray-800">{{ $pesanan->details->sum('quantity') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Pembayaran</p>
                            <p class="font-bold text-blue-600">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Metode Pembayaran</p>
                            <p class="text-gray-800">{{ $pesanan->metode_pembayaran }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-3 border-t border-gray-100 pt-4 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm text-gray-500">Status pembayaran tidak tersedia pada pesanan ini.</p>
                    <a href="{{ route('pesanan.detail', $pesanan->id) }}" class="font-semibold text-blue-600 hover:text-blue-800">
                        Lihat Detail &rarr;
                    </a>
                </div>
            </article>
        @empty
            <div class="rounded-2xl border border-gray-100 bg-white px-6 py-12 text-center shadow-sm">
                <h2 class="text-lg font-semibold text-gray-800">Belum ada riwayat pesanan</h2>
                <p class="mt-2 text-gray-500">Pesanan yang Anda buat akan tampil di halaman ini.</p>
                <a href="/produk" class="mt-5 inline-flex rounded-lg bg-blue-600 px-5 py-2.5 font-semibold text-white hover:bg-blue-700">
                    Kembali Belanja
                </a>
            </div>
        @endforelse

        <div class="mt-6">{{ $pesanans->links() }}</div>
    </div>
@endsection
