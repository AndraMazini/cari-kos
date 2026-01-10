<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kamar - {{ $kos->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen p-8">
    <div class="max-w-5xl mx-auto">
        
        <div class="flex justify-between items-center mb-6">
            <div>
                <a href="{{ route('owner.kos.index') }}" class="text-gray-500 hover:text-green-600 mb-2 inline-block"><i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Kos</a>
                <h1 class="text-2xl font-bold text-gray-800">Kamar di {{ $kos->name }}</h1>
                <p class="text-gray-500 text-sm">Kelola tipe kamar dan ketersediaan.</p>
            </div>
            <a href="{{ route('owner.rooms.create', $kos->slug) }}" class="bg-green-600 text-white px-5 py-2 rounded-lg font-bold hover:bg-green-700 shadow transition">
                <i class="fa-solid fa-plus mr-2"></i> Tambah Kamar
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4 border border-green-200">{{ session('success') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($rooms as $room)
            <div class="bg-white rounded-xl shadow border border-gray-100 p-5 relative overflow-hidden">
                <div class="absolute top-0 right-0 px-3 py-1 text-xs font-bold {{ $room->is_available ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} rounded-bl-lg">
                    {{ $room->is_available ? 'Tersedia' : 'Penuh' }}
                </div>

                <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $room->name }}</h3>
                <p class="text-sm text-gray-500 mb-4"><i class="fa-solid fa-ruler-combined"></i> {{ $room->size }}</p>
                
                <p class="text-2xl font-bold text-green-600 mb-6">Rp{{ number_format($room->price_per_month, 0, ',', '.') }}<span class="text-sm text-gray-400 font-normal">/bln</span></p>

                <div class="flex gap-2">
                    <a href="{{ route('owner.rooms.edit', ['slug' => $kos->slug, 'room' => $room->id]) }}" class="flex-1 bg-yellow-50 text-yellow-600 py-2 rounded-lg text-center font-bold hover:bg-yellow-100 transition border border-yellow-200">
                        <i class="fa-solid fa-pen"></i> Edit
                    </a>
                    
                    <form action="{{ route('owner.rooms.destroy', ['slug' => $kos->slug, 'room' => $room->id]) }}" method="POST" onsubmit="return confirm('Hapus kamar ini?');" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-50 text-red-600 py-2 rounded-lg font-bold hover:bg-red-100 transition border border-red-200">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
                <i class="fa-solid fa-bed text-4xl text-gray-300 mb-3"></i>
                <p class="text-gray-500">Belum ada kamar yang ditambahkan.</p>
            </div>
            @endforelse
        </div>
    </div>
</body>
</html>