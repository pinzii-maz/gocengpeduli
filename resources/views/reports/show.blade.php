{{-- resources/views/reports/show.blade.php --}}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Laporan: {{ $donasi->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto py-10 px-4">
        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ route('laporan.index') }}" class="text-blue-600 hover:underline">&larr; Kembali ke Daftar
                Laporan</a>
        </div>

        {{-- Ini adalah blok konten yang kita pindahkan --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="border-b pb-4 mb-4">
                <h1 class="text-3xl font-bold text-gray-800">{{ $donasi->title }}</h1>
                <p class="text-sm text-gray-500">Periode Selesai pada: {{ $donasi->deadline->format('d F Y') }}</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6 text-center">
                <div>
                    <span class="text-sm text-gray-500">Total Terkumpul</span>
                    <p class="font-bold">
                        {{ \App\Helpers\FormatHelpers::rupiah($donasi->total_terkumpul) }}</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500">Total Donatur</span>
                    <p class="text-2xl font-bold text-blue-600">{{ $donasi->jumlah_donatur }}</p>
                </div>
                <div class="col-span-2 md:col-span-1">
                    @if ($donasi->report_document)
                        <a href="{{ asset('storage/' . $donasi->report_document) }}" target="_blank"
                            class="w-full inline-block bg-green-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-green-700 transition">
                            Unduh Laporan (PDF)
                        </a>
                    @else
                        <div class="w-full text-center bg-gray-200 text-gray-500 font-semibold py-3 px-6 rounded-lg">
                            Laporan Belum Tersedia
                        </div>
                    @endif
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-2">Rincian Donatur</h3>
                <div class="max-h-96 overflow-y-auto border rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Donatur
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Jumlah
                                    Donasi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($donasi->successfulTransactions as $transaction)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $transaction->donor_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $transaction->donor_email }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 text-right font-semibold">
                                        @rupiah($transaction->amount)</td>
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
