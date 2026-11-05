<?php

use Illuminate\Support\Facades\Route;
use App\Models\Produk; // Baris ini dipindah ke atas

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tentang', function () {
    return view('tentang');
}); // Kurung kurawal penutup ditambahkan di sini

Route::get('/produk', function () {
    $semua_produk = \App\Models\Produk::all(); 
    return view('produk', ['semua_produk' => $semua_produk]);
});

