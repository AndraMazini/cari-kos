<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Juragan Kos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-white border-r border-gray-200 hidden md:block fixed h-full shadow-sm">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-green-600">AdminPanel</h1>
            </div>
            <nav class="mt-4 px-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 {{ request()->routeIs('admin.dashboard') ? 'bg-green-50 text-green-600 font-bold' : 'text-gray-600' }} rounded-lg transition">
                            <i class="fa-solid fa-chart-line w-6 text-center"></i>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.transactions.index') }}" class="flex items-center p-3 {{ request()->routeIs('admin.transactions.*') ? 'bg-green-50 text-green-600 font-bold' : 'text-gray-600' }} rounded-lg transition">
                            <i class="fa-solid fa-wallet w-6 text-center"></i>
                            <span class="ml-3">Kelola Transaksi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.cities.index') }}" class="flex items-center p-3 {{ request()->routeIs('admin.cities.*') ? 'bg-green-50 text-green-600 font-bold' : 'text-gray-600' }} rounded-lg transition">
                            <i class="fa-solid fa-city w-6 text-center"></i>
                            <span class="ml-3">Data Kota</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.facilities.index') }}" class="flex items-center p-3 {{ request()->routeIs('admin.facilities.*') ? 'bg-green-50 text-green-600 font-bold' : 'text-gray-600' }} rounded-lg transition">
                            <i class="fa-solid fa-list-check w-6 text-center"></i>
                            <span class="ml-3">Fasilitas</span>
                        </a>
                    </li>
                    <li class="pt-4 border-t mt-4">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center p-3 text-red-600 hover:bg-red-50 w-full rounded-lg transition text-left">
                                <i class="fa-solid fa-right-from-bracket w-6 text-center"></i>
                                <span class="ml-3 font-bold">Keluar</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="flex-1 p-8 ml-64">
            <header class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Statistik Aplikasi</h2>
                <p class="text-gray-500">Ringkasan data Juragan Kos hari ini.</p>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                    <p class="text-gray-400 text-sm font-bold uppercase mb-1">Total Kos</p>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['total_kos'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                    <p class="text-gray-400 text-sm font-bold uppercase mb-1">Kota</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['total_cities'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                    <p class="text-gray-400 text-sm font-bold uppercase mb-1">Transaksi</p>
                    <p class="text-3xl font-bold text-orange-600">{{ $stats['total_transactions'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                    <p class="text-gray-400 text-sm font-bold uppercase mb-1">Revenue</p>
                    <p class="text-xl font-bold text-gray-800">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <h3 class="font-bold text-gray-700">5 Transaksi Terbaru</h3>
                    <a href="{{ route('admin.transactions.index') }}" class="text-green-600 text-sm font-bold hover:underline">Lihat Semua</a>
                </div>
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-gray-400 uppercase text-xs font-bold border-b">
                            <th class="px-6 py-3">Penyewa</th>
                            <th class="px-6 py-3">Kos</th>
                            <th class="px-6 py-3">Total</th>
                            <th class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTransactions as $trx)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-bold">{{ $trx->user->name }}</td>
                            <td class="px-6 py-4">{{ $trx->room->boardingHouse->name }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-xs font-bold {{ $trx->status == 'approved' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                                    {{ strtoupper($trx->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-400">Belum ada transaksi masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

</body>
</html>