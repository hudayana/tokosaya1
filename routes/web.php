<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Route;

// --- ROUTE PUBLIK (Bisa diakses tanpa login) ---

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tentang', function () {
    return view('tentang');
});

// Produk (Publik)
Route::get('/produk', [ProdukController::class, 'index']);

// Keranjang Belanja (Publik)
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
Route::post('/keranjang/update/{id}', [KeranjangController::class, 'update'])->name('keranjang.update');
Route::delete('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');


// --- ROUTE WAJIB LOGIN (Auth) ---

Route::middleware('auth')->group(function () {
    
    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- ROUTE KHUSUS ADMIN ---
    Route::middleware('admin')->group(function () {
        
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        // CRUD Produk (Admin)
        Route::get('/produk/tambah', [ProdukController::class, 'create']);
        Route::post('/produk/simpan', [ProdukController::class, 'store']);
        Route::get('/produk/{id}/edit', [ProdukController::class, 'edit']);
        Route::put('/produk/{id}', [ProdukController::class, 'update']);
        Route::delete('/produk/{id}', [ProdukController::class, 'destroy']);

        // CRUD Kategori (Admin)
        Route::get('/kategori', [KategoriController::class, 'index']);
        Route::post('/kategori/simpan', [KategoriController::class, 'store']);
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);

        // Manajemen Pesanan (Admin)
        Route::get('/admin/pesanan', [PesananController::class, 'index'])->name('admin.pesanan');
        Route::get('/admin/pesanan/{id}', [PesananController::class, 'show'])->name('admin.pesanan.detail');
    });

    // --- ROUTE CHECKOUT & PEMBAYARAN ---
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/proses', [CheckoutController::class, 'proses'])->name('checkout.proses');
    Route::get('/checkout/qris', [CheckoutController::class, 'qris'])->name('checkout.qris');
    Route::get('/checkout/sukses', [CheckoutController::class, 'sukses'])->name('checkout.sukses');

});

// 🔥 KUNCI PERBAIKANNYA DI SINI 🔥
// Rute detail produk diletakkan paling bawah agar tidak menelan rute /produk/tambah
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.detail')->whereNumber('id');

require __DIR__.'/auth.php';