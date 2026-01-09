<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Cari Kos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md border border-gray-100">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Buat Akun Baru</h2>
            <p class="text-gray-500 text-sm">Mulai cari kos impianmu sekarang</p>
        </div>
        
        @if($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded-lg mb-6 text-sm border border-red-100">
                <div class="font-bold flex items-center mb-1">
                    <i class="fa-solid fa-circle-exclamation mr-2"></i> Ada Kesalahan:
                </div>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full pl-10 border border-gray-300 rounded-lg px-3 py-2 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none" placeholder="Jhon Doe" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full pl-10 border border-gray-300 rounded-lg px-3 py-2 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none" placeholder="email@contoh.com" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" class="w-full pl-10 border border-gray-300 rounded-lg px-3 py-2 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none" placeholder="******" required>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password_confirmation" class="w-full pl-10 border border-gray-300 rounded-lg px-3 py-2 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none" placeholder="Ulangi Password" required>
                </div>
            </div>
            
            <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition shadow-lg shadow-green-100">
                Daftar Sekarang
            </button>
        </form>

        <p class="text-center mt-6 text-sm text-gray-600">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-green-600 font-bold hover:underline">Masuk disini</a>
        </p>
    </div>
</body>
</html>