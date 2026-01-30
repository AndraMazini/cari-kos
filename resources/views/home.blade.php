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

    <div class="absolute top-0 left-0 w-full h-full -z-10 opacity-40 pointer-events-none">
        <div class="absolute top-[-5%] left-[-10%] w-[600px] h-[600px] bg-green-200 rounded-full blur-[120px]"></div>
        <div class="absolute top-[20%] right-[-10%] w-[500px] h-[500px] bg-blue-100 rounded-full blur-[100px]"></div>
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
                               class="block w-full pl-10 pr-24 py-2 border border-gray-300 rounded-lg leading-5 bg-gray-50 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-green-500 focus:ring-1 focus:ring-green-500 sm:text-sm transition" 
                               placeholder="Cari nama kos, kota, atau area...">
                        
                        <button type="submit" class="absolute inset-y-0 right-0 px-4 py-1 m-1 bg-green-500 text-white font-bold rounded-md text-sm hover:bg-green-600 transition shadow-sm">
                            Cari
                        </button>
                    </form>
                </div>

                <div class="flex items-center space-x-4 text-sm font-medium text-gray-700">
                    <a href="#" class="hover:text-green-600 hidden md:block transition">Pusat Bantuan</a>
                    
                    @auth
                        <div class="relative group">
                            <button class="flex items-center gap-2 border border-green-500 text-green-600 px-4 py-1.5 rounded-full font-bold hover:bg-green-50 transition">
                                <div class="w-6 h-6 bg-green-200 rounded-full flex items-center justify-center text-xs">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <span class="max-w-[100px] truncate hidden sm:block">{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </button>
                            
                            <div class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl py-2 hidden group-hover:block border border-gray-100 z-50">
                                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50 rounded-t-xl">
                                    <p class="text-xs text-gray-500 uppercase font-bold mb-1">
                                        {{ ucfirst(Auth::user()->role) }} </p>
                                    <p class="font-bold text-gray-800 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                
                                @if(Auth::user()->role == 'penyewa' || Auth::user()->role == 'pencari')
                                    <a href="{{ route('booking.history') }}" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-700 transition flex items-center">
                                        <i class="fa-solid fa-clock-rotate-left mr-3 w-5 text-center text-gray-400"></i> Riwayat Sewa
                                    </a>
                                @endif
                                
                                @if(Auth::user()->role == 'pemilik' || Auth::user()->role == 'admin')
                                    <div class="border-t border-gray-100 my-1"></div>
                                    <a href="{{ route('owner.kos.index') }}" class="block px-4 py-3 text-green-700 hover:bg-green-50 transition flex items-center font-bold">
                                        <i class="fa-solid fa-house-laptop mr-3 w-5 text-center"></i> Kelola Kos Saya
                                    </a>
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-red-600 hover:bg-red-50 transition flex items-center font-bold">
                                        <i class="fa-solid fa-user-shield mr-3 w-5 text-center"></i> Halaman Admin
                                    </a>
                                @endif
                                
                                <div class="border-t border-gray-100 mt-1"></div>
                                
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50 transition rounded-b-xl flex items-center">
                                        <i class="fa-solid fa-right-from-bracket mr-3 w-5 text-center"></i> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-3">
                            <a href="{{ route('login') }}" class="border border-green-500 text-green-500 px-5 py-2 rounded-lg hover:bg-green-50 font-bold transition">Masuk</a>
                            <a href="{{ route('register') }}" class="bg-green-500 text-white px-5 py-2 rounded-lg hover:bg-green-600 font-bold transition shadow-md shadow-green-200">Daftar</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="bg-gradient-to-br from-green-600 via-green-700 to-green-900 pt-16 pb-36 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 tracking-tight">
                Temukan Hunian Kos <br class="hidden md:block"> Impianmu di Sini
            </h1>
            <p class="text-green-50 text-lg md:text-xl max-w-2xl mx-auto mb-8 opacity-90">
                Ribuan pilihan kos nyaman dengan fasilitas lengkap dan harga terjangkau di seluruh kota besar Indonesia.
            </p>
            <div class="flex justify-center gap-4">
                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full text-white text-sm border border-white/20">
                    <i class="fa-solid fa-circle-check text-green-400"></i> Terverifikasi
                </div>
                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full text-white text-sm border border-white/20">
                    <i class="fa-solid fa-shield-halved text-green-400"></i> Aman & Nyaman
                </div>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-10 pb-20">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4 bg-white/70 backdrop-blur-xl p-4 rounded-2xl shadow-sm border border-white/50">
            <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-fire text-orange-500"></i>
                @if(request('search'))
                    Hasil Pencarian: "{{ request('search') }}"
                @elseif(request('category'))
                    Kategori Kos {{ request('category') }}
                @else
                    Rekomendasi Kos Pilihan
                @endif
            </h2>
            
            <div class="flex gap-2 overflow-x-auto pb-2 md:pb-0 scrollbar-hide">
                @if(request('category') || request('sort') || request('search'))
                    <a href="{{ route('home') }}" class="flex items-center gap-2 bg-red-50 border border-red-200 px-4 py-2 rounded-full text-sm font-bold text-red-600 hover:bg-red-100 transition whitespace-nowrap">
                        <i class="fa-solid fa-xmark"></i> Reset
                    </a>
                @endif

                <a href="{{ route('home', array_merge(request()->query(), ['sort' => 'lowest'])) }}" 
                   class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium transition whitespace-nowrap border
                   {{ request('sort') == 'lowest' ? 'bg-green-600 text-white border-green-600 shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                   <i class="fa-solid fa-arrow-down-short-wide"></i> Harga Terendah
                </a>

                <a href="{{ route('home', array_merge(request()->query(), ['category' => 'Putri'])) }}" 
                   class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium transition whitespace-nowrap border
                   {{ request('category') == 'Putri' ? 'bg-pink-600 text-white border-pink-600 shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                   <i class="fa-solid fa-venus"></i> Kos Putri
                </a>

                <a href="{{ route('home', array_merge(request()->query(), ['category' => 'Putra'])) }}" 
                   class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium transition whitespace-nowrap border
                   {{ request('category') == 'Putra' ? 'bg-blue-600 text-white border-blue-600 shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                   <i class="fa-solid fa-mars"></i> Kos Putra
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            
            @forelse($kosList as $kos)

            <a href="{{ route('kos.show', $kos->slug) }}" class="block bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group cursor-pointer h-full flex flex-col">
                
                <div class="relative h-52 bg-gray-200 overflow-hidden">
                    <img src="{{ asset('storage/'.$kos->thumbnail) }}" 
                         alt="{{ $kos->name }}" 
                         onerror="this.onerror=null; this.src='https://placehold.co/600x400?text=No+Image';
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    
                    <div class="absolute top-3 left-3 flex gap-2">
                        @php
                            $catColor = $kos->category == 'Putri' ? 'text-pink-600 bg-white border-pink-200' : 
                                    ($kos->category == 'Putra' ? 'text-blue-600 bg-white border-blue-200' : 'text-purple-600 bg-white border-purple-200');
                        @endphp
                        <span class="{{ $catColor }} text-[10px] font-bold px-2 py-1 rounded-lg border shadow-sm uppercase tracking-wide">
                            {{ $kos->category }}
                        </span>
                    </div>

                    <div class="absolute bottom-3 right-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs px-2 py-1 rounded-lg font-bold border border-white/50 shadow-sm">
                        <i class="fa-solid fa-door-open mr-1 text-green-600"></i> {{ $kos->rooms->count() }} Kamar
                    </div>
                </div>

                <div class="p-5 flex flex-col flex-grow">
                    
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[11px] text-gray-500 font-medium truncate max-w-[120px]">
                            <i class="fa-solid fa-location-dot text-red-500 mr-1"></i>{{ $kos->city ? $kos->city->name : 'Kota Tidak Ada' }}
                        </span>

                        <div class="flex items-center gap-1">
                            <div class="flex text-yellow-400 text-[10px]">
                                @php 
                                    $avgRating = $kos->reviews->avg('rating') ?? 0; 
                                @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fa-{{ $i <= round($avgRating) ? 'solid' : 'regular' }} fa-star"></i>
                                @endfor
                            </div>
                            <span class="text-[10px] text-gray-400 font-bold">({{ $kos->reviews->count() }})</span>
                        </div>
                    </div>

                    <h3 class="font-bold text-gray-800 text-lg mb-2 leading-snug group-hover:text-green-600 transition-colors line-clamp-2" title="{{ $kos->name }}">
                        {{ $kos->name }}
                    </h3>
                    
                    <p class="text-xs text-gray-400 mb-5 line-clamp-1 italic">
                        @if($kos->facilities->count() > 0)
                            {{ $kos->facilities->take(3)->pluck('name')->join(' · ') }}
                        @else
                            Fasilitas Lengkap & Aman
                        @endif
                    </p>

                    <div class="mt-auto pt-4 border-t border-gray-100 flex justify-between items-end">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-[10px] font-bold text-red-500 bg-red-50 px-1.5 rounded">
                                    <i class="fa-solid fa-tag"></i> PROMO
                                </span>
                                <span class="text-xs text-gray-400 line-through">
                                    Rp{{ number_format($kos->price_start_from * 1.1, 0, ',', '.') }}
                                </span>
                            </div>
                            <span class="text-xl font-black text-green-600">Rp{{ number_format($kos->price_start_from, 0, ',', '.') }}</span>
                            <span class="text-xs font-medium text-gray-400">/bln</span>
                        </div>
                        <div class="bg-green-50 p-2 rounded-lg group-hover:bg-green-600 group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full py-20 text-center bg-white/50 backdrop-blur-md rounded-3xl border border-dashed border-gray-300">
                <div class="inline-block p-8 rounded-full bg-white shadow-sm mb-6">
                    <i class="fa-solid fa-magnifying-glass text-gray-200 text-6xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Yah, kos tidak ditemukan</h3>
                <p class="text-gray-500 mb-8 max-w-md mx-auto">
                    Coba gunakan kata kunci lain atau reset filter untuk melihat semua pilihan kos.
                </p>
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-8 py-4 bg-green-600 text-white font-bold rounded-2xl hover:bg-green-700 transition shadow-xl shadow-green-200">
                    Lihat Semua Kos
                </a>
            </div>
            @endforelse

        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 py-12 relative z-10">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="flex justify-center items-center gap-2 mb-4">
                <div class="bg-green-100 p-1.5 rounded-full">
                    <i class="fa-solid fa-house-chimney text-green-600 text-sm"></i>
                </div>
                <span class="font-bold text-gray-800">JuraganKos</span>
            </div>
            <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} Juragan Kos. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>