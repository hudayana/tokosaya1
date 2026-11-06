@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <h1>Daftar Produk Kami</h1>
    
    <ul>
        @foreach($semua_produk as $p)
            <li style="margin-bottom: 15px;">
                
                <!-- TAMPILKAN GAMBAR DI SINI (Di dalam perulangan) -->
                @if($p->gambar)
                    <img src="{{ asset('images/' . $p->gambar) }}" alt="Gambar {{ $p->nama }}" style="max-width: 150px; border-radius: 5px; margin-bottom: 10px; display: block;">
                @endif

                <strong>{{ $p->nama }}</strong> - Rp {{ number_format($p->harga, 0, ',', '.') }}
                <br>
                <small>{{ $p->deskripsi }}</small>
                <br>
                
                <!-- TOMBOL EDIT & HAPUS -->
                <div style="margin-top: 5px;">
                    <a href="/produk/{{ $p->id }}/edit" style="background-color: #3b82f6; color: white; text-decoration: none; padding: 5px 10px; border-radius: 4px; font-size: 12px; margin-right: 5px;">Edit</a>

                    <form action="/produk/{{ $p->id }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background-color: #ef4444; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-size: 12px;" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endsection