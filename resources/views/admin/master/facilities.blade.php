<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Fasilitas - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('admin.dashboard') }}" class="text-green-600 font-bold"><i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard</a>
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Fasilitas</h1>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow-md mb-8 border border-gray-100">
            <h2 class="text-lg font-bold mb-4 text-gray-700">Tambah Fasilitas Baru</h2>
            <form action="{{ route('admin.facilities.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @csrf
                <input type="text" name="name" placeholder="Nama Fasilitas (Contoh: WiFi)" class="border p-2 rounded-lg focus:ring-2 focus:ring-green-500 outline-none" required>
                <input type="text" name="icon" placeholder="Icon FontAwesome (Contoh: fa-solid fa-wifi)" class="border p-2 rounded-lg focus:ring-2 focus:ring-green-500 outline-none" required>
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-green-700 transition">Simpan Fasilitas</button>
            </form>
            <p class="mt-2 text-xs text-gray-400 italic">*Gunakan class icon dari <a href="https://fontawesome.com/icons" target="_blank" class="underline">FontAwesome 6</a></p>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="p-4 font-bold text-gray-600">Icon</th>
                        <th class="p-4 font-bold text-gray-600">Nama Fasilitas</th>
                        <th class="p-4 font-bold text-gray-600 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($facilities as $facility)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-4 text-xl text-green-600 w-20 text-center">
                            <i class="{{ $facility->icon }}"></i>
                        </td>
                        <td class="p-4 font-medium text-gray-800">{{ $facility->name }}</td>
                        <td class="p-4 text-center">
                            <form action="{{ route('admin.facilities.index') }}/{{ $facility->id }}" method="POST" onsubmit="return confirm('Hapus fasilitas ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fa-solid fa-trash-can"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>