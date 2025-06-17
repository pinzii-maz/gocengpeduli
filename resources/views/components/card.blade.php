{{-- <div class="min-h-screen flex items-center justify-center p-4" id="donasi">
    <div x-data="{ isOpen: false }"
        class="w-full max-w-[320px] bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow cursor-pointer">
        <!-- Card Content -->
        <div @click="isOpen = true" class="group">
            <div class="relative">
                <img class="h-40 w-full object-cover md:h-48" src="https://picsum.photos/600/400" alt="Donasi">
                <!-- Deadline Badge -->
                <div
                    class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-medium flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>5 Hari Lagi</span>
                </div>
            </div>

            <div class="p-4">
                <div class="flex items-center gap-2 mb-2">
                    <span
                        class="inline-block px-2 py-0.5 text-xs font-medium text-white bg-green-500 rounded-full">EDUCATION</span>
                    <span class="text-gray-500 text-xs">• 150 Penerima Manfaat</span>
                </div>

                <h3 class="text-lg font-bold text-gray-800 truncate">Bantu Pendidikan Anak Yatim</h3>
                <p class="mt-2 text-gray-600 line-clamp-2 text-sm leading-relaxed">
                    Bantu 150 anak yatim di 5 panti asuhan dapatkan pendidikan lengkap selama 1 tahun.
                </p>

                <div class="mt-4">
                    <div class="flex justify-between items-center text-sm mb-1">
                        <span class="text-blue-600 font-semibold">Rp15.000.000</span>
                        <span class="text-gray-500">65%</span>
                    </div>
                    <div class="bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-blue-400 to-blue-500 rounded-full h-2" style="width: 65%">
                        </div>
                    </div>
                    <div class="flex justify-between mt-2">
                        <span class="text-xs text-gray-500">Target: Rp23.000.000</span>
                        <span class="text-xs text-gray-500">250 Donatur</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div x-show="isOpen" x-cloak class="fixed inset-0 z-50 bg-black/50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-3xl w-full overflow-hidden max-h-[90vh] overflow-y-auto"
                @click.outside="isOpen = false">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <!-- Image Section -->
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <img class="w-full h-48 md:h-96 object-cover" src="https://picsum.photos/800/600"
                            alt="Donation">
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h2 class="text-2xl font-bold">Bantu Pendidikan Anak Yatim</h2>
                                    <p class="mt-2 text-sm opacity-90">Masa Depan Cerah untuk 150 Anak Yatim</p>
                                </div>
                                <!-- Deadline in Modal -->
                                <div
                                    class="bg-red-500/90 text-white px-3 py-1 rounded-full text-xs font-medium flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>5 Hari Lagi</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Section -->
                    <div class="p-6 md:p-8 space-y-6" x-data="{ selectedAmount: null, paymentMethod: null, isLoading: false }">
                        <!-- Header Section -->
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Formulir Donasi</h2>
                                <p class="text-gray-600 mt-1">Isi data berikut untuk melanjutkan</p>
                            </div>
                            <button @click="isOpen = false"
                                class="text-gray-500 hover:text-gray-700 p-1 rounded-full hover:bg-gray-100 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Progress Section -->
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-semibold text-blue-800">Progress Penggalangan Dana</h3>
                                <span class="text-blue-600 font-semibold">65%</span>
                            </div>
                            <div class="bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-blue-400 to-blue-500 rounded-full h-2"
                                    style="width: 65%"></div>
                            </div>
                            <div class="flex justify-between mt-2 text-sm text-gray-600">
                                <span>Terkumpul: Rp15.000.000</span>
                                <span>Target: Rp23.000.000</span>
                            </div>
                        </div>

                        <!-- Form Content -->
                        <form class="space-y-6" action="{{ url('/checkout') }}" method="POST"
                            @submit.prevent="isLoading = true; setTimeout(() => { isLoading = false }, 1500) ">
                            @csrf
                            <!-- Donation Amount Section -->
                            <div class="space-y-4">
                                <label class="block text-sm font-medium text-gray-700">Jumlah Donasi</label>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                    <template x-for="amount in [50000, 100000, 250000, 500000, 1000000, 2000000]"
                                        :key="amount">
                                        <button type="button" @click="selectedAmount = amount"
                                            :class="selectedAmount === amount ? 'border-blue-500 bg-blue-50' :
                                                'border-gray-200 hover:border-blue-300'"
                                            class="p-2 md:p-3 border-2 rounded-lg transition-all duration-200 flex items-center justify-center text-sm md:text-base">
                                            <span x-text="formatRupiah(amount)"></span>
                                        </button>
                                    </template>
                                </div>

                                <script>
                                    function formatRupiah(amount) {
                                        if (amount >= 1000000) {
                                            return 'Rp ' + (amount / 1000000).toLocaleString('id-ID') + ' juta';
                                        }
                                        return 'Rp ' + (amount / 1000).toLocaleString('id-ID') + ' rb';
                                    }
                                </script>

                                <div class="relative">
                                    <input type="number" id="customAmount" x-model="selectedAmount" name="amount"
                                        placeholder="Masukkan nominal lain"
                                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm md:text-base"
                                        min="500" required>
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">Rp</span>
                                </div>
                            </div>

                            <!-- Payment Method Section -->


                            <!-- Personal Info Section -->
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                    <input type="text" required name="donor_name"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm md:text-base"
                                        placeholder="Contoh: Budi Santoso">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                                    <input type="email" required name="donor_email"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm md:text-base"
                                        placeholder="nama@email.com">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" :disabled="isLoading"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg font-medium transition-all flex items-center justify-center gap-2"
                                :class="isLoading ? 'opacity-75 cursor-not-allowed' : ''">
                                <template x-if="!isLoading">
                                    <span>Lanjutkan Pembayaran</span>
                                </template>
                                <template x-if="isLoading">
                                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
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
</div> --}}
