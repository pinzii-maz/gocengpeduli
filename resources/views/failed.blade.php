@extends('layouts.app')

@section('title', 'Pembayaran Gagal')

@section('content')
    <div class="text-center py-10">
        <h1 class="text-3xl font-bold text-red-600">Pembayaran Gagal</h1>
        <p class="mt-4 text-gray-700">Maaf, terjadi kesalahan saat memproses transaksi Anda.</p>
        <p class="mt-2">Order ID: <strong>{{ $orderId }}</strong></p>

        <a href="{{ url('/') }}"
            class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
            Kembali ke Beranda
        </a>
    </div>
@endsection
