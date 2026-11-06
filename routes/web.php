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

Route::get('/produk', function (Request $request) {
    $query = Produk::query();

    if ($request->has('search') && $request->search != '') {
        $query->where('nama', 'like', '%' . $request->search . '%');
    }

    if ($request->has('kategori') && $request->kategori != '') {
        $query->where('kategori_id', $request->kategori);
    }

    $semua_produk = $query->get();
    $semua_kategori = Kategori::all(); 

    return view('produk', [
        'semua_produk' => $semua_produk,
        'semua_kategori' => $semua_kategori
    ]);
});

Route::get('/produk/{id}', function ($id) {
    $produk = Produk::findOrFail($id);
    return view('detail_produk', ['produk' => $produk]);
})->name('produk.detail');


// --- ROUTE KERANJANG BELANJA (Bisa diakses publik) ---
Route::get('/keranjang', function () {
    $keranjang = session()->get('keranjang', []);
    return view('keranjang.index', ['keranjang' => $keranjang]);
})->name('keranjang.index');

Route::post('/keranjang/tambah/{id}', function ($id) {
    $produk = Produk::findOrFail($id);
    $keranjang = session()->get('keranjang', []);

    if (isset($keranjang[$id])) {
        $keranjang[$id]['quantity']++;
    } else {
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
        if ($request->action == 'tambah') {
            $keranjang[$id]['quantity']++;
        } elseif ($request->action == 'kurang' && $keranjang[$id]['quantity'] > 1) {
            $keranjang[$id]['quantity']--;
        }
        session()->put('keranjang', $keranjang);
    }
    return redirect()->route('keranjang.index');
})->name('keranjang.update');


// --- ROUTE ADMIN & CHECKOUT (Wajib Login) ---

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

        // CRUD Produk
        Route::get('/produk/tambah', function () {
            $semua_kategori = Kategori::all(); 
            return view('tambah_produk', ['semua_kategori' => $semua_kategori]);
        });

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

        Route::delete('/produk/{id}', function ($id) {
            $produk = Produk::findOrFail($id);
            $produk->delete();
            return redirect('/produk');
        });

        Route::get('/produk/{id}/edit', function ($id) {
            $produk = Produk::findOrFail($id);
            $semua_kategori = Kategori::all(); 
            return view('edit_produk', ['produk' => $produk, 'semua_kategori' => $semua_kategori]);
        });

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

        // CRUD Kategori
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

                // Halaman Riwayat Pesanan
        Route::get('/admin/pesanan', function () {
            $semua_pesanan = \App\Models\Pesanan::with('details')->latest()->get();
            return view('admin.pesanan', ['semua_pesanan' => $semua_pesanan]);
        })->name('admin.pesanan');

        // Detail Pesanan
        Route::get('/admin/pesanan/{id}', function ($id) {
            $pesanan = \App\Models\Pesanan::with('details')->findOrFail($id);
            return view('admin.detail_pesanan', ['pesanan' => $pesanan]);
        })->name('admin.pesanan.detail');

    }); // Penutup grup khusus admin

    // --- ROUTE CHECKOUT & PEMBAYARAN ---
    
    Route::get('/checkout', function () {
        $keranjang = session()->get('keranjang', []);
        if (count($keranjang) == 0) {
            return redirect('/produk')->with('error', 'Keranjang Anda kosong.');
        }
        $total = 0;
        foreach($keranjang as $item) {
            $total += $item['harga'] * $item['quantity'];
        }
        return view('checkout.index', ['keranjang' => $keranjang, 'total' => $total]);
    })->name('checkout.index');

    Route::post('/checkout/proses', function (Request $request) {
        $request->validate([
            'nama_penerima' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'required',
            'metode_pembayaran' => 'required|in:Transfer Bank,E-Wallet,COD,QRIS'
        ]);

        $keranjang = session()->get('keranjang', []);
        if (count($keranjang) == 0) {
            return redirect('/produk')->with('error', 'Keranjang kosong.');
        }

        $total = 0;
        foreach($keranjang as $item) {
            $total += $item['harga'] * $item['quantity'];
        }

        // Simpan Pesanan
        $pesanan = \App\Models\Pesanan::create([
            'user_id' => auth()->id(),
            'nama_penerima' => $request->nama_penerima,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_harga' => $total,
            'status' => 'pending'
        ]);

        // Simpan Detail Pesanan
        foreach($keranjang as $id => $item) {
            \App\Models\DetailPesanan::create([
                'pesanan_id' => $pesanan->id,
                'produk_id' => $id,
                'nama_produk' => $item['nama'],
                'harga' => $item['harga'],
                'quantity' => $item['quantity']
            ]);
        }

        session()->forget('keranjang'); 

        if ($request->metode_pembayaran == 'QRIS') {
            return redirect('/checkout/qris');
        }

        return redirect('/checkout/sukses');
    })->name('checkout.proses');

    Route::get('/checkout/qris', function () {
        return view('checkout.qris');
    })->name('checkout.qris');

    Route::get('/checkout/sukses', function () {
        return view('checkout.sukses');
    })->name('checkout.sukses');

});

// Blokir akses register publik
// Route::get('/register', function () {
//     return redirect('/login');
// })->name('register');

require __DIR__.'/auth.php';