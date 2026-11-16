@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="max-w-4xl mx-auto">
        <a href="{{ route('admin.pesanan') }}" class="inline-flex items-center text-gray-500 hover:text-blue-600 mb-6 transition">&larr; Kembali ke Riwayat Pesanan</a>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Detail Pesanan #{{ $pesanan->id }}</h1>

            @if(session('success'))
                <div role="status" class="mb-4 rounded-lg bg-green-50 p-4 text-sm text-green-800">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div role="alert" class="mb-4 rounded-lg bg-red-50 p-4 text-sm text-red-800">
                    <p class="font-semibold">Status pesanan gagal diperbarui.</p>
                    <ul class="mt-1 list-inside list-disc">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-6 flex flex-col gap-3 rounded-xl bg-gray-50 p-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="mb-1 text-sm text-gray-500">Status Pesanan Saat Ini</p>
                    <x-status-pesanan :status="$pesanan->status" />
                </div>
                <form method="POST" action="{{ route('admin.pesanan.update', $pesanan->id) }}" class="flex flex-col gap-2 sm:flex-row sm:items-end">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="status" class="mb-1 block text-sm font-medium text-gray-700">Ubah Status</label>
                        <select id="status" name="status" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @foreach(['pending' => 'Pending', 'diproses' => 'Diproses', 'dikirim' => 'Dikirim', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'] as $value => $label)
                                <option value="{{ $value }}" @selected(old('status', $pesanan->status) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 font-semibold text-white hover:bg-blue-700">Simpan Perubahan</button>
                </form>
            </div>
            
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