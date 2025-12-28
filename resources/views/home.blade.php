<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Kos Murah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; }
    </style>
</head>
<body>

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center flex-1">
                    <div class="flex-shrink-0 flex items-center mr-4">
                        <div class="bg-green-100 p-2 rounded-full">
                           <i class="fa-solid fa-user-ninja text-green-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="w-full max-w-lg relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                        </span>
                        <input type="text" class="block w-full pl-10 pr-20 py-2 border border-gray-300 rounded-md leading-5 bg-gray-50 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-green-500 focus:ring-1 focus:ring-green-500 sm:text-sm" placeholder="Masukan nama lokasi/area/alamat">
                        <button class="absolute inset-y-0 right-0 px-4 py-1 m-1 bg-green-500 text-white font-bold rounded text-sm hover:bg-green-600">
                            Cari
                        </button>
                    </div>
                </div>

                <div class="hidden md:flex items-center space-x-6 text-sm font-medium text-gray-700">
                    <a href="#" class="hover:text-green-600 flex items-center gap-1">Cari Apa? <i class="fa-solid fa-chevron-down text-xs"></i></a>
                    <a href="#" class="hover:text-green-600">Pusat Bantuan</a>
                    <a href="#" class="hover:text-green-600">Syarat dan Ketentuan</a>
                    <a href="#" class="border border-green-500 text-green-500 px-4 py-1.5 rounded hover:bg-green-50">Masuk</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
            <div class="flex items-center gap-4 mb-4 md:mb-0">
                <h2 class="text-2xl font-bold text-gray-800">Promo Ngebut</h2>
                
                <div class="relative group">
                    <button class="flex items-center gap-1 text-green-600 font-bold bg-white border border-gray-200 px-3 py-1 rounded shadow-sm">
                        Semua Kota <i class="fa-solid fa-caret-down"></i>
                    </button>
                </div>
            </div>

            <div class="flex items-center gap-2 bg-gray-100 px-4 py-2 rounded-lg">
                <span class="text-xs text-gray-500">Akan Berakhir dalam waktu:</span>
                <div class="flex gap-1 font-mono font-bold text-gray-800">
                    <span class="bg-white px-2 py-0.5 rounded shadow-sm">03 Hari</span> :
                    <span class="bg-white px-2 py-0.5 rounded shadow-sm">16</span> :
                    <span class="bg-white px-2 py-0.5 rounded shadow-sm">11</span> :
                    <span class="bg-white px-2 py-0.5 rounded shadow-sm">04</span>
                </div>
            </div>

            <div class="flex gap-2 mt-4 md:mt-0">
                <button class="border px-3 py-1 rounded-full hover:bg-gray-100 text-gray-400">Lihat semua</button>
                <button class="border w-8 h-8 rounded-full flex items-center justify-center hover:bg-gray-100"><i class="fa-solid fa-chevron-left"></i></button>
                <button class="border w-8 h-8 rounded-full flex items-center justify-center hover:bg-gray-100"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            
            @forelse($kosList as $kos)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow cursor-pointer group">
                <div class="relative h-48 bg-gray-200 overflow-hidden">
                    <img src="{{ $kos->thumbnail ? asset('storage/'.$kos->thumbnail) : 'https://placehold.co/600x400?text=Kos+Image' }}" 
                         alt="{{ $kos->name }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    
                    <div class="absolute top-3 left-3">
                        <span class="bg-white text-purple-600 text-xs font-bold px-2 py-1 rounded border border-purple-100 shadow-sm uppercase">
                            {{ $kos->category }}
                        </span>
                    </div>
                </div>

                <div class="p-4">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="border border-gray-300 text-gray-600 text-[10px] px-1 rounded uppercase font-semibold">
                            {{ $kos->category }}
                        </span>
                        <span class="flex items-center text-xs font-bold text-gray-800">
                            <i class="fa-solid fa-star text-green-500 mr-1"></i> 4.5
                        </span>
                    </div>

                    <h3 class="font-semibold text-gray-800 text-sm truncate mb-1" title="{{ $kos->name }}">
                        {{ $kos->name }}
                    </h3>
                    
                    <p class="text-xs text-gray-500 mb-3">
                        {{ $kos->city ? $kos->city->name : 'Lokasi Tidak Diketahui' }}
                    </p>

                    <p class="text-[10px] text-gray-400 truncate mb-3">
                        @if($kos->facilities->count() > 0)
                            {{ $kos->facilities->take(3)->pluck('name')->join(' · ') }}
                        @else
                            Fasilitas Lengkap
                        @endif
                    </p>

                    <div>
                        <div class="flex items-center gap-2 mb-0.5">
                            <span class="text-[10px] font-bold text-red-500 bg-red-50 px-1 rounded">
                                <i class="fa-solid fa-bolt"></i> Hemat
                            </span>
                            <span class="text-[10px] text-gray-400 line-through">
                                Rp{{ number_format($kos->price_start_from * 1.1, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="text-gray-800 font-bold">
                            Rp{{ number_format($kos->price_start_from, 0, ',', '.') }} 
                            <span class="text-xs font-normal text-gray-500">(Bulan pertama)</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-10">
                <p class="text-gray-500">Belum ada data kos tersedia.</p>
            </div>
            @endforelse

        </div>
    </main>

</body>
</html>