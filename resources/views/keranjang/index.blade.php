@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
    <div class="max-w-7xl mx-auto py-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Keranjang Belanja</h1>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(count($keranjang) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Kolom Kiri: Daftar Produk -->
                <div class="lg:col-span-2 space-y-4">
                    
                    @foreach($keranjang as $id => $item)
                       
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 flex flex-col sm:flex-row items-center gap-4 relative">
                            
                            <!-- Gambar Produk -->
                            <div class="w-24 h-24 flex-shrink-0">
                                @if($item['gambar'])
                                    <img src="{{ asset('images/' . $item['gambar']) }}" alt="{{ $item['nama'] }}" class="w-full h-full object-cover rounded-xl">
                                @else
                                    <div class="w-full h-full bg-gray-100 rounded-xl flex items-center justify-center text-gray-400">No Img</div>
                                @endif
                            </div>

                            <!-- Detail Produk -->
                            <div class="flex-grow text-center sm:text-left">
                                <h3 class="text-lg font-bold text-gray-800">{{ $item['nama'] }}</h3>
                                <p class="text-blue-600 font-bold mt-1">Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>
                            </div>

                            <!-- Kontrol Quantity & Hapus -->
                            <div class="flex flex-col items-center gap-3 sm:items-end">
                                <form action="{{ route('keranjang.update', $id) }}" method="POST" class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                    @csrf
                                    <button type="submit" name="action" value="kurang" class="px-3 py-1 bg-gray-50 hover:bg-gray-200 text-gray-600 transition">-</button>
                                    <span class="px-4 py-1 font-semibold text-gray-800 bg-white border-x border-gray-200">{{ $item['quantity'] }}</span>
                                    <button type="submit" name="action" value="tambah" class="px-3 py-1 bg-gray-50 hover:bg-gray-200 text-gray-600 transition">+</button>
                                </form>
                                
                                <form action="{{ route('keranjang.hapus', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold transition">Hapus</button>
                                </form>
                            </div>
                            
                            <!-- Subtotal per item -->
                            <div class="w-full sm:w-auto text-right mt-2 sm:mt-0 sm:ml-4 border-t sm:border-t-0 sm:border-l border-gray-100 pt-2 sm:pt-0 sm:pl-4">
                                <p class="text-sm text-gray-500">Subtotal</p>
                                <p class="text-lg font-extrabold text-gray-800">Rp {{ number_format($item['harga'] * $item['quantity'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Kolom Kanan: Ringkasan Pesanan -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                        <h2 class="text-lg font-bold text-gray-800 border-b border-gray-100 pb-3 mb-4">Ringkasan Pesanan</h2>
                        
                        <div class="flex justify-between mb-2 text-gray-600">
                            <span>Total Harga ({{ array_sum(array_column($keranjang, 'quantity')) }} Barang)</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between mb-4 text-gray-600">
                            <span>Biaya Pengiriman</span>
                            <span class="text-green-600 font-semibold">Gratis</span>
                        </div>
                        
                        <div class="border-t border-gray-100 pt-4 mb-6 flex justify-between items-center">
                            <span class="text-lg font-bold text-gray-800">Total</span>
                            <span class="text-2xl font-extrabold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-md transition duration-300 flex items-center justify-center gap-2">
    Lanjut ke Pembayaran
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
</a>
                        
                        <a href="/produk" class="block text-center mt-4 text-gray-500 hover:text-blue-600 text-sm font-medium transition">Lanjut Belanja</a>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-16 text-center max-w-2xl mx-auto">
                <div class="text-gray-300 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-700 mb-2">Keranjang Anda Kosong</h2>
                <p class="text-gray-500 mb-6">Sepertinya Anda belum menambahkan produk apapun.</p>
                <a href="/produk" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl shadow-md transition duration-300">Mulai Belanja</a>
            </div>
        @endif
    </div>
@endsection