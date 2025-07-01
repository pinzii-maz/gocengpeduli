{{-- resources/views/reports/index.blade.php --}}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Donasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-10 px-4" x-data="{ search: '' }">
        <h1 class="text-3xl font-bold text-center mb-2">Laporan Donasi Selesai</h1>
        <p class="text-center text-gray-500 mb-8">Daftar donasi yang telah selesai dan dapat dilihat laporannya.</p>

        <div class="flex justify-center mb-6">
            <input type="text" x-model="search" placeholder="Cari judul donasi..."
                class="w-full max-w-md px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($completedDonations as $donation)
                <div x-show="!search || '{{ strtolower($donation->title) }}'.includes(search.toLowerCase())"
                    class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="text-lg font-semibold text-blue-700 group-hover:text-blue-900 transition">
                                {{ $donation->title }}</h2>
                            <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded">Selesai:
                                {{ $donation->deadline->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center gap-4 mb-4">
                            <div class="flex items-center gap-2 bg-blue-50 px-3 py-1 rounded">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 10c-4.418 0-8-1.79-8-4V6c0-2.21 3.582-4 8-4s8 1.79 8 4v8c0 2.21-3.582 4-8 4z" />
                                </svg>
                                <span
                                    class="font-bold text-blue-700">{{ \App\Helpers\FormatHelpers::rupiah($donation->total_terkumpul) }}</span>
                            </div>
                            <div class="flex items-center gap-2 bg-green-50 px-3 py-1 rounded">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M12 4a4 4 0 014 4v4a4 4 0 01-8 0V8a4 4 0 014-4z" />
                                </svg>
                                <span class="font-bold text-green-700">{{ $donation->jumlah_donatur }}</span>
                            </div>
                        </div>
                        {{-- <div class="mb-4">
                            <div class="flex items-center justify-between text-xs text-gray-500 mb-1">
                                <span>Progress</span>
                                <span>{{ $donation->persentase ?? 0 }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-2 rounded-full transition-all duration-700"
                                    style="width: {{ $donation->persentase ?? 0 }}%"></div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="flex justify-end mt-4">
                        <a href="{{ route('laporan.show', $donation) }}"
                            class="inline-flex items-center gap-2 bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition group-hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full p-6 text-center text-gray-500">
                    Belum ada donasi yang selesai.
                </div>
            @endforelse
        </div>
    </div>
</body>

</html>
