<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juragan Area - Kelola Kos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    {{-- NAVBAR JURAGAN AREA --}}
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-house-laptop text-green-600 text-xl"></i>
                    <span class="font-bold text-xl text-green-600">Juragan Area</span>
                </div>
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-green-600 text-sm font-medium transition">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Website
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        {{-- HEADER & TOMBOL TAMBAH --}}
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Kos Saya</h1>
            <a href="{{ route('owner.kos.create') }}" class="bg-green-600 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-green-700 transition shadow-md flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Kos
            </a>
        </div>

        {{-- ALERT SUCCESS --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center shadow-sm">
                <i class="fa-solid fa-circle-check mr-2 text-green-600"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- TABEL DAFTAR KOS --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Kos</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Kategori & Kota</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Harga Mulai</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($kosList as $kos)
                        <tr class="hover:bg-gray-50 transition">
                            
                            {{-- KOLOM 1: NAMA KOS --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    {{-- Gambar Thumbnail Kecil --}}
                                    <img src="{{ $kos->thumbnail ? asset('storage/'.$kos->thumbnail) : 'https://placehold.co/100?text=Kos' }}" 
                                         alt="Foto" 
                                         class="w-12 h-12 rounded-lg object-cover shadow-sm border border-gray-200">
                                    <span class="font-bold text-gray-900">{{ $kos->name }}</span>
                                </div>
                            </td>

                            {{-- KOLOM 2: KATEGORI --}}
                            <td class="px-6 py-4">
                                <div class="flex flex-col items-start gap-1">
                                    <span class="bg-gray-100 text-gray-800 text-[10px] font-bold px-2 py-0.5 rounded uppercase border border-gray-200">
                                        {{ $kos->category }}
                                    </span>
                                    <span class="text-sm text-gray-500 flex items-center">
                                        <i class="fa-solid fa-location-dot text-red-400 mr-1.5 text-xs"></i> 
                                        {{ $kos->city->name }}
                                    </span>
                                </div>
                            </td>

                            {{-- KOLOM 3: HARGA --}}
                            <td class="px-6 py-4">
                                <span class="font-bold text-green-600">Rp{{ number_format($kos->price_start_from, 0, ',', '.') }}</span>
                            </td>

                            {{-- KOLOM 4: AKSI (TOMBOL HAPUS ADA DISINI) --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    {{-- Lihat --}}
                                    <a href="{{ route('kos.show', $kos->slug) }}" target="_blank" class="text-blue-500 hover:text-blue-700" title="Lihat Tampilan">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    {{-- Atur Kamar --}}
                                    <a href="{{ route('owner.rooms.index', $kos->slug) }}" class="flex items-center gap-1 text-orange-500 hover:text-orange-700 font-bold text-sm" title="Kelola Kamar">
                                        <i class="fa-solid fa-door-open"></i> Atur Kamar
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('owner.kos.edit', $kos->id) }}" class="text-gray-400 hover:text-gray-600" title="Edit Data Kos">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    {{-- >>> TOMBOL HAPUS (SAMPAH) DISINI <<< --}}
                                    <form action="{{ route('owner.kos.destroy', $kos->id) }}" method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus kos {{ $kos->name }}? Data tidak bisa dikembalikan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 transition" title="Hapus Permanen">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                <div class="mb-2"><i class="fa-regular fa-folder-open text-4xl text-gray-300"></i></div>
                                <p>Belum ada kos yang kamu tambahkan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- PAGINATION --}}
            @if(method_exists($kosList, 'links'))
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $kosList->links() }}
                </div>
            @endif
        </div>

    </main>

</body>
</html>