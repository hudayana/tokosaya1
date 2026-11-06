@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Checkout Pesanan</h1>

        <form action="{{ route('checkout.proses') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Kolom Kiri: Data Pengiriman -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Alamat Pengiriman</h2>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Penerima</label>
                        <input type="text" name="nama_penerima" value="{{ Auth::user()->name }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                        <input type="text" name="no_telepon" placeholder="0812xxxxxx" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required placeholder="Jalan, RT/RW, Kelurahan, Kecamatan, Kota..."></textarea>
                    </div>
                </div>

                <!-- Kolom Kanan: Metode Pembayaran -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Metode Pembayaran</h2>
                    
                    <div class="space-y-3 mb-6">
                        <label class="flex items-center p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="metode_pembayaran" value="Transfer Bank" class="w-5 h-5 text-blue-600 focus:ring-blue-500 border-gray-300" required>
                            <div class="ml-3">
                                <span class="block text-gray-800 font-semibold text-sm">Transfer Bank</span>
                                <span class="block text-xs text-gray-500">BCA / Mandiri / BNI</span>
                            </div>
                        </label>
                        
                        <label class="flex items-center p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="metode_pembayaran" value="E-Wallet" class="w-5 h-5 text-blue-600 focus:ring-blue-500 border-gray-300">
                            <div class="ml-3">
                                <span class="block text-gray-800 font-semibold text-sm">E-Wallet</span>
                                <span class="block text-xs text-gray-500">GoPay / OVO / Dana</span>
                            </div>
                        </label>

                        <label class="flex items-center p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="metode_pembayaran" value="QRIS" class="w-5 h-5 text-blue-600 focus:ring-blue-500 border-gray-300">
                            <div class="ml-3">
                                <span class="block text-gray-800 font-semibold text-sm">QRIS</span>
                                <span class="block text-xs text-gray-500">Scan aplikasi M-Banking / E-Wallet</span>
                            </div>
                        </label>

                        <label class="flex items-center p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="metode_pembayaran" value="COD" class="w-5 h-5 text-blue-600 focus:ring-blue-500 border-gray-300">
                            <div class="ml-3">
                                <span class="block text-gray-800 font-semibold text-sm">Bayar di Tempat (COD)</span>
                                <span class="block text-xs text-gray-500">Bayar saat barang diterima</span>
                            </div>
                        </label>
                    </div>

                    <div class="border-t border-gray-100 pt-4 mb-6 flex justify-between items-center">
                        <span class="text-lg font-bold text-gray-800">Total Tagihan</span>
                        <span class="text-2xl font-extrabold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl shadow-md transition duration-300">
                        Buat Pesanan Sekarang
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection