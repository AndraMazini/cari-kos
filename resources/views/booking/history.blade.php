<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Sewa - Juragan Kos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="flex items-center text-gray-700 hover:text-green-600 font-medium">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Beranda
                </a>
                <div class="font-bold text-lg text-gray-800">Riwayat Sewa Saya</div>
                <div class="w-20"></div>
            </div>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto px-4 py-8">
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center">
                <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="space-y-4">
            @forelse($transactions as $trx)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition duration-300">
                    <div class="flex flex-col sm:flex-row gap-4">
                        
                        {{-- 1. BAGIAN GAMBAR --}}
                        <img src="{{ $trx->room?->boardingHouse?->thumbnail ? asset('storage/'.$trx->room->boardingHouse->thumbnail) : 'https://placehold.co/150?text=Kos+Dihapus' }}" 
                             alt="Foto Kos"
                             class="w-full sm:w-32 h-32 object-cover rounded-lg bg-gray-200">
                        
                        <div class="flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        {{-- 2. BAGIAN NAMA KOS --}}
                                        <h3 class="font-bold text-gray-800 text-lg leading-tight">
                                            {{ $trx->room?->boardingHouse?->name ?? 'Data Kos Telah Dihapus' }}
                                        </h3>
                                        
                                        {{-- 3. BAGIAN NAMA KAMAR --}}
                                        <p class="text-sm text-gray-500 mt-1">
                                            <i class="fa-solid fa-bed mr-1"></i> 
                                            {{ $trx->room?->name ?? 'Kamar Tidak Tersedia' }}
                                        </p>
                                    </div>
                                    
                                    {{-- STATUS BADGE --}}
                                    @php
                                        $statusClasses = [
                                            'pending' => 'bg-yellow-100 text-yellow-700',
                                            'paid' => 'bg-blue-100 text-blue-700',
                                            'approved' => 'bg-green-100 text-green-700',
                                            'rejected' => 'bg-red-100 text-red-700',
                                        ];
                                        $statusLabels = [
                                            'pending' => 'Menunggu Bayar',
                                            'paid' => 'Menunggu Konfirmasi',
                                            'approved' => 'Disewa',
                                            'rejected' => 'Ditolak',
                                        ];
                                    @endphp
                                    <span class="{{ $statusClasses[$trx->status] ?? 'bg-gray-100' }} text-xs px-2 py-1 rounded font-bold uppercase">
                                        {{ $statusLabels[$trx->status] ?? $trx->status }}
                                    </span>
                                </div>
                                
                                <div class="text-sm text-gray-500 mb-2">
                                    <i class="fa-regular fa-calendar mr-1"></i> 
                                    {{ \Carbon\Carbon::parse($trx->start_date)->translatedFormat('d M Y') }} 
                                    s/d 
                                    {{ \Carbon\Carbon::parse($trx->start_date)->addMonths($trx->duration)->translatedFormat('d M Y') }}
                                    <span class="bg-gray-100 text-gray-600 text-xs px-1.5 py-0.5 rounded ml-2">
                                        {{ $trx->duration }} Bulan
                                    </span>
                                </div>
                            </div>

                            <div class="flex justify-between items-end border-t border-gray-100 pt-3 mt-2">
                                <div>
                                    <p class="text-xs text-gray-400">Total Pembayaran</p>
                                    <p class="font-bold text-green-600 text-lg">Rp{{ number_format($trx->total_amount, 0, ',', '.') }}</p>
                                </div>

                                {{-- TOMBOL BAYAR (DIPERBAIKI) --}}
                                @if($trx->status == 'pending' && $trx->room)
                                    {{-- Gunakan array untuk parameter 'code' dan berikan fallback ID jika transaction_code null --}}
                                    <a href="{{ route('booking.payment', ['code' => $trx->transaction_code ?? $trx->id]) }}" 
                                       class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-green-700 transition shadow-lg shadow-green-100">
                                        Bayar Sekarang
                                    </a>
                                @elseif($trx->status == 'pending' && !$trx->room)
                                    <span class="bg-gray-200 text-gray-500 px-4 py-2 rounded-lg text-sm font-bold cursor-not-allowed">
                                        Tidak Bisa Bayar
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-16 bg-white rounded-xl border border-dashed border-gray-300">
                    <div class="inline-block p-4 bg-gray-50 rounded-full mb-4">
                        <i class="fa-solid fa-receipt text-3xl text-gray-300"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-700">Belum ada riwayat sewa</h3>
                    <p class="text-gray-500 mb-6">Kamu belum pernah melakukan booking kos apapun.</p>
                    <a href="{{ route('home') }}" class="bg-green-600 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-green-700 transition">
                        Cari Kos Dulu
                    </a>
                </div>
            @endforelse
        </div>
    </main>

</body>
</html>