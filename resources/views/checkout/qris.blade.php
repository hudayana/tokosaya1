@extends('layouts.app')

@section('title', 'Pembayaran QRIS')

@section('content')
    <div class="max-w-xl mx-auto mt-8">
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-blue-600 p-6 text-center">
                <h1 class="text-2xl font-bold text-white">Pembayaran QRIS</h1>
                <p class="text-blue-100 mt-1">Selesaikan pembayaran Anda</p>
            </div>
            
            <div class="p-8 text-center">
                <p class="text-gray-600 mb-6">Silakan scan kode QR di bawah ini menggunakan aplikasi M-Banking atau E-Wallet Anda (GoPay, OVO, Dana, dll).</p>
                
                <!-- Gambar QRIS (Ganti src dengan gambar QRIS asli Anda nanti) -->
                <div class="bg-gray-50 p-4 rounded-2xl inline-block border border-gray-200 mb-6">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg" alt="QRIS Code" class="w-64 h-64 object-contain mx-auto">
                </div>

                <div class="bg-yellow-50 text-yellow-700 p-4 rounded-xl text-sm mb-8 text-left">
                    <strong>Perhatian:</strong> Ini adalah QRIS simulasi untuk keperluan portofolio. Jangan melakukan transfer sungguhan.
                </div>

                <a href="/checkout/sukses" class="w-full block bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl shadow-md transition duration-300">
                    Saya Sudah Membayar
                </a>
            </div>
        </div>
    </div>
@endsection