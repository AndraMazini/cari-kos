<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - Cari Kos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="flex items-center text-gray-700 hover:text-green-600 font-medium transition">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Home
                </a>
                <div class="font-bold text-lg text-gray-800">Pengaturan Akun</div>
                <div class="w-20"></div> </div>
        </div>
    </nav>

    <main class="max-w-xl mx-auto px-4 py-10">
        
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-green-600 px-6 py-8 text-center text-white">
                <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center text-4xl font-bold mx-auto mb-3 backdrop-blur-sm border-4 border-white/30">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <h2 class="text-xl font-bold">{{ $user->name }}</h2>
                <p class="text-green-100 text-sm font-medium bg-green-700/50 inline-block px-3 py-1 rounded-full mt-2">
                    {{ ucfirst($user->role) }}
                </p>
            </div>

            <div class="p-8">
                @if(session('success'))
                    <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-6 border border-green-200 flex items-center text-sm shadow-sm">
                        <i class="fa-solid fa-check-circle mr-3 text-lg"></i> 
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-gray-400"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-300 rounded-xl pl-10 pr-4 py-2.5 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition" placeholder="Nama Lengkap">
                        </div>
                        @error('name') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Email</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-gray-400"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-300 rounded-xl pl-10 pr-4 py-2.5 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition bg-gray-50">
                        </div>
                        @error('email') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-green-600"><i class="fa-brands fa-whatsapp text-lg"></i></span>
                            <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="w-full border border-gray-300 rounded-xl pl-10 pr-4 py-2.5 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition" placeholder="Contoh: 08123456789">
                        </div>
                        <p class="text-xs text-gray-500 mt-1.5 ml-1">Nomor ini digunakan agar penyewa/pemilik bisa menghubungi Anda.</p>
                        @error('phone_number') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="border-t border-gray-100 my-8 relative">
                        <span class="absolute left-1/2 -translate-x-1/2 -top-3 bg-white px-3 text-xs text-gray-400 font-medium">GANTI PASSWORD</span>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Password Baru <span class="font-normal text-gray-400 text-xs">(Opsional)</span></label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-gray-400"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" name="password" class="w-full border border-gray-300 rounded-xl pl-10 pr-4 py-2.5 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition" placeholder="********">
                        </div>
                        @error('password') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Password</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-gray-400"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-xl pl-10 pr-4 py-2.5 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition" placeholder="********">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-green-600 text-white font-bold py-3.5 rounded-xl hover:bg-green-700 transition shadow-lg shadow-green-200 flex items-center justify-center">
                        <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </main>

</body>
</html>