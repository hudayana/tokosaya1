<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;

class PesananController extends Controller
{
    public function index()
    {
        $semua_pesanan = Pesanan::with('details')->latest()->get();
        return view('admin.pesanan', compact('semua_pesanan'));
    }

    public function show($id)
    {
        $pesanan = Pesanan::with('details')->findOrFail($id);
        return view('admin.detail_pesanan', compact('pesanan'));
    }
}