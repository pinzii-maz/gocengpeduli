<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Checkout Donasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/lucide@latest"></script>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gradient-to-br from-blue-100 to-white min-h-screen flex items-center justify-center font-sans">

    <div class="bg-white shadow-2xl rounded-2xl max-w-xl w-full p-8 space-y-8 animate-fade-in-down">

        <div class="text-center border-b pb-6">
            <h1 class="text-3xl font-bold text-blue-700">Checkout Donasi</h1>
            <p class="text-gray-500 mt-2 text-sm">Mohon periksa kembali data donasi Anda sebelum melanjutkan pembayaran.
            </p>
        </div>


        <div class="space-y-4 text-gray-700">
            <div class="flex justify-between items-center">
                <span class="font-medium">Nama Donatur:</span>
                <span>{{ $transaksi->donor_name }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="font-medium">Email:</span>
                <span>{{ $transaksi->donor_email }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="font-medium">Jumlah Donasi:</span>
                <span class="text-blue-700 font-bold">Rp{{ number_format($transaksi->amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="border-t pt-6 space-y-4">

            <button id="pay-button"
                class="w-full bg-blue-600 text-white font-semibold py-3 rounded-xl hover:bg-blue-700 transition duration-300 shadow-md flex items-center justify-center gap-2">
                <span id="pay-button-text">Bayar Sekarang</span>
                <svg id="pay-button-spinner" class="animate-spin h-5 w-5 text-white hidden"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
            </button>

            <button id="back-button"
                class="w-full border border-gray-300 text-gray-600 font-semibold py-3 rounded-xl hover:bg-gray-100 transition duration-300">
                Kembali ke Daftar Donasi
            </button>
        </div>
    </div>


    <script>
        const payButton = document.getElementById('pay-button');
        const payButtonText = document.getElementById('pay-button-text');
        const payButtonSpinner = document.getElementById('pay-button-spinner');

        payButton.addEventListener('click', function() {
            payButton.disabled = true;
            payButtonText.textContent = 'Memproses Pembayaran...';
            payButtonSpinner.classList.remove('hidden');

            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pembayaran Berhasil!',
                        text: 'Terima kasih, donasi Anda berhasil diproses.',
                        showConfirmButton: false,
                        timer: 2000,
                        willClose: () => {
                            window.location.href = "/succes?order_id=" + result.order_id;
                        }
                    });
                },
                onPending: function(result) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Menunggu Pembayaran',
                        text: 'Silakan selesaikan pembayaran Anda.',
                        showConfirmButton: false,
                        timer: 2000,
                        willClose: () => {
                            window.location.href =
                                "{{ route('payment.pending') }}?order_id=" + result
                                .order_id;
                        }
                    });
                },
                onError: function(result) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Pembayaran Gagal!',
                        text: 'Ada masalah saat proses pembayaran.',
                        showConfirmButton: false,
                        timer: 2000,
                        willClose: () => {
                            window.location.href = "/failed?order_id=" + result.order_id;
                        }
                    });
                },
                onClose: function() {
                    // Kalau user tutup snap, reset tombol lagi
                    payButton.disabled = false;
                    payButtonText.textContent = 'Bayar Sekarang';
                    payButtonSpinner.classList.add('hidden');

                    Swal.fire({
                        icon: 'info',
                        title: 'Pembayaran Belum Selesai',
                        text: 'Kamu menutup popup pembayaran sebelum selesai.'
                    });
                }
            });
        });

        // Back button
        const backButton = document.getElementById('back-button');
        backButton.addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Yakin mau kembali?',
                text: "Donasi kamu belum diselesaikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, kembali',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('home') }}";
                }
            });
        });
    </script>

</body>
