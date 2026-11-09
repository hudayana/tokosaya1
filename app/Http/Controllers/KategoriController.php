<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $semua_kategori = Kategori::all();
        return view('kategori.index', compact('semua_kategori'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama_kategori' => 'required']);
        Kategori::create(['nama_kategori' => $request->nama_kategori]);
        return redirect('/kategori')->with('success', 'Kategori ditambahkan!');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect('/kategori')->with('success', 'Kategori dihapus!');
    }
}