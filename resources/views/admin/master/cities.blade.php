<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Kota - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto">
        <a href="{{ route('admin.dashboard') }}" class="text-green-600 font-bold mb-4 inline-block"><i class="fa-solid fa-arrow-left"></i> Dashboard</a>
        
        <div class="bg-white p-6 rounded-xl shadow-md mb-8">
            <h2 class="text-xl font-bold mb-4">Tambah Kota Baru</h2>
            <form action="{{ route('admin.cities.store') }}" method="POST" class="flex gap-4">
                @csrf
                <input type="text" name="name" placeholder="Nama Kota (Contoh: Semarang)" class="flex-1 border p-2 rounded-lg" required>
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg font-bold">Simpan</button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="p-4">Nama Kota</th>
                        <th class="p-4">Slug</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cities as $city)
                    <tr class="border-b">
                        <td class="p-4">{{ $city->name }}</td>
                        <td class="p-4 text-gray-400">{{ $city->slug }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>