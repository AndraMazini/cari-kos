<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Juragan - {{ Auth::user()->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">

    <nav class="bg-white shadow p-4 mb-8">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-4">
                <h1 class="font-bold text-xl text-green-600"><i class="fa-solid fa-house-laptop"></i> Juragan Area</h1>
                <div class="hidden md:flex gap-4 ml-8 text-sm font-medium">
                    <a href="{{ route('owner.dashboard') }}" class="text-green-600 border-b-2 border-green-600 pb-1">Dashboard</a>
                    <a href="{{ route('owner.kos.index') }}" class="text-gray-500 hover:text-green-600 transition">Kelola Kos</a>
                    <a href="{{ route('owner.transactions.index') }}" class="text-gray-500 hover:text-green-600 transition">Data Penyewa</a>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <span class="hidden md:inline text-sm font-bold text-gray-700">Halo, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-red-500 hover:text-red-700" title="Keluar">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4">
        
        <div class="bg-gradient-to-r from-green-600 to-teal-500 rounded-xl p-8 mb-8 text-white shadow-lg relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-3xl font-bold mb-2">Selamat Datang, Juragan!</h2>
                <p class="text-green-100">Pantau perkembangan bisnis kosmu hari ini.</p>
            </div>
            <i class="fa-solid fa-chart-line absolute right-4 bottom-4 text-white opacity-20 text-8xl"></i>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Total Pendapatan</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">Rp{{ number_format($revenue, 0, ',', '.') }}</h3>
                    </div>
                    <div class="p-3 bg-green-50 rounded-lg text-green-600">
                        <i class="fa-solid fa-wallet text-xl"></i>
                    </div>
                </div>
                <p class="text-xs text-green-600 font-bold"><i class="fa-solid fa-arrow-trend-up"></i> Dari transaksi lunas</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Properti Kos</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $totalKos }} <span class="text-sm font-normal text-gray-500">Unit</span></h3>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-lg text-blue-600">
                        <i class="fa-solid fa-building text-xl"></i>
                    </div>
                </div>
                <a href="{{ route('owner.kos.create') }}" class="text-xs text-blue-500 hover:underline">Tambah properti baru &rarr;</a>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Kamar Terisi</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $filledRooms }} <span class="text-sm font-normal text-gray-500">Kamar</span></h3>
                    </div>
                    <div class="p-3 bg-orange-50 rounded-lg text-orange-600">
                        <i class="fa-solid fa-user-check text-xl"></i>
                    </div>
                </div>
                
                <div class="w-full bg-gray-200 rounded-full h-1.5">
                    @php 
                        $percent = ($totalRooms > 0) ? ($filledRooms / $totalRooms) * 100 : 0;
                    @endphp
                    <div class="bg-orange-500 h-1.5 rounded-full" @style(["width: {$percent}%"])></div>
                </div>

            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Kamar Kosong</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $emptyRooms }} <span class="text-sm font-normal text-gray-500">Kamar</span></h3>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg text-gray-600">
                        <i class="fa-solid fa-door-open text-xl"></i>
                    </div>
                </div>
                <p class="text-xs text-gray-400">Siap disewakan</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="font-bold text-gray-800">Transaksi Terbaru</h3>
                <a href="{{ route('owner.transactions.index') }}" class="text-sm text-green-600 hover:underline font-bold">Lihat Semua</a>
            </div>
            <table class="min-w-full divide-y divide-gray-100">
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentTransactions as $trx)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-600 mr-3">
                                    {{ substr($trx->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-sm">{{ $trx->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $trx->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-600 font-medium">{{ $trx->room->boardingHouse->name }}</p>
                            <p class="text-xs text-gray-400">{{ $trx->room->name }}</p>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <p class="font-bold text-green-600 text-sm">+ Rp{{ number_format($trx->total_amount, 0, ',', '.') }}</p>
                            <span class="text-[10px] px-2 py-0.5 rounded-full font-bold
                                {{ $trx->status == 'approved' ? 'bg-green-100 text-green-700' : 
                                  ($trx->status == 'pending' ? 'bg-orange-100 text-orange-700' : 
                                  ($trx->status == 'paid' ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700')) }}">
                                {{ ucfirst($trx->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada transaksi terbaru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>