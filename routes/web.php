<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Produk;
use Illuminate\Http\Request;

// --- ROUTE PUBLIK (Bisa diakses tanpa login) ---

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/produk', function () {
    $semua_produk = Produk::all(); 
    return view('produk', ['semua_produk' => $semua_produk]);
});


// --- ROUTE ADMIN (Wajib Login) ---

Route::middleware('auth')->group(function () {
    
    // Dashboard bawaan Breeze
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profil bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- ROUTE TOKO SAYA (CRUD) ---
    
    Route::get('/produk/tambah', function () {
        return view('tambah_produk');
    });

    Route::post('/produk/simpan', function (Request $request) {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' 
        ]);

        $nama_gambar = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_gambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $nama_gambar); 
        }

        Produk::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar' => $nama_gambar,
        ]);

        return redirect('/produk');
    });

    Route::delete('/produk/{id}', function ($id) {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect('/produk');
    });

    Route::get('/produk/{id}/edit', function ($id) {
        $produk = Produk::findOrFail($id);
        return view('edit_produk', ['produk' => $produk]);
    });

    Route::put('/produk/{id}', function (Request $request, $id) {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $produk = Produk::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_gambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $nama_gambar);
            
            if ($produk->gambar && file_exists(public_path('images/' . $produk->gambar))) {
                unlink(public_path('images/' . $produk->gambar));
            }
            
            $produk->gambar = $nama_gambar;
        }

        $produk->nama = $request->nama;
        $produk->harga = $request->harga;
        $produk->deskripsi = $request->deskripsi;
        $produk->save();

        return redirect('/produk');
    });
});

require __DIR__.'/auth.php';