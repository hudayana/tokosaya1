@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="max-w-4xl mx-auto">
        <a href="{{ route('admin.pesanan') }}" class="inline-flex items-center text-gray-500 hover:text-blue-600 mb-6 transition">&larr; Kembali ke Riwayat Pesanan</a>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Detail Pesanan #{{ $pesanan->id }}</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 border-b border-gray-100 pb-6">
                <div>
                    <p class="text-sm text-gray-500">Nama Penerima</p>
                    <p class="font-semibold text-gray-800">{{ $pesanan->nama_penerima }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">No Telepon</p>
                    <p class="font-semibold text-gray-800">{{ $pesanan->no_telepon }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm text-gray-500">Alamat Pengiriman</p>
                    <p class="font-semibold text-gray-800">{{ $pesanan->alamat }}</p>
                </div>
            </div>

            <h3 class="text-lg font-bold text-gray-800 mb-4">Daftar Barang</h3>
            <ul class="space-y-3 mb-6">
                @foreach($pesanan->details as $item)
                    <li class="flex justify-between items-center bg-gray-50 p-4 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $item->nama_produk }}</p>
                            <p class="text-sm text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                        </div>
                        <p class="font-bold text-blue-600">Rp {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}</p>
                    </li>
                @endforeach
            </ul>

            <div class="border-t border-gray-100 pt-4 flex justify-between items-center">
                <span class="text-lg font-bold text-gray-800">Total Tagihan</span>
                <span class="text-2xl font-extrabold text-blue-600">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
@endsection