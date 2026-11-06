@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-yellow-400 px-6 py-4">
            <h2 class="text-xl font-bold text-yellow-900">Edit Produk</h2>
        </div>
        
        <div class="p-8">
            <form action="/produk/{{ $produk->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') 
                
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk</label>
                    <input type="text" name="nama" value="{{ $produk->nama }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" required>
                </div>
                
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Harga</label>
                    <input type="number" name="harga" value="{{ $produk->harga }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" required>
                </div>
                
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" rows="4">{{ $produk->deskripsi }}</textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Ganti Gambar (Opsional)</label>
                    <input type="file" name="gambar" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-gray-50" accept="image/*">
                    <p class="text-xs text-gray-500 mt-2">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                </div>
                
                <div class="mb-5">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori Produk</label>
    <select name="kategori_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
        <option value="">-- Pilih Kategori (Opsional) --</option>
        @foreach($semua_kategori as $k)
            <option value="{{ $k->id }}" {{ $produk->kategori_id == $k->id ? 'selected' : '' }}>
                {{ $k->nama_kategori }}
            </option>
        @endforeach
    </select>
</div>

                <div class="flex items-center gap-3">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-lg shadow-md transition duration-300">
                        Update Produk
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