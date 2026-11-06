@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <h1>Edit Produk</h1>
    
    <form action="/produk/{{ $produk->id }}" method="POST" style="max-width: 400px; margin-top: 20px;" enctype="multipart/form-data">
        @csrf
        @method('PUT') 
        
        <div style="margin-bottom: 15px;">
            <label style="display:block; margin-bottom: 5px;">Nama Produk</label>
            <input type="text" name="nama" value="{{ $produk->nama }}" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
        </div>
        
        <div style="margin-bottom: 15px;">
            <label style="display:block; margin-bottom: 5px;">Harga</label>
            <input type="number" name="harga" value="{{ $produk->harga }}" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
        </div>
        
        <div style="margin-bottom: 15px;">
            <label style="display:block; margin-bottom: 5px;">Deskripsi</label>
            <textarea name="deskripsi" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" rows="4">{{ $produk->deskripsi }}</textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display:block; margin-bottom: 5px;">Ganti Gambar (Opsional)</label>
            <input type="file" name="gambar" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" accept="image/*">
            <small style="color: #666;">Biarkan kosong jika tidak ingin mengganti gambar.</small>
        </div>
        
        <button type="submit" style="background-color: #10b981; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer;">Update Produk</button>
        <a href="/produk" style="margin-left: 10px; color: #666; text-decoration: none;">Batal</a>
    </form>
@endsection