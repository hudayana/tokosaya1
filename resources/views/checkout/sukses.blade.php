@extends('layouts.app')

@section('title', 'Pesanan Berhasil')

@section('content')
    <div class="max-w-2xl mx-auto text-center mt-12">
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-12">
            <div class="w-24 h-24 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Pesanan Berhasil!</h1>
            <p class="text-gray-500 mb-8">Terima kasih telah berbelanja di Toko Saya. Pesanan Anda sedang diproses.</p>
            <a href="/produk" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl shadow-md transition duration-300">
                Kembali ke Katalog
            </a>
        </div>
    </div>
@endsection