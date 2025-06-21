<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Home</title>
</head>

<body class="bg-gradient-to-b from-primary via-secondary via-50% to-quaternary"">

    {{-- header --}}
    <x-header></x-header>
    {{-- header end --}}

    {{-- section start --}}

    <x-section></x-section>

    <x-tata-cara></x-tata-cara>

    {{-- card start --}}
    <div class="min-h-screen p-4" id="donasi">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mx-auto">
            @foreach ($donasi as $item)
                <div x-data="{ isOpen: false }"
                    class="w-full bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow cursor-pointer">
                    <!-- Card Content -->
                    <div @click="isOpen = true" class="group">
                        <div class="relative">
                            <img class="h-40 w-full object-cover md:h-48 rounded-t-lg"
                                src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">

                            @php
                                $daysLeft = $item->deadline->isFuture() ? $item->deadline->diffInDays(now()) : 0;
                            @endphp

                            <div
                                class="absolute top-2 right-2 {{ $item->deadline_bg_color }} text-white px-3 py-1 rounded-full text-xs flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $item->deadline_label }}</span>
                            </div>

                        </div>
                        <div class="p-4 flex flex-col flex-grow"> {{-- Tambahan flex untuk layout rata --}}

                            {{-- Kategori, Judul, Deskripsi (Bagian Atas) --}}
                            <div>
                                <div class="flex items-center gap-2 mb-2">
                                    <span
                                        class="inline-block px-2 py-1 text-xs font-semibold text-white bg-green-600 rounded-full">
                                        {{ $item->category->name ?? 'Tanpa Kategori' }}
                                    </span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 truncate">{{ $item->title }}</h3>
                                <p class="mt-1 text-gray-600 text-sm line-clamp-2 flex-grow">{{ $item->description }}
                                </p>
                            </div>

                            {{-- Blok Statistik Donasi (Bagian Bawah yang Diperbaiki) --}}
                            <div class="mt-auto pt-4 border-t">

                                {{-- Progress Bar (hanya tampil jika ada target) --}}
                                @if ($item->target_amount > 0)
                                    <div class="mb-2" title="{{ $item->persentase }}% tercapai">
                                        <div class="bg-gray-200 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-teal-400 to-blue-500 h-2 rounded-full"
                                                style="width: {{ $item->persentase }}%">
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Info Dana Terkumpul, Target, dan Donatur --}}
                                <div class="flex justify-between items-end">

                                    {{-- Kiri: Dana Terkumpul (dibuat lebih menonjol) --}}
                                    <div>
                                        <span class="text-xs text-gray-500">Terkumpul</span>
                                        <p class="text-sm font-bold text-gray-800">
                                            {{ \App\Helpers\FormatHelpers::rupiah($item->total_terkumpul) }}
                                        </p>
                                    </div>

                                    {{-- Kanan: Target Dana atau Jumlah Donatur --}}
                                    <div class="text-right">
                                        @if ($item->target_amount > 0)
                                            <span class="text-sm text-gray-500">Target</span>
                                            <p class="font-semibold text-sm text-gray-700">
                                                {{ \App\Helpers\FormatHelpers::rupiah($item->target_amount) }}
                                            </p>
                                        @else
                                            <span
                                                class="text-sm font-semibold text-gray-700">{{ $item->jumlah_donatur }}
                                                Donatur</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div x-show="isOpen" x-cloak
                        class="fixed inset-0 z-50 bg-black/50 flex items-center justify-center p-4"
                        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        <div class="bg-white rounded-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
                            <div class="grid grid-cols-1 lg:grid-cols-2">
                                <!-- Image Section -->
                                <div class="relative group">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                    <img class="w-full h-48 md:h-96 object-cover"
                                        src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h2 class="text-2xl font-bold">{{ $item->title }}</h2>
                                                <p class="mt-2 text-sm opacity-90">{{ $item->description }}</p>
                                            </div>
                                            <div
                                                class="bg-red-500/90 text-white px-3 py-1 rounded-full text-xs flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>{{ $item->deadline_label }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Section -->
                                <div class="p-6 md:p-8 space-y-6" x-data="{ selectedAmount: null }">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h2 class="text-2xl font-bold text-gray-800">Formulir Donasi</h2>
                                            <p class="text-gray-600 mt-1">Isi data berikut untuk melanjutkan</p>
                                        </div>
                                        <button @click="isOpen = false" class="text-gray-500 hover:text-gray-700">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Progress Section -->
                                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                                        <div class="flex justify-between items-center text-sm text-gray-600 mb-1">
                                            <span>Terkumpul</span>
                                            <span>{{ \App\Helpers\FormatHelpers::rupiah($item->total_terkumpul) }}</span>
                                        </div>
                                        <div class="bg-gray-200 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-blue-400 to-blue-500 rounded-full h-2"
                                                style="width: {{ $item->persentase }}%"></div>
                                        </div>
                                        <div class="flex justify-between items-center text-sm text-gray-600 mt-1">
                                            <span>Target</span>
                                            <span>{{ \App\Helpers\FormatHelpers::rupiah($item->target_amount) }}</span>
                                        </div>
                                    </div>

                                    <!-- Form Content Tetap Sama -->
                                    <form class="space-y-6" action="/checkout" method="POST">
                                        @csrf
                                        <input type="hidden" name="donation_id" value="{{ $item->id }}">
                                        <!-- Donation Amount Section -->
                                        <div class="space-y-4">
                                            <label class="block text-sm font-medium text-gray-700">Jumlah
                                                Donasi</label>
                                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                                <template
                                                    x-for="amount in [50000, 100000, 250000, 500000, 1000000, 2000000]"
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

                                            <div class="relative" x-data="{ isCustom: false }">
                                                <label for="customAmount" x-show="isCustom"
                                                    class="absolute -top-2 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900"
                                                    x-transition:enter="transition ease-out duration-200"
                                                    x-transition:enter-start="opacity-0 scale-95"
                                                    x-transition:enter-end="opacity-100 scale-100"
                                                    x-transition:leave="transition ease-in duration-100"
                                                    x-transition:leave-start="opacity-100 scale-100"
                                                    x-transition:leave-end="opacity-0 scale-95">
                                                    Minimal Rp 1.000
                                                </label>
                                                <input type="number" id="customAmount" x-model="selectedAmount"
                                                    @focus="isCustom = true"
                                                    @blur="isCustom = (selectedAmount !== null && selectedAmount !== '')"
                                                    name="amount" placeholder="Masukkan nominal lain"
                                                    class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm md:text-base"
                                                    min="1000" required>
                                            </div>
                                        </div>


                                        <!-- Personal Info Section -->
                                        <div class="space-y-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama
                                                    Lengkap</label>
                                                <input type="text" required name="donor_name"
                                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm md:text-base"
                                                    placeholder="Contoh: Budi Santoso">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat
                                                    Email</label>
                                                <input type="email" required name="donor_email"
                                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm md:text-base"
                                                    placeholder="nama@email.com">
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <button type="submit" id="submitBtn"
                                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg font-medium transition-all">
                                            Lanjutkan Pembayaran
                                        </button>
                                    </form>
                                    <!-- ... (bagian form tetap seperti yang Anda miliki) ... -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
    {{-- card end --}}


    {{-- Gallery start --}}
    <x-gallery :galleries="$galleries"></x-gallery>
    {{-- Gallery end --}}

    {{-- section end --}}


    {{-- footer --}}
    <x-footer></x-footer>
    {{-- footer end --}}

    <script>
        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Refresh CSRF token sebelum submit
            fetch('/csrf-token')
                .then(response => response.json())
                .then(data => {
                    // Update CSRF token
                    document.querySelector('input[name="_token"]').value = data.token;
                    // Submit form
                    this.submit();
                })
                .catch(error => {
                    console.error('Error refreshing CSRF token:', error);
                    // Submit anyway
                    this.submit();
                });
        });
    </script>

</body>

</html>
