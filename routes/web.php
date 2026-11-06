<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Produk;
use App\Models\Kategori;
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


    // --- ROUTE KERANJANG BELANJA ---
    Route::get('/keranjang', function () {
        $keranjang = session()->get('keranjang', []);
        return view('keranjang.index', ['keranjang' => $keranjang]);
    })->name('keranjang.index');

    Route::post('/keranjang/tambah/{id}', function ($id) {
        $produk = Produk::findOrFail($id);
        $keranjang = session()->get('keranjang', []);

        // Jika produk sudah ada di keranjang, tambah quantity
        if (isset($keranjang[$id])) {
            $keranjang[$id]['quantity']++;
        } else {
            // Jika belum ada, buat item baru
            $keranjang[$id] = [
                "nama" => $produk->nama,
                "harga" => $produk->harga,
                "quantity" => 1,
                "gambar" => $produk->gambar
            ];
        }

        session()->put('keranjang', $keranjang);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    })->name('keranjang.tambah');

    Route::delete('/keranjang/hapus/{id}', function ($id) {
        $keranjang = session()->get('keranjang', []);
        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    })->name('keranjang.hapus');

        Route::post('/keranjang/update/{id}', function (Request $request, $id) {
        $keranjang = session()->get('keranjang', []);
        
        if(isset($keranjang[$id])) {
            // Pastikan quantity minimal 1
            if ($request->action == 'tambah') {
                $keranjang[$id]['quantity']++;
            } elseif ($request->action == 'kurang' && $keranjang[$id]['quantity'] > 1) {
                $keranjang[$id]['quantity']--;
            }
            session()->put('keranjang', $keranjang);
        }
        
        return redirect()->route('keranjang.index');
    })->name('keranjang.update');

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

    // --- ROUTE PRODUK (CRUD) ---
    
    // 1. Tampilkan Form Tambah Produk (Kirim data kategori)
    Route::get('/produk/tambah', function () {
        $semua_kategori = Kategori::all(); 
        return view('tambah_produk', ['semua_kategori' => $semua_kategori]);
    });

    // 2. Proses Simpan Produk Baru
    Route::post('/produk/simpan', function (Request $request) {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kategori_id' => 'nullable|exists:kategoris,id' 
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
            'kategori_id' => $request->kategori_id, 
        ]);

        return redirect('/produk');
    });

    // 3. Hapus Produk
    Route::delete('/produk/{id}', function ($id) {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect('/produk');
    });

    // 4. Tampilkan Form Edit Produk (Kirim data produk & kategori)
    Route::get('/produk/{id}/edit', function ($id) {
        $produk = Produk::findOrFail($id);
        $semua_kategori = Kategori::all(); 
        return view('edit_produk', ['produk' => $produk, 'semua_kategori' => $semua_kategori]);
    });

    // 5. Proses Update Produk
    Route::put('/produk/{id}', function (Request $request, $id) {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kategori_id' => 'nullable|exists:kategoris,id' 
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
        $produk->kategori_id = $request->kategori_id; 
        $produk->save();

        return redirect('/produk');
    });

    // --- ROUTE KATEGORI ---
    
    Route::get('/kategori', function () {
        $semua_kategori = Kategori::all();
        return view('kategori.index', ['semua_kategori' => $semua_kategori]);
    });

    Route::post('/kategori/simpan', function (Request $request) {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect('/kategori');
    });

    Route::delete('/kategori/{id}', function ($id) {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect('/kategori');
    });
});

// Blokir akses register publik
Route::get('/register', function () {
    return redirect('/login');
})->name('register');

require __DIR__.'/auth.php';