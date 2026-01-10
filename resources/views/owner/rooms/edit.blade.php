<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kamar - {{ $room->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white p-8 rounded-xl shadow-lg max-w-md w-full border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Kamar</h2>
        
        <form action="{{ route('owner.rooms.update', ['slug' => $kos->slug, 'room' => $room->id]) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Tipe Kamar</label>
                <input type="text" name="name" value="{{ $room->name }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Ukuran Kamar</label>
                <input type="text" name="size" value="{{ $room->size }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Harga per Bulan (Rp)</label>
                <input type="number" name="price_per_month" value="{{ $room->price_per_month }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Status Ketersediaan</label>
                <select name="is_available" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
                    <option value="1" {{ $room->is_available ? 'selected' : '' }}>Tersedia (Bisa dipesan)</option>
                    <option value="0" {{ !$room->is_available ? 'selected' : '' }}>Penuh / Tidak Tersedia</option>
                </select>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('owner.rooms.index', $kos->slug) }}" class="w-1/2 block text-center py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 font-bold">Batal</a>
                <button type="submit" class="w-1/2 bg-green-600 text-white font-bold py-2 rounded-lg hover:bg-green-700 transition">Update</button>
            </div>
        </form>
    </div>
</body>
</html>