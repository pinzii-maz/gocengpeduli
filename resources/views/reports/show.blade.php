{{-- resources/views/reports/show.blade.php --}}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Laporan: {{ $donasi->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-10 px-4">
        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ route('laporan.index') }}" class="text-blue-600 hover:underline">&larr; Kembali ke Daftar
                Laporan</a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="border-b pb-4 mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $donasi->title }}</h1>
                    <p class="text-sm text-gray-500">Periode Selesai pada: {{ $donasi->deadline->format('d F Y') }}</p>
                </div>
                <div>
                    @if ($donasi->report_document)
                        <a href="{{ asset('storage/' . $donasi->report_document) }}" target="_blank"
                            class="inline-flex items-center gap-2 bg-green-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-700 transition shadow">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 4v12" />
                            </svg>
                            Unduh Laporan (PDF)
                        </a>
                    @endif
                </div>
            </div>

            {{-- Statistik Utama --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-blue-50 rounded-lg p-4 flex items-center gap-4 shadow-sm">
                    <div class="bg-blue-200 text-blue-700 rounded-full p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 10c-4.418 0-8-1.79-8-4V6c0-2.21 3.582-4 8-4s8 1.79 8 4v8c0 2.21-3.582 4-8 4z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="text-xs text-gray-500">Total Terkumpul</div>
                        <div class="text-xl font-bold text-blue-800">
                            {{ \App\Helpers\FormatHelpers::rupiah($donasi->total_terkumpul) }}</div>
                    </div>
                </div>
                <div class="bg-yellow-50 rounded-lg p-4 flex items-center gap-4 shadow-sm">
                    <div class="bg-yellow-200 text-yellow-700 rounded-full p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 10c-4.418 0-8-1.79-8-4V6c0-2.21 3.582-4 8-4s8 1.79 8 4v8c0 2.21-3.582 4-8 4z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="text-xs text-gray-500">Target</div>
                        <div class="text-xl font-bold text-yellow-800">
                            {{ \App\Helpers\FormatHelpers::rupiah($donasi->target_amount) }}</div>
                    </div>
                </div>
                <div class="bg-green-50 rounded-lg p-4 flex items-center gap-4 shadow-sm">
                    <div class="bg-green-200 text-green-700 rounded-full p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M12 4a4 4 0 014 4v4a4 4 0 01-8 0V8a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="text-xs text-gray-500">Total Donatur</div>
                        <div class="text-xl font-bold text-green-800">{{ $donasi->jumlah_donatur }}</div>
                    </div>
                </div>
            </div>

            {{-- Progress Bar --}}
            {{-- <div class="mb-8">
                <div class="flex items-center justify-between mb-1">
                    <span class="text-sm text-gray-600">Progress Penggalangan Dana</span>
                    <span class="text-sm font-semibold text-blue-700">{{ $donasi->persentase ?? 0 }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-3 rounded-full transition-all duration-700"
                        style="width: {{ $donasi->persentase ?? 0 }}%"></div>
                </div>
            </div> --}}

            {{-- Tab Interaktif: Laporan & Dokumentasi --}}
            <div x-data="{ tab: 'laporan' }" class="mb-8">
                <div class="flex gap-2 mb-4">
                    <button @click="tab = 'laporan'"
                        :class="tab === 'laporan' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700'"
                        class="px-4 py-2 rounded-t-lg font-semibold focus:outline-none">Laporan Penggunaan Dana</button>
                    <button @click="tab = 'dokumentasi'"
                        :class="tab === 'dokumentasi' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700'"
                        class="px-4 py-2 rounded-t-lg font-semibold focus:outline-none">Dokumentasi Foto</button>
                </div>
                <div class="bg-gray-50 rounded-b-lg p-4 min-h-[120px]">
                    <div x-show="tab === 'laporan'">
                        @if ($donasi->report_description)
                            <div class="prose max-w-none text-gray-700">
                                {!! nl2br(e($donasi->report_description)) !!}
                            </div>
                        @else
                            <div class="text-gray-400 italic">Belum ada laporan penggunaan dana.</div>
                        @endif
                    </div>
                    <div x-show="tab === 'dokumentasi'">
                        @if ($donasi->galleries)
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach ($donasi->galleries as $gallery)
                                    <a href="{{ asset('storage/' . $gallery->image) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $gallery->image) }}"
                                            alt="{{ $gallery->title ?? 'Dokumentasi' }}"
                                            class="h-32 w-full object-cover rounded-lg shadow-md hover:opacity-80 transition">
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="text-gray-400 italic">Belum ada dokumentasi foto.</div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Tabel Donatur --}}
            <div>
                <h3 class="text-lg font-semibold mb-2">Rincian Donatur</h3>
                <div class="max-h-96 overflow-y-auto border rounded-lg bg-white">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50 sticky top-0 z-10">
                            <tr>
                                <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Nama Donatur</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-right font-medium text-gray-500 uppercase">Jumlah Donasi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($donasi->successfulTransactions as $transaction)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                        {{ $transaction->donor_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                                        {{ $transaction->donor_email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800 text-right font-semibold">
                                        {{ \App\Helpers\FormatHelpers::rupiah($transaction->amount) }}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
