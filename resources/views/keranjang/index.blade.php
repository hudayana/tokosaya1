@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Keranjang Belanja</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(count($keranjang) > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="py-3 px-6 text-sm font-semibold text-gray-600">Produk</th>
                            <th class="py-3 px-6 text-sm font-semibold text-gray-600">Harga</th>
                            <th class="py-3 px-6 text-sm font-semibold text-gray-600">Qty</th>
                            <th class="py-3 px-6 text-sm font-semibold text-gray-600">Subtotal</th>
                            <th class="py-3 px-6 text-sm font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($keranjang as $id => $item)
                            @php $total += $item['harga'] * $item['quantity']; @endphp
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-4 px-6 flex items-center gap-3">
                                    @if($item['gambar'])
                                        <img src="{{ asset('images/' . $item['gambar']) }}" class="w-12 h-12 object-cover rounded">
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center text-xs text-gray-500">No Img</div>
                                    @endif
                                    <span class="font-semibold text-gray-800">{{ $item['nama'] }}</span>
                                </td>
                                <td class="py-4 px-6 text-gray-600">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                <td class="py-4 px-6 text-gray-800 font-bold">{{ $item['quantity'] }}</td>
                                <td class="py-4 px-6 text-blue-600 font-bold">Rp {{ number_format($item['harga'] * $item['quantity'], 0, ',', '.') }}</td>
                                <td class="py-4 px-6">
                                    <form action="{{ route('keranjang.hapus', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold text-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Ringkasan Total -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mt-6 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">Total Belanja:</h2>
                <h2 class="text-2xl font-extrabold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</h2>
            </div>

            <div class="mt-6 flex justify-end">
                <a href="#" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition" onclick="alert('Fitur Checkout belum tersedia di versi ini.')">
                    Lanjut ke Checkout
                </a>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                <p class="text-gray-500 text-lg mb-4">Keranjang Anda masih kosong.</p>
                <a href="/produk" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition">Mulai Belanja</a>
            </div>
        @endif
    </div>
@endsection