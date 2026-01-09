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
    </style>
</head>
<body class="bg-gray-50">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="flex items-center text-gray-700 hover:text-green-600 font-medium">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                </a>
                <div class="font-bold text-lg text-gray-800">Detail Kos</div>
                <div class="w-20"></div> </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-8">
        
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-6">
            <div class="relative h-64 md:h-96 bg-gray-200">
                <img src="{{ $kos->thumbnail ? asset('storage/'.$kos->thumbnail) : 'https://placehold.co/1200x600?text=Foto+Kos' }}" 
                     alt="{{ $kos->name }}" 
                     class="w-full h-full object-cover">
                <span class="absolute top-4 left-4 bg-purple-600 text-white px-3 py-1 rounded-full text-sm font-bold shadow-md">
                    {{ $kos->category }}
                </span>
            </div>
            
            <div class="p-6 md:p-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">{{ $kos->name }}</h1>
                        <p class="text-gray-500 flex items-center">
                            <i class="fa-solid fa-location-dot text-red-500 mr-2"></i> 
                            {{ $kos->city->name }} - {{ $kos->address }}
                        </p>
                    </div>
                    <div class="mt-4 md:mt-0 text-right">
                        <p class="text-sm text-gray-500">Mulai dari</p>
                        <p class="text-2xl font-bold text-green-600">
                            Rp{{ number_format($kos->price_start_from, 0, ',', '.') }}
                            <span class="text-sm text-gray-400 font-normal">/ bulan</span>
                        </p>
                    </div>
                </div>
                
                <hr class="my-6 border-gray-100">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-bold text-gray-800 mb-3">Deskripsi Kos</h3>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            {{ $kos->description }}
                        </p>

                        <h3 class="text-lg font-bold text-gray-800 mb-3">Fasilitas Bersama</h3>
                        <div class="flex flex-wrap gap-3 mb-6">
                            @forelse($kos->facilities as $facility)
                                <span class="bg-green-50 text-green-700 px-3 py-1.5 rounded-lg text-sm border border-green-100 flex items-center">
                                    <i class="fa-solid fa-check-circle mr-1.5 text-xs"></i> {{ $facility->name }}
                                </span>
                            @empty
                                <span class="text-gray-400 italic">Tidak ada data fasilitas.</span>
                            @endforelse
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 h-fit">
                        <h3 class="font-bold text-gray-800 mb-4">Dikelola Oleh</h3>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center text-gray-500">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $kos->user->name }}</p>
                                <p class="text-xs text-gray-500">Pemilik Kos</p>
                            </div>
                        </div>
                        <button class="w-full bg-white border border-green-500 text-green-600 py-2 rounded-lg font-semibold hover:bg-green-50 transition">
                            <i class="fa-brands fa-whatsapp mr-1"></i> Hubungi Pemilik
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-xl font-bold text-gray-800 mb-4">Pilihan Kamar</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($kos->rooms as $room)
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm hover:border-green-400 transition">
                <div class="flex justify-between items-start mb-2">
                    <h4 class="font-bold text-lg text-gray-800">{{ $room->name }}</h4>
                    @if($room->is_available)
                        <span class="bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded font-bold">Tersedia</span>
                    @else
                        <span class="bg-red-100 text-red-700 text-xs px-2 py-0.5 rounded font-bold">Penuh</span>
                    @endif
                </div>
                <p class="text-sm text-gray-500 mb-4"><i class="fa-solid fa-ruler-combined mr-1"></i> Ukuran: {{ $room->size }}</p>
                
                <div class="flex justify-between items-end mt-4">
                    <p class="font-bold text-green-600">Rp{{ number_format($room->price_per_month, 0, ',', '.') }}<span class="text-xs text-gray-400">/bln</span></p>
                    
                    {{-- Tombol Pilih yang mengarah ke Booking --}}
                    <a href="{{ route('booking.create', ['slug' => $kos->slug, 'room' => $room->id]) }}" 
                       class="bg-green-600 text-white px-4 py-1.5 rounded-lg text-sm font-bold hover:bg-green-700 text-center {{ !$room->is_available ? 'opacity-50 pointer-events-none' : '' }}">
                       Pilih
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-8 bg-white rounded-xl border border-dashed border-gray-300">
                <p class="text-gray-500">Belum ada tipe kamar yang tersedia.</p>
            </div>
            @endforelse
        </div>

    </main>

    <footer class="bg-white border-t mt-12 py-8 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} Cari Kos. All rights reserved.
    </footer>

</body>
</html>