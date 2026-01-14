<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penyewa Masuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">

    <nav class="bg-white shadow p-4 mb-8">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-4">
                <h1 class="font-bold text-xl text-green-600"><i class="fa-solid fa-house-laptop"></i> Juragan Area</h1>
                <div class="hidden md:flex gap-4 ml-8 text-sm font-medium">
                    <a href="{{ route('owner.dashboard') }}" class="text-gray-500 hover:text-green-600 transition">Dashboard</a>
                    <a href="{{ route('owner.kos.index') }}" class="text-gray-500 hover:text-green-600 transition">Kelola Kos</a>
                    <a href="{{ route('owner.transactions.index') }}" class="text-green-600 border-b-2 border-green-600 pb-1">Data Penyewa</a>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <span class="hidden md:inline text-sm font-bold text-gray-700">Halo, {{ Auth::user()->name }}</span>
                <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-green-600 font-bold" title="Ke Halaman Utama">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Pesanan Masuk</h2>

        <div class="bg-white rounded-xl shadow overflow-hidden border border-gray-100">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Penyewa</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Kamar & Kos</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Durasi</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($transactions as $trx)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-bold text-gray-800">{{ $trx->created_at->format('d M Y') }}</span><br>
                            <span class="text-xs text-gray-500">{{ $trx->code }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold mr-3">
                                    {{ substr($trx->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-gray-900">{{ $trx->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $trx->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 font-medium">{{ $trx->room->name }}</div>
                            <div class="text-xs text-gray-500">{{ $trx->room->boardingHouse->name }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $trx->duration }} Bulan<br>
                            <span class="text-xs text-green-600 font-bold">Rp{{ number_format($trx->total_amount, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($trx->status == 'approved')
                                <span class="px-2 py-1 text-xs font-bold rounded bg-green-100 text-green-800 border border-green-200">
                                    <i class="fa-solid fa-check-circle mr-1"></i> Aktif
                                </span>
                            @elseif($trx->status == 'pending')
                                <span class="px-2 py-1 text-xs font-bold rounded bg-orange-100 text-orange-800 border border-orange-200">
                                    Menunggu Bayar
                                </span>
                            @elseif($trx->status == 'paid')
                                <span class="px-2 py-1 text-xs font-bold rounded bg-blue-100 text-blue-800 border border-blue-200">
                                    Verifikasi Admin
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs font-bold rounded bg-red-100 text-red-800 border border-red-200">
                                    Dibatalkan
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            <i class="fa-solid fa-inbox text-4xl text-gray-200 mb-3 block"></i>
                            Belum ada pesanan masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>