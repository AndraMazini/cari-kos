<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kamar - {{ $kos->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white p-8 rounded-xl shadow-lg max-w-md w-full border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Tipe Kamar</h2>
        
        <form action="{{ route('owner.rooms.store', $kos->slug) }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Tipe Kamar</label>
                <input type="text" name="name" placeholder="Contoh: Kamar Standar A" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Ukuran Kamar</label>
                <input type="text" name="size" placeholder="Contoh: 3x4 Meter" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Harga per Bulan (Rp)</label>
                <input type="number" name="price_per_month" placeholder="Contoh: 800000" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <div class="flex gap-3">
                <a href="{{ route('owner.rooms.index', $kos->slug) }}" class="w-1/2 block text-center py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 font-bold">Batal</a>
                <button type="submit" class="w-1/2 bg-green-600 text-white font-bold py-2 rounded-lg hover:bg-green-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>