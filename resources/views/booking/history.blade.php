<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Sewa Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">

    <nav class="bg-white shadow-sm mb-8 sticky top-0 z-50">
        <div class="max-w-3xl mx-auto px-4 h-16 flex justify-between items-center">
            <a href="{{ route('home') }}" class="font-bold text-green-600 text-lg hover:text-green-700 transition">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Home
            </a>
            <span class="text-gray-800 font-bold text-lg">Riwayat Sewa</span>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto px-4 pb-10">
        
        @forelse($transactions as $trx)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-4 hover:shadow-md transition duration-300">
                <div class="flex flex-col sm:flex-row gap-4">
                    <img src="{{ $trx->room->boardingHouse->thumbnail ? asset('storage/'.$trx->room->boardingHouse->thumbnail) : 'https://placehold.co/150?text=No+Image' }}" 
                         class="w-full sm:w-32 h-32 object-cover rounded-lg bg-gray-200">
                    
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="font-bold text-gray-800 text-lg leading-tight">{{ $trx->room->boardingHouse->name }}</h3>
                                    <p class="text-sm text-gray-500 mt-1"><i class="fa-solid fa-bed mr-1"></i> {{ $trx->room->name }}</p>
                                </div>
                                
                                @if($trx->status == 'pending')
                                    <span class="bg-orange-100 text-orange-700 text-xs px-3 py-1 rounded-full font-bold whitespace-nowrap">Menunggu Pembayaran</span>
                                @elseif($trx->status == 'paid')
                                    <span class="bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full font-bold whitespace-nowrap">Verifikasi Admin</span>
                                @elseif($trx->status == 'approved')
                                    <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-bold whitespace-nowrap">Aktif / Lunas</span>
                                @elseif($trx->status == 'rejected')
                                    <span class="bg-red-100 text-red-700 text-xs px-3 py-1 rounded-full font-bold whitespace-nowrap">Ditolak</span>
                                @endif
                            </div>
                            
                            <p class="text-sm text-gray-500"><i class="fa-regular fa-calendar mr-1"></i> Durasi: {{ $trx->duration }} Bulan</p>
                        </div>

                        <div class="flex justify-between items-end mt-4 pt-4 border-t border-gray-50">
                            <div>
                                <p class="text-xs text-gray-400">Total Tagihan</p>
                                <p class="font-bold text-green-600 text-lg">Rp{{ number_format($trx->total_amount, 0, ',', '.') }}</p>
                            </div>
                            
                            <a href="{{ route('booking.payment', $trx->code) }}" 
                               class="bg-gray-800 text-white text-sm px-5 py-2 rounded-lg hover:bg-gray-900 transition font-medium shadow-sm">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-20 bg-white rounded-xl shadow-sm border border-dashed border-gray-300">
                <div class="inline-block p-4 rounded-full bg-gray-50 mb-4">
                    <i class="fa-regular fa-folder-open text-gray-400 text-4xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-700">Belum ada riwayat sewa</h3>
                <p class="text-gray-500 mb-6 mt-1">Kamu belum pernah menyewa kos di sini.</p>
                <a href="{{ route('home') }}" class="bg-green-600 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-green-700 transition shadow-lg shadow-green-200">
                    Cari Kos Sekarang
                </a>
            </div>
        @endforelse

    </div>

</body>
</html>