<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-white shadow px-6 py-4 mb-8">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">Admin Juragan Kos</h1>
            
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-500 hover:text-green-600 font-bold">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Dashboard
            </a>
            
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Semua Transaksi</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">{{ session('error') }}</div>
        @endif

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kode & Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Penyewa & Kamar</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Total & Bukti</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($transactions as $trx)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-bold text-gray-800">{{ $trx->code }}</span><br>
                            <span class="text-xs text-gray-500">{{ $trx->created_at->format('d M Y H:i') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $trx->user->name ?? 'Guest' }}</div>
                            
                            {{-- BAGIAN ANTI ERROR --}}
                            <div class="text-sm text-gray-500">
                                {{ $trx->room?->name ?? 'Kamar Dihapus' }}
                            </div>
                            <div class="text-xs text-gray-400">
                                {{ $trx->room?->boardingHouse?->name ?? 'Kos Dihapus' }}
                            </div>
                            {{-- ---------------- --}}
                            
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-green-600">Rp{{ number_format($trx->total_amount, 0, ',', '.') }}</div>
                            @if($trx->payment_proof)
                                <a href="{{ asset('storage/'.$trx->payment_proof) }}" target="_blank" class="text-xs text-blue-500 hover:underline">
                                    <i class="fa-solid fa-image"></i> Lihat Bukti
                                </a>
                            @else
                                <span class="text-xs text-red-400">Belum upload</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($trx->status == 'pending')
                                <span class="px-2 py-1 text-xs font-bold rounded bg-orange-100 text-orange-800">Pending</span>
                            @elseif($trx->status == 'paid')
                                <span class="px-2 py-1 text-xs font-bold rounded bg-blue-100 text-blue-800">Perlu Konfirmasi</span>
                            @elseif($trx->status == 'approved')
                                <span class="px-2 py-1 text-xs font-bold rounded bg-green-100 text-green-800">Lunas</span>
                            @elseif($trx->status == 'rejected')
                                <span class="px-2 py-1 text-xs font-bold rounded bg-red-100 text-red-800">Ditolak</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @if($trx->status == 'paid')
                                <div class="flex gap-2">
                                    <form action="{{ route('admin.transactions.approve', $trx->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700" onclick="return confirm('Setujui transaksi ini?')">Terima</button>
                                    </form>
                                    <form action="{{ route('admin.transactions.reject', $trx->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700" onclick="return confirm('Tolak transaksi ini?')">Tolak</button>
                                    </form>
                                </div>
                            @else
                                <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination (jika ada) --}}
        @if(method_exists($transactions, 'links'))
        <div class="mt-4">
            {{ $transactions->links() }}
        </div>
        @endif
        
    </div>

</body>
</html>