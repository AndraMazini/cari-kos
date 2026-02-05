<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Kos Murah - Juragan Kos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 relative overflow-x-hidden min-h-screen">

    {{-- Efek Background Blur --}}
    <div class="absolute top-0 left-0 w-full h-full -z-10 opacity-40 pointer-events-none">
        <div class="absolute top-[-5%] left-[-10%] w-[600px] h-[600px] bg-green-200 rounded-full blur-[120px]"></div>
        <div class="absolute top-[20%] right-[-10%] w-[500px] h-[500px] bg-blue-100 rounded-full blur-[100px]"></div>
    </div>

    {{-- Navbar --}}
    <nav class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center flex-1">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center mr-6 group">
                        <div class="bg-green-100 p-2 rounded-full mr-2 group-hover:bg-green-200 transition">
                           <i class="fa-solid fa-house-chimney text-green-600 text-xl"></i>
                        </div>
                        <span class="font-bold text-xl text-green-600 hidden md:block group-hover:text-green-700 transition">JuraganKos</span>
                    </a>
                    <form action="{{ route('home') }}" method="GET" class="w-full max-w-lg relative hidden md:block">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-10 pr-24 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500 sm:text-sm transition" placeholder="Cari nama kos, kota, atau area...">
                        <button type="submit" class="absolute inset-y-0 right-0 px-4 py-1 m-1 bg-green-500 text-white font-bold rounded-md text-sm hover:bg-green-600 transition">Cari</button>
                    </form>
                </div>
                {{-- Auth Links --}}
                <div class="flex items-center space-x-4">
                    @auth
                        {{-- User Menu --}}
                        <div class="relative group">
                            <button class="flex items-center gap-2 border border-green-500 text-green-600 px-4 py-1.5 rounded-full font-bold">
                                <span class="max-w-[100px] truncate hidden sm:block">{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </button>
                            <div class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl py-2 hidden group-hover:block border z-50">
                                <form action="{{ route('logout') }}" method="POST">@csrf
                                    <button type="submit" class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50 transition flex items-center">
                                        <i class="fa-solid fa-right-from-bracket mr-3 w-5 text-center"></i> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-green-500 font-bold px-5 py-2">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-green-500 text-white px-5 py-2 rounded-lg font-bold shadow-md">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <div class="bg-gradient-to-br from-green-600 via-green-700 to-green-900 pt-16 pb-36 px-4">
        <div class="max-w-7xl mx-auto text-center text-white">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6">Temukan Hunian Kos <br> Impianmu di Sini</h1>
            <p class="text-green-50 text-lg opacity-90 max-w-2xl mx-auto mb-8">Ribuan pilihan kos nyaman dengan fasilitas lengkap di seluruh Indonesia.</p>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-4 -mt-24 relative z-10 pb-20">
        {{-- Filter Bar --}}
        <div class="flex flex-col md:flex-row justify-between mb-8 gap-4 bg-white/70 backdrop-blur-xl p-4 rounded-2xl shadow-sm border">
            <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-fire text-orange-500"></i> Rekomendasi Kos
            </h2>
            <div class="flex gap-2 overflow-x-auto scrollbar-hide">
                <a href="{{ route('home', ['category' => 'Putri']) }}" class="px-4 py-2 rounded-full text-sm font-medium border bg-white hover:bg-pink-50 transition whitespace-nowrap">Kos Putri</a>
                <a href="{{ route('home', ['category' => 'Putra']) }}" class="px-4 py-2 rounded-full text-sm font-medium border bg-white hover:bg-blue-50 transition whitespace-nowrap">Kos Putra</a>
            </div>
        </div>

        {{-- Grid Kos --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($kosList as $kos)
            <a href="{{ route('kos.show', $kos->slug) }}" class="block bg-white rounded-2xl shadow-sm border overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group h-full flex flex-col">
                
                {{-- Gambar Kos --}}
                <div class="relative h-52 bg-gray-200 overflow-hidden">
                    <img src="{{ asset('storage/'.$kos->thumbnail) }}" 
                         alt="{{ $kos->name }}" 
                         {{-- PANGGIL DARI CONFIG APP --}}
                         onerror="this.onerror=null; this.src='{{ config('app.placeholder_url') }}';" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    
                    <div class="absolute top-3 left-3">
                        <span class="bg-white text-[10px] font-bold px-2 py-1 rounded-lg border shadow-sm uppercase">
                            {{ $kos->category }}
                        </span>
                    </div>
                </div>

                <div class="p-5 flex flex-col flex-grow">
                    <div class="flex items-center justify-between mb-3 text-[11px] text-gray-500">
                        <span><i class="fa-solid fa-location-dot text-red-500 mr-1"></i>{{ $kos->city->name ?? 'Indonesia' }}</span>
                        <span class="text-yellow-400"><i class="fa-solid fa-star mr-1"></i>{{ number_format($kos->reviews->avg('rating'), 1) ?? '0.0' }}</span>
                    </div>

                    <h3 class="font-bold text-gray-800 text-lg mb-2 group-hover:text-green-600 line-clamp-2">
                        {{ $kos->name }}
                    </h3>
                    
                    <p class="text-xs text-gray-400 mb-5 italic line-clamp-1">
                        {{ $kos->facilities->count() > 0 ? $kos->facilities->take(3)->pluck('name')->join(' · ') : 'Fasilitas Lengkap' }}
                    </p>

                    <div class="mt-auto pt-4 border-t flex justify-between items-end">
                        <div>
                            <p class="text-xs text-gray-400 line-through">Rp{{ number_format($kos->price_start_from * 1.1, 0, ',', '.') }}</p>
                            <span class="text-xl font-black text-green-600">Rp{{ number_format($kos->price_start_from, 0, ',', '.') }}</span>
                            <span class="text-xs font-medium text-gray-400">/bln</span>
                        </div>
                        <div class="bg-green-50 p-2 rounded-lg group-hover:bg-green-600 group-hover:text-white transition-colors">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full py-20 text-center bg-white/50 rounded-3xl border border-dashed border-gray-300">
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Yah, kos tidak ditemukan</h3>
                <a href="{{ route('home') }}" class="inline-flex items-center px-8 py-4 bg-green-600 text-white font-bold rounded-2xl hover:bg-green-700 transition shadow-xl mt-4">Lihat Semua Kos</a>
            </div>
            @endforelse
        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 py-12 text-center text-gray-400 text-sm">
        <p>&copy; {{ date('Y') }} Juragan Kos. All rights reserved.</p>
    </footer>
</body>
</html> 