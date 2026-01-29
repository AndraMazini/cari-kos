<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kos - Juragan Kos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 pb-20">

    <nav class="bg-white shadow-sm mb-8">
        <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
            <a href="{{ route('owner.kos.index') }}" class="text-gray-600 hover:text-green-600 font-medium flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Daftar Kos
            </a>
            <h1 class="font-bold text-lg text-gray-800">Edit Data Kos</h1>
            <div class="w-20"></div>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 md:p-8">
                <form action="{{ route('owner.kos.update', $kos->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Foto Utama Kos (Thumbnail)</label>
                        <div class="relative group w-full h-64 bg-gray-100 rounded-xl overflow-hidden border-2 border-dashed border-gray-300 flex flex-col items-center justify-center">
                            @if($kos->thumbnail)
                                <img id="preview" src="{{ asset('storage/'.$kos->thumbnail) }}" class="w-full h-full object-cover">
                            @else
                                <img id="preview" class="hidden w-full h-full object-cover">
                                <div id="placeholder" class="text-center">
                                    <i class="fa-solid fa-image text-gray-400 text-4xl mb-2"></i>
                                    <p class="text-xs text-gray-400">Belum ada foto. Klik untuk upload.</p>
                                </div>
                            @endif
                            <input type="file" name="thumbnail" onchange="previewImage(event)" class="absolute inset-0 opacity-0 cursor-pointer">
                        </div>
                        <p class="mt-2 text-xs text-gray-500 italic">*Format: JPG, PNG, atau JPEG. Maksimal 2MB.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Kos</label>
                            <input type="text" name="name" value="{{ old('name', $kos->name) }}" class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-400 outline-none" placeholder="Contoh: Kost Dago Asri" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                            <select name="category" class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
                                <option value="Putra" {{ $kos->category == 'Putra' ? 'selected' : '' }}>Putra</option>
                                <option value="Putri" {{ $kos->category == 'Putri' ? 'selected' : '' }}>Putri</option>
                                <option value="Campur" {{ $kos->category == 'Campur' ? 'selected' : '' }}>Campur</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap</label>
                        <textarea name="address" rows="3" class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-400 outline-none" placeholder="Jl. Raya No. 123..." required>{{ old('address', $kos->address) }}</textarea>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Kos</label>
                        <textarea name="description" rows="5" class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-400 outline-none" placeholder="Ceritakan kelebihan kos kamu..." required>{{ old('description', $kos->description) }}</textarea>
                    </div>

                    <button type="submit" class="w-full bg-green-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-green-700 shadow-lg shadow-green-200 transition-all flex items-center justify-center gap-2">
                        <i class="fa-solid fa-save"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Preview gambar sebelum diupload
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('preview');
                const placeholder = document.getElementById('placeholder');
                output.src = reader.result;
                output.classList.remove('hidden');
                if(placeholder) placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

</body>
</html>