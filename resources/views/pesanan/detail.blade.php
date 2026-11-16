@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="mx-auto max-w-4xl">
        <a href="{{ route('pesanan.riwayat') }}" class="mb-6 inline-flex items-center font-medium text-gray-500 hover:text-blue-600">
            &larr; Kembali ke Riwayat Pesanan
        </a>

        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:p-8">
            <div class="mb-6 flex flex-col gap-3 border-b border-gray-100 pb-6 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Detail Pesanan #{{ $pesanan->id }}</h1>
                    <p class="mt-1 text-sm text-gray-500">Tanggal pemesanan: {{ $pesanan->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <x-status-pesanan :status="$pesanan->status" />
            </div>

            <div class="mb-8 grid gap-5 sm:grid-cols-2">
                <div>
                    <p class="text-sm text-gray-500">Nama Penerima</p>
                    <p class="font-semibold text-gray-800">{{ $pesanan->nama_penerima }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">No. Telepon</p>
                    <p class="font-semibold text-gray-800">{{ $pesanan->no_telepon }}</p>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-sm text-gray-500">Alamat Pengiriman</p>
                    <p class="font-semibold text-gray-800">{{ $pesanan->alamat }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Metode Pembayaran</p>
                    <p class="font-semibold text-gray-800">{{ $pesanan->metode_pembayaran }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status Pembayaran</p>
                    <p class="font-semibold text-gray-500">Tidak tersedia</p>
                </div>
            </div>

            <h2 class="mb-4 text-lg font-bold text-gray-800">Daftar Produk</h2>
            <ul class="mb-6 space-y-3">
                @forelse($pesanan->details as $item)
                    <li class="flex flex-col gap-2 rounded-lg bg-gray-50 p-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $item->nama_produk }}</p>
                            <p class="text-sm text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                        </div>
                        <p class="font-bold text-blue-600">Rp {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}</p>
                    </li>
                @empty
                    <li class="rounded-lg bg-gray-50 p-4 text-gray-500">Detail produk tidak tersedia.</li>
                @endforelse
            </ul>

            <div class="space-y-2 border-t border-gray-100 pt-4 text-right">
                @foreach($pesanan->details as $item)
                    <p class="text-sm text-gray-500">Subtotal {{ $item->nama_produk }}: Rp {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}</p>
                @endforeach
                <p class="pt-2 text-lg font-bold text-gray-800">
                    Total Pembayaran
                    <span class="ml-2 text-xl text-blue-600">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                </p>
            </div>
        </div>
    </div>
@endsection
