<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Checkout Donasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/lucide@latest"></script>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-50 font-sans">

    <div class="min-h-screen flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-center">

                <!-- Left Side: Content -->
                <div class="space-y-8">
                    <!-- Header -->
                    <div>
                        <span
                            class="inline-block bg-blue-100 text-blue-700 text-sm font-semibold px-4 py-2 rounded-full mb-4">
                            Satu Langkah Lagi
                        </span>
                        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight">
                            Periksa Kembali Donasi Anda
                        </h1>
                        <p class="mt-4 text-lg text-gray-600">
                            Pastikan semua informasi sudah benar sebelum melanjutkan ke proses pembayaran yang aman.
                        </p>
                    </div>

                    <!-- Donation Details Card -->
                    <div class="bg-white border border-gray-200 rounded-xl p-6 space-y-4 shadow-sm">
                        <div class="flex justify-between items-start">
                            <span class="text-gray-500 text-sm">Program Donasi</span>
                            <span class="font-bold text-gray-800 text-right">{{ $transaksi->donasi->title }}</span>
                        </div>
                        <div class="border-t border-gray-100"></div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 text-sm">Nama Donatur</span>
                            <span class="font-medium text-gray-800">{{ $transaksi->donor_name }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 text-sm">Email</span>
                            <span class="font-medium text-gray-800 truncate">{{ $transaksi->donor_email }}</span>
                        </div>
                        <div class="border-t border-gray-100"></div>
                        <div class="bg-blue-50/50 rounded-lg p-4 flex justify-between items-center">
                            <span class="font-semibold text-blue-900">Total Donasi</span>
                            <span
                                class="font-extrabold text-blue-700 text-2xl">Rp{{ number_format($transaksi->amount, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <button id="back-button"
                            class="w-full border border-gray-300 text-gray-700 font-semibold py-3 rounded-lg hover:bg-gray-100 transition duration-300">
                            Batalkan
                        </button>
                        <button id="pay-button"
                            class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition duration-300 shadow-md flex items-center justify-center gap-2">
                            <span id="pay-button-text">Lanjutkan Pembayaran</span>
                            <svg id="pay-button-spinner" class="animate-spin h-5 w-5 text-white hidden"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Right Side: Illustration -->
                <div class="hidden lg:flex items-center justify-center">
                    <img src="{{ asset('ilustrasi-checkout.png') }}" alt="Ilustrasi Checkout Donasi"
                        class="w-full max-w-md object-contain">
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        const payButton = document.getElementById('pay-button');
        const payButtonText = document.getElementById('pay-button-text');
        const payButtonSpinner = document.getElementById('pay-button-spinner');

        payButton.addEventListener('click', function() {
            payButton.disabled = true;
            payButtonText.textContent = 'Memproses...';
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
                    payButton.disabled = false;
                    payButtonText.textContent = 'Lanjutkan Pembayaran';
                    payButtonSpinner.classList.add('hidden');
                    Swal.fire({
                        icon: 'info',
                        title: 'Pembayaran Belum Selesai',
                        text: 'Anda menutup popup pembayaran sebelum selesai.'
                    });
                }
            });
        });

        const backButton = document.getElementById('back-button');
        backButton.addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Yakin ingin kembali?',
                text: "Donasi Anda belum diselesaikan!",
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

</html>
