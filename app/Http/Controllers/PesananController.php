<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    private const STATUSES = ['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan'];

    public function index(Request $request)
    {
        $validated = $request->validate([
            'status' => ['nullable', 'in:'.implode(',', self::STATUSES)],
        ]);

        $query = Pesanan::with('details')->latest();

        if (! empty($validated['status'])) {
            $query->where('status', $validated['status']);
        }

        $semua_pesanan = $query->paginate(15)->withQueryString();

        return view('admin.pesanan', [
            'semua_pesanan' => $semua_pesanan,
            'statuses' => self::STATUSES,
            'selectedStatus' => $validated['status'] ?? '',
        ]);
    }

    public function show($id)
    {
        $pesanan = Pesanan::with('details')->findOrFail($id);

        return view('admin.detail_pesanan', compact('pesanan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:'.implode(',', self::STATUSES)],
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update(['status' => $validated['status']]);

        return redirect()
            ->route('admin.pesanan.detail', $pesanan)
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }
}