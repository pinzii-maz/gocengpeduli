@extends('layouts.app') @section('content')
    <div class="container text-center">
        <h2>Menunggu Pembayaran</h2>
        <p>Segera selesaikan pembayaran untuk donasi Anda.</p>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detail Pesanan</h5>
                <p><strong>Order ID:</strong> {{ $transaksi->order_id }}</p>
                <p><strong>Nama Donatur:</strong> {{ $transaksi->donor_name }}</p>
                <p><strong>Jumlah:</strong> Rp{{ number_format($transaksi->amount, 0, ',', '.') }}</p>
                <hr>
                <p class="font-weight-bold">
                    Silakan periksa email Anda ({{ $transaksi->donor_email }}) untuk instruksi pembayaran lengkap dari
                    Midtrans.
                </p>
                <p>Atau ikuti petunjuk pembayaran yang muncul di layar sebelumnya.</p>
                <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Halaman Utama</a>
            </div>
        </div>
    </div>
@endsection
