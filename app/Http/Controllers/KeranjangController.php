<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang_session = session()->get('keranjang', []);
        $keranjang = [];
        $total = 0;
        $session_baru = []; // Untuk menyimpan session yang sudah divalidasi

        // Ambil data produk terbaru dari database berdasarkan ID di session
        foreach ($keranjang_session as $id => $item) {
            $produk = Produk::find($id);
            
            // Jika produk masih ada di database
            if ($produk) {
                // Sinkronkan session dengan data terbaru
                $session_baru[$id] = [
                    'quantity' => $item['quantity']
                ];

                $keranjang[$id] = [
                    'nama' => $produk->nama,
                    'harga' => $produk->harga,
                    'quantity' => $item['quantity'],
                    'gambar' => $produk->gambar,
                    'subtotal' => $produk->harga * $item['quantity']
                ];
                $total += $produk->harga * $item['quantity'];
            }
            // Jika produk tidak ditemukan (dihapus admin), otomatis dibuang dari session
        }

        // Simpan kembali session yang sudah dibersihkan/diperbarui
        session()->put('keranjang', $session_baru);

        return view('keranjang.index', compact('keranjang', 'total'));
    }

    public function tambah($id)
    {
        $produk = Produk::findOrFail($id);
        $keranjang = session()->get('keranjang', []);

        // HANYA SIMPAN QUANTITY DI SESSION (Harga diambil dari DB saat ditampilkan)
        if (isset($keranjang[$id])) {
            $keranjang[$id]['quantity']++;
        } else {
            $keranjang[$id] = [
                "quantity" => 1
            ];
        }

        session()->put('keranjang', $keranjang);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id)
    {
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
    }

    public function hapus($id)
    {
        $keranjang = session()->get('keranjang', []);
        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }
}