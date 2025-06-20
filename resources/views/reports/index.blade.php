{{-- resources/views/reports/index.blade.php --}}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Donasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold text-center mb-8">Laporan Donasi Selesai</h1>

        <div class="bg-white rounded-lg shadow-md">
            <ul class="divide-y divide-gray-200">
                @forelse ($completedDonations as $donation)
                    <li class="p-4 hover:bg-gray-50 transition">
                        <a href="{{ route('laporan.show', $donation) }}" class="flex justify-between items-center">
                            {{-- Kiri: Judul & Tanggal --}}
                            <div>
                                <p class="text-lg font-semibold text-blue-700">{{ $donation->title }}</p>
                                <p class="text-sm text-gray-500">
                                    Selesai pada {{ $donation->deadline->format('d F Y') }}
                                </p>
                            </div>
                            {{-- Kanan: Statistik Ringkas & Tombol --}}
                            <div class="flex items-center gap-6 text-sm">
                                <div class="text-center hidden md:block">
                                    <p class="font-bold">
                                        {{ \App\Helpers\FormatHelpers::rupiah($donation->total_terkumpul) }}</p>
                                    <p class="text-xs text-gray-500">Terkumpul</p>
                                </div>
                                <div class="text-center hidden md:block">
                                    <p class="font-bold">{{ $donation->jumlah_donatur }}</p>
                                    <p class="text-xs text-gray-500">Donatur</p>
                                </div>
                                <span class="text-blue-600 font-semibold flex items-center gap-1">
                                    Lihat Detail &rarr;
                                </span>
                            </div>
                        </a>
                    </li>
                @empty
                    <li class="p-6 text-center text-gray-500">
                        Belum ada donasi yang selesai.
                    </li>
                @endforelse
            </ul>
        </div>
    </div>

</body>

</html>
