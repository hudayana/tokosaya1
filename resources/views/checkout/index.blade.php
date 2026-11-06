@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Checkout Pesanan</h1>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Metode Pembayaran</h2>
            
            <form action="{{ route('checkout.proses') }}" method="POST">
                @csrf
                
                <div class="space-y-4 mb-8">
                    <!-- Opsi Transfer Bank -->
                    <label class="flex items-center p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                        <input type="radio" name="metode_pembayaran" value="Transfer Bank" class="w-5 h-5 text-blue-600 focus:ring-blue-500 border-gray-300" required>
                        <div class="ml-4">
                            <span class="block text-gray-800 font-semibold">Transfer Bank</span>
                            <span class="block text-sm text-gray-500">BCA / Mandiri / BNI</span>
                        </div>
                    </label>
                    
                    <!-- Opsi E-Wallet -->
                    <label class="flex items-center p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                        <input type="radio" name="metode_pembayaran" value="E-Wallet" class="w-5 h-5 text-blue-600 focus:ring-blue-500 border-gray-300">
                        <div class="ml-4">
                            <span class="block text-gray-800 font-semibold">E-Wallet</span>
                            <span class="block text-sm text-gray-500">GoPay / OVO / Dana</span>
                        </div>
                    </label>

                    <!-- Opsi QRIS -->
                    <label class="flex items-center p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                        <input type="radio" name="metode_pembayaran" value="QRIS" class="w-5 h-5 text-blue-600 focus:ring-blue-500 border-gray-300">
                        <div class="ml-4">
                            <span class="block text-gray-800 font-semibold">QRIS</span>
                            <span class="block text-sm text-gray-500">Scan menggunakan aplikasi M-Banking atau E-Wallet</span>
                        </div>
                    </label>

                    <!-- Opsi COD -->
                    <label class="flex items-center p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                        <input type="radio" name="metode_pembayaran" value="COD" class="w-5 h-5 text-blue-600 focus:ring-blue-500 border-gray-300">
                        <div class="ml-4">
                            <span class="block text-gray-800 font-semibold">Bayar di Tempat (COD)</span>
                            <span class="block text-sm text-gray-500">Bayar saat barang diterima</span>
                        </div>
                    </label>
                </div>

                <div class="border-t border-gray-100 pt-6 mb-6 flex justify-between items-center">
                    <span class="text-lg font-bold text-gray-800">Total Tagihan</span>
                    <span class="text-2xl font-extrabold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl shadow-md transition duration-300">
                    Buat Pesanan Sekarang
                </button>
            </form>
        </div>
    </div>
@endsection