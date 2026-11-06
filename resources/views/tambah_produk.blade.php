@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Tambah Produk Baru</h4>
            </div>
            <div class="card-body">
                <!-- Tambahkan enctype="multipart/form-data" di sini -->
                <form action="/produk/simpan" method="POST" enctype="multipart/form-data">
                    @csrf 
                    
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Harga (Angka saja)</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>

                    <!-- TAMBAHKAN INPUT GAMBAR INI -->
                    <div class="mb-3">
                        <label class="form-label">Gambar Produk (Opsional)</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                    </div>
                    
                    <button type="submit" class="btn btn-success">Simpan Produk</button>
                    <a href="/produk" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection