<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kos Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-3xl mx-auto px-4">
        
        <div class="bg-white rounded-xl shadow-md p-8 border border-gray-100">
            <div class="flex justify-between items-center mb-8 border-b pb-4">
                <h2 class="text-2xl font-bold text-gray-800">Tambah Data Kos</h2>
                <a href="{{ route('owner.kos.index') }}" class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-times text-xl"></i></a>
            </div>

            <form action="{{ route('owner.kos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Kos</label>
                        <input type="text" name="name" placeholder="Contoh: Kost Griya Melati" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-green-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Kota</label>
                        <select name="city_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-green-500 outline-none">
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                        <select name="category" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-green-500 outline-none">
                            <option value="Putra">Putra</option>
                            <option value="Putri">Putri</option>
                            <option value="Campur">Campur</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Harga Mulai (Per Bulan)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 font-bold text-sm">Rp</span>
                            <input type="number" name="price_start_from" placeholder="500000" required class="w-full pl-10 border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-green-500 outline-none">
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Alamat Lengkap</label>
                    <textarea name="address" rows="2" placeholder="Jalan, Nomor, RT/RW, Kelurahan..." required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-green-500 outline-none"></textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Kos</label>
                    <textarea name="description" rows="4" placeholder="Jelaskan kelebihan kos Anda..." required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-green-500 outline-none"></textarea>
                </div>

                <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-3">Fasilitas Tersedia</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($facilities as $facility)
                        <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-100 p-1 rounded">
                            <input type="checkbox" name="facilities[]" value="{{ $facility->id }}" class="rounded text-green-600 focus:ring-green-500 border-gray-300">
                            <span class="text-sm text-gray-700 select-none">{{ $facility->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Foto Utama (Thumbnail)</label>
                    <input type="file" name="thumbnail" required class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-green-50 file:text-green-700
                        hover:file:bg-green-100
                        cursor-pointer border border-gray-300 rounded-lg
                    "/>
                    <p class="text-xs text-gray-400 mt-1">*Format: JPG/PNG, Maks 2MB</p>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('owner.kos.index') }}" class="px-5 py-2 text-gray-500 font-bold hover:text-gray-700 transition">Batal</a>
                    <button type="submit" class="bg-green-600 text-white font-bold px-6 py-2 rounded-lg hover:bg-green-700 shadow-lg shadow-green-200 transition">
                        <i class="fa-solid fa-save mr-2"></i> Simpan Kos
                    </button>
                </div>

            </form>
        </div>
    </div>
</body>
</html>