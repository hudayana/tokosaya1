@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Riwayat Pesanan</h1>
            <a href="/dashboard" class="text-blue-600 hover:underline font-medium">&larr; Kembali ke Dashboard</a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="py-3 px-6 text-sm font-semibold text-gray-600">No</th>
                        <th class="py-3 px-6 text-sm font-semibold text-gray-600">Nama Penerima</th>
                        <th class="py-3 px-6 text-sm font-semibold text-gray-600">Total</th>
                        <th class="py-3 px-6 text-sm font-semibold text-gray-600">Metode</th>
                        <th class="py-3 px-6 text-sm font-semibold text-gray-600">Status</th>
                        <th class="py-3 px-6 text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($semua_pesanan as $index => $p)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td class="py-3 px-6 text-gray-700">{{ $index + 1 }}</td>
                            <td class="py-3 px-6 font-medium text-gray-800">{{ $p->nama_penerima }}</td>
                            <td class="py-3 px-6 font-bold text-blue-600">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                            <td class="py-3 px-6 text-gray-600">{{ $p->metode_pembayaran }}</td>
                            <td class="py-3 px-6">
                                <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-2 py-1 rounded">{{ $p->status }}</span>
                            </td>
                            <td class="py-3 px-6">
                                <a href="{{ route('admin.pesanan.detail', $p->id) }}" class="text-blue-500 hover:text-blue-700 font-semibold text-sm">Lihat Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-gray-500">Belum ada pesanan masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection