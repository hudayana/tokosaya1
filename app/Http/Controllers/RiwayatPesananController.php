<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RiwayatPesananController extends Controller
{
    public function index(Request $request): View
    {
        abort_unless($request->user()->role === 'pembeli', 403);

        $pesanans = $request->user()
            ->pesanans()
            ->with('details')
            ->latest()
            ->paginate(10);

        return view('pesanan.index', compact('pesanans'));
    }

    public function show(Request $request, int $id): View
    {
        abort_unless($request->user()->role === 'pembeli', 403);

        $pesanan = Pesanan::query()
            ->where('user_id', $request->user()->getAuthIdentifier())
            ->with('details')
            ->findOrFail($id);

        return view('pesanan.detail', compact('pesanan'));
    }
}
