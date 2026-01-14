<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kos->name }} - Cari Kos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; }
        .scroll-mt-24 { scroll-margin-top: 6rem; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="flex items-center text-gray-700 hover:text-green-600 font-medium transition">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                </a>
                <div class="font-bold text-lg text-gray-800 hidden sm:block">Detail Kos</div>
                <div class="w-20"></div> </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-8">
        
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-8 border border-gray-100">
            <div class="relative h-64 md:h-96 bg-gray-200 group">
                <img src="{{ $kos->thumbnail ? asset('storage/'.$kos->thumbnail) : 'https://placehold.co/1200x600?text=Foto+Kos' }}" 
                     alt="{{ $kos->name }}" 
                     class="w-full h-full object-cover">
                
                @php
                    $catColor = $kos->category == 'Putri' ? 'bg-pink-500' : ($kos->category == 'Putra' ? 'bg-blue-500' : 'bg-purple-500');
                @endphp
                <span class="absolute top-4 left-4 {{ $catColor }} text-white px-4 py-1.5 rounded-full text-sm font-bold shadow-md tracking-wide">
                    {{ $kos->category }}
                </span>
            </div>
            
            <div class="p-6 md:p-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">{{ $kos->name }}</h1>
                        <p class="text-gray-500 flex items-center">
                            <i class="fa-solid fa-location-dot text-red-500 mr-2 text-lg"></i> 
                            {{ $kos->city->name }} - {{ $kos->address }}
                        </p>
                    </div>
                    <div class="mt-4 md:mt-0 text-right">
                        <p class="text-sm text-gray-500 mb-1">Harga Mulai</p>
                        <p class="text-3xl font-bold text-green-600">
                            Rp{{ number_format($kos->price_start_from, 0, ',', '.') }}
                            <span class="text-sm text-gray-400 font-normal">/ bulan</span>
                        </p>
                    </div>
                </div>
                
                <hr class="my-6 border-gray-100">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-2 space-y-8">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center">
                                <i class="fa-solid fa-align-left mr-2 text-green-600"></i> Deskripsi Kos
                            </h3>
                            <p class="text-gray-600 leading-relaxed text-justify">
                                {{ $kos->description }}
                            </p>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center">
                                <i class="fa-solid fa-list-check mr-2 text-green-600"></i> Fasilitas Bersama
                            </h3>
                            <div class="flex flex-wrap gap-3">
                                @forelse($kos->facilities as $facility)
                                    <span class="bg-gray-50 text-gray-700 px-3 py-2 rounded-lg text-sm border border-gray-200 flex items-center hover:border-green-400 transition">
                                        <i class="{{ $facility->icon ?? 'fa-solid fa-check' }} mr-2 text-green-500"></i> {{ $facility->name }}
                                    </span>
                                @empty
                                    <span class="text-gray-400 italic">Tidak ada data fasilitas.</span>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-1">
                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm sticky top-24">
                            <h3 class="font-bold text-gray-800 mb-4 text-center">Dikelola Oleh</h3>
                            
                            <div class="flex flex-col items-center mb-6">
                                <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-blue-100 rounded-full flex items-center justify-center text-green-600 font-bold text-2xl mb-3 shadow-sm border border-white">
                                    {{ substr($kos->user->name, 0, 1) }}
                                </div>
                                <p class="font-bold text-lg text-gray-900">{{ $kos->user->name }}</p>
                                <p class="text-xs text-green-600 bg-green-50 px-2 py-1 rounded mt-1 font-medium border border-green-100">
                                    <i class="fa-solid fa-circle-check mr-1"></i> Pemilik Terverifikasi
                                </p>
                            </div>

                            @if($kos->user->whatsapp_link && $kos->user->whatsapp_link !== '#')
                                <a href="{{ $kos->user->whatsapp_link }}?text=Halo Kak {{ $kos->user->name }}, saya tertarik dengan kost {{ $kos->name }} ini. Apakah kamar masih tersedia?" 
                                   target="_blank" 
                                   class="block w-full text-center bg-white border border-green-500 text-green-600 py-2.5 rounded-lg font-bold hover:bg-green-50 transition shadow-sm mb-3 group">
                                    <i class="fa-brands fa-whatsapp text-lg mr-1 group-hover:scale-110 transition-transform"></i> Chat Pemilik
                                </a>
                            @else
                                <button disabled class="block w-full text-center bg-gray-100 border border-gray-300 text-gray-400 py-2.5 rounded-lg font-bold cursor-not-allowed mb-3">
                                    <i class="fa-solid fa-phone-slash mr-1"></i> Kontak Belum Tersedia
                                </button>
                            @endif
                            
                            <p class="text-[10px] text-gray-400 text-center leading-tight">
                                Gunakan fitur chat untuk bertanya detail kamar atau negosiasi harga sebelum booking.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fa-solid fa-bed mr-3 text-green-600"></i> Pilihan Kamar
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($kos->rooms as $room)
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md hover:border-green-400 transition flex flex-col h-full relative overflow-hidden group">
                    
                    @if(!$room->is_available)
                        <div class="absolute inset-0 bg-gray-50/80 backdrop-blur-[1px] z-10 flex items-center justify-center pointer-events-none">
                            <span class="bg-red-600 text-white px-4 py-2 rounded-lg font-bold shadow-lg transform -rotate-12 border-2 border-white">KAMAR PENUH</span>
                        </div>
                    @endif

                    <div class="flex justify-between items-start mb-4">
                        <h4 class="font-bold text-lg text-gray-800 group-hover:text-green-700 transition">{{ $room->name }}</h4>
                        @if($room->is_available)
                            <span class="bg-green-100 text-green-700 text-xs px-2.5 py-1 rounded-full font-bold border border-green-200">Tersedia</span>
                        @else
                            <span class="bg-red-100 text-red-700 text-xs px-2.5 py-1 rounded-full font-bold border border-red-200">Penuh</span>
                        @endif
                    </div>
                    
                    <div class="space-y-3 mb-6 flex-grow">
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fa-solid fa-ruler-combined w-6 text-center text-gray-400 mr-2"></i> 
                            {{ $room->size }}
                        </p>
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fa-solid fa-money-bill-wave w-6 text-center text-gray-400 mr-2"></i> 
                            Bayar Bulanan
                        </p>
                    </div>
                    
                    <div class="flex justify-between items-center pt-4 border-t border-gray-100 mt-auto">
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase font-bold">Harga / Bulan</p>
                            <p class="font-bold text-xl text-green-600">Rp{{ number_format($room->price_per_month, 0, ',', '.') }}</p>
                        </div>
                        
                        <a href="{{ route('booking.create', ['slug' => $kos->slug, 'room' => $room->id]) }}" 
                           class="bg-green-600 text-white px-6 py-2 rounded-lg text-sm font-bold hover:bg-green-700 hover:shadow-lg hover:shadow-green-200 transition {{ !$room->is_available ? 'pointer-events-none opacity-50' : '' }}">
                           Pilih
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-10 bg-white rounded-xl border border-dashed border-gray-300">
                    <i class="fa-solid fa-door-closed text-gray-300 text-4xl mb-3"></i>
                    <p class="text-gray-500">Belum ada tipe kamar yang tersedia saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100 scroll-mt-24" id="reviews">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="fa-solid fa-star mr-2 text-yellow-400"></i> Ulasan Penyewa
                </h2>
                <div class="text-sm text-gray-500 bg-gray-50 px-3 py-1 rounded-full border border-gray-200">
                    Total {{ $kos->reviews->count() }} Ulasan
                </div>
            </div>
            
            @if(session('error'))
                <div class="bg-red-50 text-red-600 p-4 rounded-lg mb-6 border border-red-100 text-sm flex items-center">
                    <i class="fa-solid fa-circle-exclamation mr-2"></i> {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="bg-green-50 text-green-600 p-4 rounded-lg mb-6 border border-green-100 text-sm flex items-center">
                    <i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif

            @auth
                @if(Auth::user()->role == 'penyewa')
                <form action="{{ route('review.store', $kos->slug) }}" method="POST" class="mb-10 bg-gray-50 p-6 rounded-xl border border-gray-200 transition focus-within:ring-2 focus-within:ring-green-100">
                    @csrf
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fa-regular fa-pen-to-square mr-2"></i> Tulis Pengalamanmu
                    </h3>

                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-600 mb-2">Beri Rating</label>
                        <div class="flex flex-row-reverse justify-end gap-2">
                            <div class="flex gap-2 sm:gap-3">
                                <label class="cursor-pointer flex items-center gap-1 bg-white border px-3 py-1.5 rounded-lg hover:border-green-500 has-[:checked]:bg-green-600 has-[:checked]:text-white has-[:checked]:border-green-600 transition shadow-sm">
                                    <input type="radio" name="rating" value="5" class="hidden peer" checked> 
                                    <span class="font-bold text-sm">5</span> <i class="fa-solid fa-star text-xs text-yellow-400 peer-checked:text-white"></i>
                                </label>
                                <label class="cursor-pointer flex items-center gap-1 bg-white border px-3 py-1.5 rounded-lg hover:border-green-500 has-[:checked]:bg-green-600 has-[:checked]:text-white has-[:checked]:border-green-600 transition shadow-sm">
                                    <input type="radio" name="rating" value="4" class="hidden peer"> 
                                    <span class="font-bold text-sm">4</span> <i class="fa-solid fa-star text-xs text-yellow-400 peer-checked:text-white"></i>
                                </label>
                                <label class="cursor-pointer flex items-center gap-1 bg-white border px-3 py-1.5 rounded-lg hover:border-green-500 has-[:checked]:bg-green-600 has-[:checked]:text-white has-[:checked]:border-green-600 transition shadow-sm">
                                    <input type="radio" name="rating" value="3" class="hidden peer"> 
                                    <span class="font-bold text-sm">3</span> <i class="fa-solid fa-star text-xs text-yellow-400 peer-checked:text-white"></i>
                                </label>
                                <label class="cursor-pointer flex items-center gap-1 bg-white border px-3 py-1.5 rounded-lg hover:border-green-500 has-[:checked]:bg-green-600 has-[:checked]:text-white has-[:checked]:border-green-600 transition shadow-sm">
                                    <input type="radio" name="rating" value="2" class="hidden peer"> 
                                    <span class="font-bold text-sm">2</span> <i class="fa-solid fa-star text-xs text-yellow-400 peer-checked:text-white"></i>
                                </label>
                                <label class="cursor-pointer flex items-center gap-1 bg-white border px-3 py-1.5 rounded-lg hover:border-green-500 has-[:checked]:bg-green-600 has-[:checked]:text-white has-[:checked]:border-green-600 transition shadow-sm">
                                    <input type="radio" name="rating" value="1" class="hidden peer"> 
                                    <span class="font-bold text-sm">1</span> <i class="fa-solid fa-star text-xs text-yellow-400 peer-checked:text-white"></i>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-600 mb-2">Ceritakan detailnya</label>
                        <textarea name="comment" rows="3" required class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 text-sm shadow-sm" placeholder="Bagaimana fasilitasnya? Apakah bersih? Lingkungannya nyaman?"></textarea>
                    </div>

                    <button type="submit" class="bg-green-600 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-green-700 transition shadow-lg shadow-green-100 text-sm flex items-center">
                        <i class="fa-solid fa-paper-plane mr-2"></i> Kirim Ulasan
                    </button>
                </form>
                @endif
            @endauth

            <div class="space-y-6">
                @forelse($kos->reviews()->latest()->get() as $review)
                    <div class="border-b border-gray-100 pb-6 last:border-0 last:pb-0">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center text-sm font-bold text-gray-600 border border-white shadow-sm">
                                    {{ substr($review->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-sm">{{ $review->user->name }}</p>
                                    <div class="flex items-center gap-1">
                                        @for($i=1; $i<=5; $i++)
                                            <i class="fa-solid fa-star text-[10px] {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-200' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <span class="text-xs text-gray-400 font-medium bg-gray-50 px-2 py-1 rounded">
                                {{ $review->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <div class="pl-[52px]">
                            <p class="text-gray-600 text-sm leading-relaxed italic bg-gray-50 p-3 rounded-lg rounded-tl-none border border-gray-100 inline-block">
                                "{{ $review->comment }}"
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <div class="inline-block p-4 bg-gray-50 rounded-full mb-3">
                            <i class="fa-regular fa-comment-dots text-gray-300 text-3xl"></i>
                        </div>
                        <p class="text-gray-500 text-sm font-medium">Belum ada ulasan untuk kos ini.</p>
                        @guest
                            <p class="text-xs text-gray-400 mt-1">Login untuk memberikan ulasan jika Anda pernah menyewa di sini.</p>
                        @endguest
                    </div>
                @endforelse
            </div>
        </div>

    </main>

    <footer class="bg-white border-t mt-12 py-8 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} Cari Kos. All rights reserved.
    </footer>

</body>
</html>