<div>
    <div class="max-w-3xl mx-auto p-6 space-y-10 font-sans[sans-serif] mt-12 pt-20" id="tata-cara-donasi">
        <!-- Judul Section -->
        <div class="text-center mb-8 mt-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Tata Cara Donasi</h2>
            <p class="text-gray-600">Ikuti 4 langkah mudah berikut untuk melakukan donasi</p>
        </div>

        <!-- Timeline Container -->
        <div class="relative">
            <!-- Garis Vertikal -->
            <div class="absolute left-7 top-2 h-full w-0.5 bg-tertiary"></div>

            <!-- Step 1 - Isi Formulir -->
            <div class="relative flex gap-4 mb-8">
                <div
                    class="relative z-10 flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-quaternary text-white">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>

                <div class="flex-1 bg-senary p-6 rounded-xl shadow-md border border-green-50">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg font-semibold text-neutral-100">Step 1</h3>
                        <span class="px-3 py-1 text-sm bg-green-100 text-green-600 rounded-full">Wajib</span>
                    </div>
                    <h4 class="text-xl font-bold text-neutral-100 mb-2">Mulai Donasi Anda</h4>
                    <p class="text-neutral-100 mb-4">
                        Isi formulir singkat dengan informasi dasar dan pilihan program donasi yang ingin Anda dukung.
                    </p>
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <p class="text-sm text-blue-600">💡 pastikan email anda akftif dan nama anda sudah benar
                        </p>
                    </div>
                </div>
            </div>


            <!-- Step 2 - Verifikasi Data -->
            <div class="relative flex gap-4 mb-8">
                <div
                    class="relative z-10 flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-quaternary text-white">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                    </svg>
                </div>

                <div class="flex-1 bg-senary p-6 rounded-xl shadow-md border border-green-50">
                    <h3 class="text-lg font-semibold  text-neutral-100 mb-2">Step 2</h3>
                    <h4 class="text-xl font-bold  text-neutral-100 mb-2">Contoh Formulir Donasi</h4>
                    <p class=" text-neutral-100 mb-4">
                        Anda Dapat melihat contoh formulir donasi di bawah ini
                    </p>
                    <div class="flex items-center space-x-4">
                        <div x-data="{ showContohForm: false }">
                            <button @click="showContohForm = true"
                                class="px-4 py-2 bg-quinary text-black rounded-lg border border-neutral-100 hover:bg-white transition">
                                Lihat Contoh Form
                            </button>

                            <!-- Modal Contoh Form -->
                            <div x-show="showContohForm" @click.away="showContohForm = false"
                                class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
                                x-cloak x-data="{ selectedAmount: null, paymentMethod: null, isLoading: false }" @keydown.escape.window="showContohForm = false">

                                <div class="bg-white rounded-xl max-w-md w-full mx-4 overflow-hidden shadow-2xl">
                                    <!-- Header -->
                                    <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
                                        <h3 class="text-xl font-bold text-gray-800">Form Donasi</h3>
                                        <button @click="showContohForm = false"
                                            class="text-gray-500 hover:text-gray-700 transition-colors"
                                            aria-label="Tutup">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Body -->
                                    <div class="p-6 max-h-[80vh] overflow-y-auto">
                                        <form class="space-y-6"
                                            @submit.prevent="isLoading = true; setTimeout(() => { isLoading = false; showContohForm = false }, 1500)">
                                            <!-- Jumlah Donasi -->
                                            <div class="space-y-4">
                                                <label class="block text-sm font-medium text-gray-700">Pilih Jumlah
                                                    Donasi</label>
                                                <div class="grid grid-cols-2 gap-3">
                                                    <template x-for="amount in [50000, 100000, 250000, 500000]">
                                                        <button type="button"
                                                            @click="selectedAmount = amount; document.getElementById('customAmount').value = ''"
                                                            :class="selectedAmount === amount ?
                                                                'border-blue-500 bg-blue-50' :
                                                                'border-gray-200 hover:border-blue-300'"
                                                            class="p-4 border-2 rounded-lg transition-all duration-200 flex items-center justify-center">
                                                            <span class="font-medium"
                                                                x-text="'Rp ' + (amount/1000).toLocaleString('id-ID') + 'rb'"></span>
                                                        </button>
                                                    </template>
                                                </div>

                                                <div class="relative">
                                                    <input type="number" id="customAmount"
                                                        @input="selectedAmount = null"
                                                        placeholder="Masukkan jumlah custom"
                                                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                        min="10000">
                                                    <span
                                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">Rp</span>
                                                </div>
                                            </div>

                                            <!-- Metode Pembayaran -->
                                            <div class="space-y-4">
                                                <label class="block text-sm font-medium text-gray-700">Metode
                                                    Pembayaran</label>
                                                <div class="space-y-3">
                                                    <template
                                                        x-for="method in [
                            { id: 'bank', name: 'Transfer Bank', desc: 'BCA, Mandiri, BRI, BNI' },
                            { id: 'ewallet', name: 'E-Wallet', desc: 'Gopay, OVO, Dana' },
                            { id: 'cc', name: 'Kartu Kredit', desc: 'Visa, Mastercard, JCB' }
                        ]">
                                                        <label
                                                            :class="paymentMethod === method.id ?
                                                                'border-blue-500 bg-blue-50' :
                                                                'border-gray-200 hover:border-blue-300'"
                                                            class="flex items-center p-4 border-2 rounded-lg cursor-pointer transition-colors duration-200">
                                                            <input type="radio" name="paymentMethod"
                                                                :value="method.id" x-model="paymentMethod"
                                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500">

                                                            <div class="ml-3 flex-1">
                                                                <span class="block font-medium text-gray-900"
                                                                    x-text="method.name"></span>
                                                                <span class="block text-sm text-gray-500"
                                                                    x-text="method.desc"></span>
                                                            </div>

                                                            <div class="w-8 h-8 ml-2 flex items-center justify-center">
                                                                <template x-if="paymentMethod === method.id">
                                                                    <svg class="w-5 h-5 text-blue-600"
                                                                        fill="currentColor" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd"
                                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                            clip-rule="evenodd" />
                                                                    </svg>
                                                                </template>
                                                            </div>
                                                        </label>
                                                    </template>
                                                </div>
                                            </div>

                                            <!-- Data Diri -->
                                            <div class="space-y-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama
                                                        Lengkap</label>
                                                    <input type="text" required
                                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                                                        placeholder="Contoh: Budi Santoso">
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                                    <input type="email" required
                                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                                                        placeholder="nama@email.com">
                                                </div>
                                            </div>

                                            <!-- Tombol Submit -->
                                            <button type="submit" :disabled="isLoading"
                                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg font-medium transition-all flex items-center justify-center"
                                                :class="isLoading ? 'opacity-75 cursor-not-allowed' : ''">
                                                <template x-if="!isLoading">
                                                    <span>Lanjutkan Pembayaran</span>
                                                </template>
                                                <template x-if="isLoading">
                                                    <svg class="animate-spin h-5 w-5 text-white"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12"
                                                            r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor"
                                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                        </path>
                                                    </svg>
                                                </template>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3 - Pembayaran -->
            <div class="relative flex gap-4">
                <div
                    class="relative z-10 flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-quaternary text-white">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                    </svg>
                </div>

                <div class="flex-1 bg-senary p-6 rounded-xl shadow-md border border-green-50">
                    <h3 class="text-lg font-semibold  text-neutral-100 mb-2">Step 3</h3>
                    <h4 class="text-xl font-bold  text-neutral-100 mb-2">Metode Pembayaran</h4>
                    <p class=" text-neutral-100 mb-4">
                        Pilih metode pembayaran yang tersedia dan lakukan transfer sesuai nominal
                    </p>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="p-3 border rounded-lg hover:border-green-300 cursor-pointer">
                            <img src="{{ asset('money.png') }}" alt="Bank Transfer" class="h-8 mx-auto">
                            <p class="text-center text-white">Tranfer Bank</p>
                        </div>
                        <div class="p-3 border rounded-lg hover:border-green-300 cursor-pointer">
                            <img src="ewallet.png" alt="E-Wallet" class="h-8 mx-auto">
                            <p class="text-center text-white">E - Wallet</p>
                        </div>
                        <div class="p-3 border rounded-lg hover:border-green-300 cursor-pointer">
                            <img src="{{ asset('credit-card.png') }}" alt="Credit Card" class="h-8 mx-auto">
                            <p class="text-center text-white">Kartu Kredit</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative flex gap-4 mt-6"> <!-- Tambahkan margin-top -->
                <div
                    class="relative z-10 flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-quaternary text-white">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <div class="flex-1 bg-senary p-6 rounded-xl shadow-md border border-green-50">
                    <h3 class="text-lg font-semibold text-neutral-100 mb-2">Step 4</h3>
                    <h4 class="text-xl font-bold text-neutral-100 mb-3">Donasi Tercatat!</h4>
                    <p class="text-neutral-100 mb-4">
                        Terima kasih telah menjadi bagian dari perubahan! 🎉<br>
                        <span class="block mt-2">Status donasi akan diperbarui dalam 1x24 jam melalui:</span>
                    </p>

                    <div class="space-y-4">
                        <div class="bg-green-50 p-4 rounded-lg flex items-start gap-3">
                            <svg class="w-6 h-6 mt-1 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="text-sm text-green-600 font-medium">Pelacakan Donasi</p>
                                <div class="flex gap-3 mt-2">
                                    <a href="#"
                                        class="text-green-600 text-sm hover:underline flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Email
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
