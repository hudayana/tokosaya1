@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-blue-600 px-6 py-4">
            <h2 class="text-xl font-bold text-white">Tambah Produk Baru</h2>
        </div>
        
        <div class="p-8">
            <form action="/produk/simpan" method="POST" enctype="multipart/form-data">
                @csrf 
                
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk</label>
                    <input type="text" name="nama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" required>
                </div>
                
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Harga (Angka saja)</label>
                    <input type="number" name="harga" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" required>
                </div>

                <!-- DROPDOWN KATEGORI DIPINDAH KE SINI -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori Produk</label>
                    <select name="kategori_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">-- Pilih Kategori (Opsional) --</option>
                        @foreach($semua_kategori as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" rows="4"></textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Produk (Opsional)</label>
                    <input type="file" name="gambar" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-gray-50" accept="image/*">
                </div>
                
                <!-- TOMBOL AKSI TETAP DI SINI -->
                <div class="flex items-center gap-3">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-lg shadow-md transition duration-300">
                        Simpan Produk
                    </button>
                    <a href="/produk" class="text-gray-600 hover:text-gray-900 font-medium px-4 py-2.5 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection