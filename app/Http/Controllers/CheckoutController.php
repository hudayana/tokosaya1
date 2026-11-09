<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $keranjang_session = session()->get('keranjang', []);
        
        if (count($keranjang_session) == 0) {
            return redirect('/produk')->with('error', 'Keranjang Anda kosong.');
        }
        
        $total = 0;
        foreach($keranjang_session as $id => $item) {
            $produk = Produk::find($id);
            if ($produk) {
                $total += $produk->harga * $item['quantity'];
            }
        }
        
        return view('checkout.index', compact('keranjang_session', 'total'));
    }

    public function proses(Request $request)
    {
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
        $detail_pesanan = [];

        // Hitung total dan siapkan data detail dari DB terbaru
        foreach($keranjang as $id => $item) {
            $produk = Produk::find($id);
            if ($produk) {
                $subtotal = $produk->harga * $item['quantity'];
                $total += $subtotal;

                $detail_pesanan[] = [
                    'produk_id' => $produk->id,
                    'nama_produk' => $produk->nama,
                    'harga' => $produk->harga,
                    'quantity' => $item['quantity']
                ];
            }
        }

        // Simpan Pesanan
        $pesanan = Pesanan::create([
            'user_id' => auth()->id(),
            'nama_penerima' => $request->nama_penerima,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_harga' => $total,
            'status' => 'pending'
        ]);

        // Simpan Detail Pesanan
        foreach($detail_pesanan as $detail) {
            $detail['pesanan_id'] = $pesanan->id;
            DetailPesanan::create($detail);
        }

        session()->forget('keranjang'); 

        if ($request->metode_pembayaran == 'QRIS') {
            return redirect('/checkout/qris');
        }

        return redirect('/checkout/sukses');
    }

    public function qris()
    {
        return view('checkout.qris');
    }

    public function sukses()
    {
        return view('checkout.sukses');
    }
}