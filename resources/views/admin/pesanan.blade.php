@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Riwayat Pesanan</h1>
            <a href="/dashboard" class="text-blue-600 hover:underline font-medium">&larr; Kembali ke Dashboard</a>
        </div>

        <form method="GET" action="{{ route('admin.pesanan') }}" class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end">
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Filter Status</label>
                <select id="status" name="status" class="rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" @selected($selectedStatus === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">Terapkan</button>
            @if($selectedStatus !== '')
                <a href="{{ route('admin.pesanan') }}" class="text-sm font-medium text-gray-600 hover:text-blue-600">Reset filter</a>
            @endif
        </form>

        <div class="overflow-x-auto rounded-2xl border border-gray-100 bg-white shadow-sm">
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
                            <td class="py-3 px-6 text-gray-700">{{ $semua_pesanan->firstItem() + $index }}</td>
                            <td class="py-3 px-6 font-medium text-gray-800">{{ $p->nama_penerima }}</td>
                            <td class="py-3 px-6 font-bold text-blue-600">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                            <td class="py-3 px-6 text-gray-600">{{ $p->metode_pembayaran }}</td>
                            <td class="py-3 px-6">
                                <x-status-pesanan :status="$p->status" />
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
        <div class="mt-4">{{ $semua_pesanan->links() }}</div>
    </div>
@endsection