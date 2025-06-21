@extends('layouts.app')

@section('title', 'Pembayaran Berhasil')

@section('content')
    <div class="min-h-screen bg-white flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-center">

                <!-- Left Side: Content -->
                <div class="space-y-8 text-center lg:text-left">
                    <!-- Success Header -->
                    <div>
                        <span
                            class="inline-block bg-green-100 text-green-700 text-sm font-semibold px-4 py-2 rounded-full mb-4">
                            Transaksi Berhasil
                        </span>
                        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight">
                            Terima Kasih, Donatur!
                        </h1>
                        <p class="mt-4 text-lg text-gray-600">
                            Donasi Anda telah kami terima. Setiap kontribusi sangat berarti untuk membantu mereka yang
                            membutuhkan.
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ url('/') }}"
                            class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            Kembali ke Beranda
                        </a>

                        <a href="{{ url('/reports') }}"
                            class="inline-flex items-center justify-center px-8 py-3 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold rounded-lg transition-all duration-300 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Lihat Laporan
                        </a>
                    </div>

                    <!-- Transaction Details -->
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">
                            Rincian Transaksi
                        </h3>

                        <div class="space-y-4 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Order ID</span>
                                <span class="font-mono font-bold text-blue-600">{{ $transaksi->order_id }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Nama Donatur</span>
                                <span class="font-medium text-gray-800">{{ $transaksi->donor_name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Email</span>
                                <span class="font-medium text-gray-800 truncate">{{ $transaksi->donor_email }}</span>
                            </div>
                            <div class="border-t border-gray-200 my-2"></div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500">Jumlah Donasi</span>
                                <span
                                    class="font-bold text-green-600 text-xl">Rp{{ number_format($transaksi->amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Additional Info -->
                    <div class="text-center lg:text-left">
                        <p class="text-xs text-gray-500">
                            Laporan kami akan kirim secara otomatis melalui email yang terdaftar, dan juga anda dapat
                            melihatnya di laporan donasi.
                        </p>
                    </div>

                </div>

                <!-- Right Side: Image -->
                <div class="flex items-center justify-center p-8 lg:p-0">
                    <img src="{{ asset('Successful purchase-cuate.png') }}" alt="Pembayaran Berhasil"
                        class="rounded-lg object-cover w-full max-w-md lg:max-w-none h-auto">
                </div>
            </div>
        </div>
    </div>
@endsection
