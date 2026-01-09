<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Kos Murah - Juragan Kos</title>
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
                
                <div class="flex items-center flex-1">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center mr-6 cursor-pointer">
                        <div class="bg-green-100 p-2 rounded-full mr-2">
                           <i class="fa-solid fa-house-chimney text-green-600 text-xl"></i>
                        </div>
                        <span class="font-bold text-xl text-green-600 hidden md:block">JuraganKos</span>
                    </a>
                    
                    <form action="{{ route('home') }}" method="GET" class="w-full max-w-lg relative hidden md:block">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                        </span>
                        
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="block w-full pl-10 pr-20 py-2 border border-gray-300 rounded-lg leading-5 bg-gray-50 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-green-500 focus:ring-1 focus:ring-green-500 sm:text-sm transition" 
                               placeholder="Cari nama kos, kota, atau area (cth: Jakarta)">
                        
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
                                <span class="max-w-[100px] truncate">{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </button>
                            
                            <div class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl py-2 hidden group-hover:block border border-gray-100 z-50 animate-fade-in-down">
                                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50 rounded-t-xl">
                                    <p class="text-xs text-gray-500 uppercase font-bold mb-1">Akun Saya</p>
                                    <p class="font-bold text-gray-800 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                
                                <a href="{{ route('booking.history') }}" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-700 transition flex items-center">
                                    <i class="fa-solid fa-clock-rotate-left mr-3 w-5 text-center text-gray-400"></i> Riwayat Sewa
                                </a>
                                
                                <a href="{{ route('owner.kos.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-700 transition flex items-center">
                                    <i class="fa-solid fa-house-laptop mr-3 w-5 text-center text-gray-400"></i> Kelola Kos Saya
                                </a>
                                
                                @if(Auth::user()->role == 'pemilik')
                                    <div class="border-t border-gray-100 my-1"></div>
                                    <a href="{{ route('admin.transactions.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-700 transition flex items-center">
                                        <i class="fa-solid fa-gauge mr-3 w-5 text-center text-gray-400"></i> Dashboard Admin
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

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="bg-gradient-to-r from-green-600 to-teal-500 rounded-2xl p-6 md:p-10 mb-10 text-white shadow-lg relative overflow-hidden">
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h2 class="text-3xl font-bold mb-2">Promo Ngebut Awal Tahun!</h2>
                    <p class="text-green-100">Diskon hingga 50% untuk pembayaran pertama di kos pilihan.</p>
                </div>
                <div class="flex items-center gap-3 bg-white/20 backdrop-blur-sm px-6 py-3 rounded-xl border border-white/30">
                    <span class="text-xs font-medium uppercase tracking-wider">Berakhir dalam:</span>
                    <div class="flex gap-2 font-mono font-bold text-xl">
                        <span class="bg-white text-green-600 px-2 py-1 rounded shadow">03</span> :
                        <span class="bg-white text-green-600 px-2 py-1 rounded shadow">16</span> :
                        <span class="bg-white text-green-600 px-2 py-1 rounded shadow">45</span>
                    </div>
                </div>
            </div>
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-yellow-300 opacity-20 rounded-full blur-2xl"></div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">
                @if(request('search'))
                    Hasil Pencarian: "{{ request('search') }}"
                @else
                    Rekomendasi Kos Pilihan
                @endif
            </h2>
            
            <div class="flex gap-2 overflow-x-auto pb-2 md:pb-0">
                <button class="flex items-center gap-2 bg-white border border-gray-200 px-4 py-2 rounded-full text-sm font-bold text-gray-700 hover:border-green-500 hover:text-green-600 transition shadow-sm whitespace-nowrap">
                    <i class="fa-solid fa-filter"></i> Filter
                </button>
                <button class="flex items-center gap-2 bg-white border border-gray-200 px-4 py-2 rounded-full text-sm font-medium text-gray-600 hover:bg-gray-50 transition whitespace-nowrap">
                    Harga Terendah
                </button>
                 <button class="flex items-center gap-2 bg-white border border-gray-200 px-4 py-2 rounded-full text-sm font-medium text-gray-600 hover:bg-gray-50 transition whitespace-nowrap">
                    Kos Putri
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            
            @forelse($kosList as $kos)
            <a href="{{ route('kos.show', $kos->slug) }}" class="block bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group cursor-pointer h-full flex flex-col">
                
                <div class="relative h-48 bg-gray-200 overflow-hidden">
                    <img src="{{ $kos->thumbnail ? asset('storage/'.$kos->thumbnail) : 'https://placehold.co/600x400?text=No+Image' }}" 
                         alt="{{ $kos->name }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    
                    <div class="absolute top-3 left-3">
                        @php
                            $catColor = $kos->category == 'Putri' ? 'text-pink-600 bg-pink-50 border-pink-200' : 
                                       ($kos->category == 'Putra' ? 'text-blue-600 bg-blue-50 border-blue-200' : 'text-purple-600 bg-purple-50 border-purple-200');
                        @endphp
                        <span class="{{ $catColor }} text-[10px] font-bold px-2 py-1 rounded border shadow-sm uppercase tracking-wide">
                            {{ $kos->category }}
                        </span>
                    </div>

                    <div class="absolute bottom-3 right-3 bg-black/60 backdrop-blur-sm text-white text-xs px-2 py-1 rounded font-medium">
                        <i class="fa-solid fa-door-open mr-1"></i> 5 Kamar
                    </div>
                </div>

                <div class="p-5 flex flex-col flex-grow">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="flex items-center text-xs font-bold text-gray-800 bg-yellow-50 px-1.5 py-0.5 rounded border border-yellow-100">
                            <i class="fa-solid fa-star text-yellow-400 mr-1"></i> 4.5
                        </span>
                        <span class="text-xs text-gray-400">•</span>
                        <span class="text-xs text-gray-500 truncate max-w-[150px]">
                            {{ $kos->city ? $kos->city->name : 'Kota Tidak Ada' }}
                        </span>
                    </div>

                    <h3 class="font-bold text-gray-800 text-lg mb-1 leading-snug group-hover:text-green-600 transition-colors line-clamp-2" title="{{ $kos->name }}">
                        {{ $kos->name }}
                    </h3>
                    
                    <p class="text-xs text-gray-400 mb-4 line-clamp-1">
                        @if($kos->facilities->count() > 0)
                            {{ $kos->facilities->take(3)->pluck('name')->join(' · ') }}
                        @else
                            Fasilitas Standar
                        @endif
                    </p>

                    <div class="mt-auto pt-4 border-t border-gray-100">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-[10px] font-bold text-red-500 bg-red-50 px-1.5 rounded">
                                <i class="fa-solid fa-tag"></i> Hemat 10%
                            </span>
                            <span class="text-xs text-gray-400 line-through">
                                Rp{{ number_format($kos->price_start_from * 1.1, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex justify-between items-end">
                            <div>
                                <span class="text-lg font-bold text-gray-900">Rp{{ number_format($kos->price_start_from, 0, ',', '.') }}</span>
                                <span class="text-xs font-normal text-gray-500">/bln</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-dashed border-gray-300">
                <div class="inline-block p-6 rounded-full bg-gray-50 mb-4">
                    <i class="fa-solid fa-magnifying-glass text-gray-300 text-5xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Yah, kos tidak ditemukan</h3>
                <p class="text-gray-500 mb-6 max-w-md mx-auto">
                    Coba ubah kata kunci pencarianmu. Kamu bisa mencari berdasarkan nama kos, nama kota, atau alamat.
                </p>
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 transition shadow-lg shadow-green-200">
                    Reset Pencarian
                </a>
            </div>
            @endforelse

        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} Juragan Kos. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>