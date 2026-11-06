@extends('layouts.app')

@section('title', 'Manajemen Kategori')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Kategori</h1>
            <a href="/dashboard" class="text-blue-600 hover:underline font-medium">&larr; Kembali ke Dashboard</a>
        </div>

        <!-- Form Tambah Kategori -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Tambah Kategori Baru</h2>
            <form action="/kategori/simpan" method="POST" class="flex gap-4">
                @csrf
                <input type="text" name="nama_kategori" placeholder="Nama Kategori (misal: Pakaian)" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition">Tambah</button>
            </form>
        </div>

        <!-- Daftar Kategori -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="py-3 px-6 text-sm font-semibold text-gray-600">No</th>
                        <th class="py-3 px-6 text-sm font-semibold text-gray-600">Nama Kategori</th>
                        <th class="py-3 px-6 text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($semua_kategori as $index => $k)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td class="py-3 px-6 text-gray-700">{{ $index + 1 }}</td>
                            <td class="py-3 px-6 font-medium text-gray-800">{{ $k->nama_kategori }}</td>
                            <td class="py-3 px-6">
                                <form action="/kategori/{{ $k->id }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-semibold text-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-6 text-center text-gray-500">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection