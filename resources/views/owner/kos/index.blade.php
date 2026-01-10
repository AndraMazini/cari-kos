<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kos Saya</title>
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
                    <a href="{{ route('owner.kos.index') }}" class="text-green-600 border-b-2 border-green-600 pb-1">Kelola Kos</a>
                    <a href="{{ route('owner.transactions.index') }}" class="text-gray-500 hover:text-green-600 transition">Data Penyewa</a>
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
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Daftar Kos Saya</h2>
            <a href="{{ route('owner.kos.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-green-700 shadow-lg shadow-green-200 transition">
                <i class="fa-solid fa-plus mr-2"></i> Tambah Kos
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Nama Kos</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Kategori & Kota</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Harga Mulai</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($kosList as $kos)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <img src="{{ $kos->thumbnail ? asset('storage/'.$kos->thumbnail) : 'https://placehold.co/50' }}" class="h-12 w-12 rounded-lg object-cover mr-4 bg-gray-200">
                                <span class="font-bold text-gray-900">{{ $kos->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded font-bold mb-1">{{ $kos->category }}</span>
                            <div class="text-sm text-gray-500"><i class="fa-solid fa-location-dot text-red-400"></i> {{ $kos->city->name }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm font-bold text-green-600">
                            Rp{{ number_format($kos->price_start_from, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium">
                            <a href="{{ route('kos.show', $kos->slug) }}" target="_blank" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat di Web">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="{{ route('owner.rooms.index', $kos->slug) }}" class="text-orange-600 hover:text-orange-900 mr-3 font-bold" title="Kelola Kamar">
                                <i class="fa-solid fa-door-open"></i> Atur Kamar
                            </a>
                            
                            <a href="#" class="text-gray-400 hover:text-gray-600 cursor-not-allowed" title="Edit Kos (Segera Hadir)">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            <div class="mb-2"><i class="fa-regular fa-folder-open text-4xl text-gray-300"></i></div>
                            Belum ada kos yang kamu daftarkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>