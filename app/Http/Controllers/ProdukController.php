<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // 1. Menampilkan semua produk (Publik)
    public function index(Request $request)
    {
        $query = Produk::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori_id', $request->kategori);
        }

        $semua_produk = $query->get();
        $semua_kategori = Kategori::all(); 

        return view('produk', compact('semua_produk', 'semua_kategori'));
    }

    // 2. Menampilkan detail 1 produk (Publik)
    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('detail_produk', compact('produk'));
    }

    // 3. Menampilkan form tambah produk (Admin)
    public function create()
    {
        $semua_kategori = Kategori::all(); 
        return view('tambah_produk', compact('semua_kategori'));
    }

    // 4. Menyimpan produk baru ke database (Admin)
    public function store(Request $request)
    {
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

        return redirect('/produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    // 5. Menampilkan form edit produk (Admin)
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $semua_kategori = Kategori::all(); 
        return view('edit_produk', compact('produk', 'semua_kategori'));
    }

    // 6. Menyimpan perubahan produk (Admin)
    public function update(Request $request, $id)
    {
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
            
            // Hapus gambar lama jika ada
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

        return redirect('/produk')->with('success', 'Produk berhasil diperbarui!');
    }

    // 7. Menghapus produk (Admin)
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        
        // Opsional: Hapus file gambar dari folder public jika produk dihapus
        if ($produk->gambar && file_exists(public_path('images/' . $produk->gambar))) {
            unlink(public_path('images/' . $produk->gambar));
        }

        $produk->delete();
        return redirect('/produk')->with('success', 'Produk berhasil dihapus!');
    }
}