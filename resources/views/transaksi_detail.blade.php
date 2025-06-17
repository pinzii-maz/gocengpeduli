<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- PENTING: Muat juga script Snap Midtrans di sini --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto mt-10 p-5 bg-white shadow-lg max-w-2xl">
        <h1 class="text-2xl font-bold mb-4">Detail Transaksi</h1>

        <div class="grid grid-cols-2 gap-4">
            <div><strong>Order ID:</strong></div>
            <div>{{ $transaksi->order_id }}</div>

            <div><strong>Nama Donatur:</strong></div>
            <div>{{ $transaksi->donor_name }}</div>

            <div><strong>Jumlah:</strong></div>
            <div class="font-bold">Rp{{ number_format($transaksi->amount, 0, ',', '.') }}</div>

            <div><strong>Status:</strong></div>
            <div>
                @if ($transaksi->status == 'pending')
                    <span class="px-2 py-1 text-sm font-semibold text-yellow-800 bg-yellow-200 rounded-full">Menunggu
                        Pembayaran</span>
                @elseif($transaksi->status == 'success')
                    <span
                        class="px-2 py-1 text-sm font-semibold text-green-800 bg-green-200 rounded-full">Berhasil</span>
                @else
                    <span
                        class="px-2 py-1 text-sm font-semibold text-red-800 bg-red-200 rounded-full">Gagal/Dibatalkan</span>
                @endif
            </div>
        </div>

        {{-- Tampilkan tombol hanya jika status masih PENDING --}}
        @if ($transaksi->status == 'pending')
            <div class="mt-8 text-center">
                <p class="mb-4">Pembayaran Anda belum selesai. Silakan lanjutkan.</p>
                <button id="pay-button"
                    class="bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-700 transition">
                    Lanjutkan Pembayaran
                </button>
            </div>
        @endif

        <div class="mt-8 text-center">
            <a href="{{ url('/') }}" class="text-blue-600 hover:underline">Kembali ke Beranda</a>
        </div>
    </div>

    <script type="text/javascript">
        // Cek jika tombol pembayaran ada
        const payButton = document.getElementById('pay-button');
        if (payButton) {
            payButton.addEventListener('click', function() {
                // Gunakan snap_token yang sudah kita simpan di database
                snap.pay('{{ $transaksi->snap_token }}', {
                    onSuccess: function(result) {
                        window.location.href = "{{ route('payment.succes') }}?order_id=" + result
                            .order_id;
                    },
                    onPending: function(result) {
                        // Tetap di halaman ini karena sudah di halaman detail
                        alert("Pembayaran masih pending. Silakan selesaikan.");
                    },
                    onError: function(result) {
                        window.location.href = "{{ route('payment.failed') }}?order_id=" + result
                            .order_id;
                    }
                });
            });
        }
    </script>
</body>

</html>
