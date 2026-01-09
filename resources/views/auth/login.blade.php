<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Cari Kos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md border border-gray-100">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Selamat Datang Kembali</h2>
            <p class="text-gray-500 text-sm">Silakan masuk untuk melanjutkan</p>
        </div>
        
        @if(session('success'))
            <div class="bg-green-50 text-green-600 p-3 rounded-lg mb-6 text-sm flex items-center border border-green-100">
                <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded-lg mb-6 text-sm flex items-center border border-red-100">
                <i class="fa-solid fa-circle-exclamation mr-2"></i> {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full pl-10 border border-gray-300 rounded-lg px-3 py-2 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none" placeholder="email@kamu.com" required>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" class="w-full pl-10 border border-gray-300 rounded-lg px-3 py-2 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none" placeholder="******" required>
                </div>
            </div>
            
            <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition shadow-lg shadow-green-100">
                Masuk
            </button>
        </form>

        <p class="text-center mt-6 text-sm text-gray-600">
            Belum punya akun? <a href="{{ route('register') }}" class="text-green-600 font-bold hover:underline">Daftar disini</a>
        </p>
    </div>
</body>
</html>