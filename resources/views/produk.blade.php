@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <h1>Daftar Produk Kami</h1>
    
    <ul>
        @foreach($semua_produk as $p)
            <li style="margin-bottom: 15px;">
                <strong>{{ $p->nama }}</strong> - Rp {{ number_format($p->harga, 0, ',', '.') }}
                <br>
                <small>{{ $p->deskripsi }}</small>
            </li>
        @endforeach
    </ul>
@endsection