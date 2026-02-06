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
        
        /* Animasi Kustom */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up { animation: fadeUp 0.8s ease-out forwards; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 relative overflow-x-hidden min-h-screen">

    <div class="absolute top-0 left-0 w-full h-full -z-10 opacity-40 pointer-events-none">
        <div class="absolute top-[-5%] left-[-10%] w-[600px] h-[600px] bg-green-200 rounded-full blur-[120px]"></div>
    </div>

    <nav class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center flex-1">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center mr-6 cursor-pointer group">
                        <div class="bg-green-100 p-2 rounded-full mr-2 group-hover:bg-green-200 transition">
                           <i class="fa-solid fa-house-chimney text-green-600 text-xl"></i>
                        </div>
                        <span class="font-bold text-xl text-green-600 hidden md:block group-hover:text-green-700 transition">JuraganKos</span>
                    </a>
                    
                    <form action="{{ route('home') }}" method="GET" class="w-full max-w-lg relative hidden md:block">
                        @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                        @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="block w-full pl-10 pr-24 py-2 border border-gray-300 rounded-lg leading-5 bg-gray-50 placeholder-gray-500 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 sm:text-sm transition" 
                               placeholder="Cari nama kos, kota, atau area...">
                        <button type="submit" class="absolute inset-y-0 right-0 px-4 py-1 m-1 bg-green-500 text-white font-bold rounded-md text-sm hover:bg-green-600 transition shadow-sm">
                            Cari
                        </button>
                    </form>
                </div>

                <div class="flex items-center space-x-4 text-sm font-medium text-gray-700">
                    @auth
                        <div class="relative group">
                            <button class="flex items-center gap-2 border border-green-500 text-green-600 px-4 py-1.5 rounded-full font-bold hover:bg-green-50 transition">
                                <span class="max-w-[100px] truncate hidden sm:block">{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </button>
                            </div>
                    @else
                        <div class="flex items-center gap-3">
                            <a href="{{ route('login') }}" class="text-green-600 font-bold">Masuk</a>
                            <a href="{{ route('register') }}" class="bg-green-500 text-white px-5 py-2 rounded-lg hover:bg-green-600 font-bold transition">Daftar</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="relative h-[500px] md:h-[600px] w-full flex items-center justify-center overflow-hidden">
        <video autoplay muted loop playsinline class="absolute z-10 w-auto min-w-full min-h-full max-w-none">
            <source src="{{ asset('videos/hero-kos.mp4') }}" type="video/mp4">
                
            Your browser does not support the video tag.
        </video>

        <div class="absolute z-20 inset-0 bg-gradient-to-b from-black/60 via-green-900/40 to-gray-50"></div>

        <div class="relative z-30 max-w-7xl mx-auto text-center px-4">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight animate-fade-up">
                Temukan Hunian Kos <br class="hidden md:block"> Impianmu di Sini
            </h1>
            <p class="text-white/90 text-lg md:text-xl max-w-2xl mx-auto mb-8 animate-fade-up delay-100">
                Ribuan pilihan kos nyaman dengan fasilitas lengkap dan harga terjangkau di seluruh kota besar Indonesia.
            </p>
            <div class="flex justify-center gap-4 animate-fade-up delay-200">
                <div class="flex items-center gap-2 bg-white/20 backdrop-blur-md px-5 py-2.5 rounded-full text-white text-sm border border-white/30 shadow-lg">
                    <i class="fa-solid fa-circle-check text-green-400"></i> Terverifikasi
                </div>
                <div class="flex items-center gap-2 bg-white/20 backdrop-blur-md px-5 py-2.5 rounded-full text-white text-sm border border-white/30 shadow-lg">
                    <i class="fa-solid fa-shield-halved text-green-400"></i> Aman & Nyaman
                </div>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-40 pb-20">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4 bg-white/90 backdrop-blur-2xl p-5 rounded-3xl shadow-xl border border-white/50">
            <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-fire text-orange-500"></i>
                @if(request('search')) Hasil: "{{ request('search') }}" @else Rekomendasi Kos Pilihan @endif
            </h2>
            
            <div class="flex gap-2 overflow-x-auto pb-2 md:pb-0 scrollbar-hide">
                <a href="{{ route('home', array_merge(request()->query(), ['sort' => 'lowest'])) }}" 
                   class="flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-bold transition whitespace-nowrap border
                   {{ request('sort') == 'lowest' ? 'bg-green-600 text-white border-green-600 shadow-lg shadow-green-200' : 'bg-white text-gray-600 border-gray-100 hover:bg-gray-50 shadow-sm' }}">
                   <i class="fa-solid fa-arrow-down-short-wide"></i> Harga Terendah
                </a>

                <a href="{{ route('home', array_merge(request()->query(), ['category' => 'Putri'])) }}" 
                   class="flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-bold transition whitespace-nowrap border
                   {{ request('category') == 'Putri' ? 'bg-pink-600 text-white border-pink-600 shadow-lg shadow-pink-200' : 'bg-white text-gray-600 border-gray-100 hover:bg-gray-50 shadow-sm' }}">
                   <i class="fa-solid fa-venus"></i> Kos Putri
                </a>

                <a href="{{ route('home', array_merge(request()->query(), ['category' => 'Putra'])) }}" 
                   class="flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-bold transition whitespace-nowrap border
                   {{ request('category') == 'Putra' ? 'bg-blue-600 text-white border-blue-600 shadow-lg shadow-blue-200' : 'bg-white text-gray-600 border-gray-100 hover:bg-gray-50 shadow-sm' }}">
                   <i class="fa-solid fa-mars"></i> Kos Putra
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($kosList as $kos)
            <a href="{{ route('kos.show', $kos->slug) }}" class="group bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col h-full">
                <div class="relative h-56 overflow-hidden">
                    <img src="{{ asset('storage/'.$kos->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute top-4 left-4">
                        <span class="bg-white/90 backdrop-blur-md text-[10px] font-black px-3 py-1.5 rounded-xl shadow-sm uppercase tracking-widest text-green-700">
                            {{ $kos->category }}
                        </span>
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-tighter">
                            <i class="fa-solid fa-location-dot text-red-400 mr-1"></i> {{ $kos->city->name }}
                        </span>
                    </div>
                    <h3 class="font-black text-gray-800 text-lg mb-4 line-clamp-2 group-hover:text-green-600 transition-colors">
                        {{ $kos->name }}
                    </h3>
                    <div class="mt-auto border-t border-gray-50 pt-4 flex justify-between items-center">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase">Mulai dari</p>
                            <p class="text-xl font-black text-green-600">Rp{{ number_format($kos->price_start_from, 0, ',', '.') }}<span class="text-xs font-medium text-gray-400">/bln</span></p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-all">
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </div>
                    </div>
                </div>
            </a>
            @empty
                @endforelse
        </div>
    </main>

    </body>
</html>