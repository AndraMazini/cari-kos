<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - {{ $transaction->code }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen py-10">

    <div class="max-w-xl mx-auto px-4">
        
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <strong class="font-bold">Gagal Upload!</strong>
            <ul class="list-disc pl-5 mt-1 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white p-8 rounded-xl shadow-md border border-gray-200">
            <div class="text-center mb-8">
                @if($transaction->status == 'pending')
                    <div class="w-16 h-16 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-clock text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Menunggu Pembayaran</h2>
                @elseif($transaction->status == 'paid')
                     <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-hourglass-half text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Menunggu Konfirmasi</h2>
                @else
                    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-check text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Sewamu Aktif!</h2>
                @endif
                
                <p class="text-gray-500 mt-2">Kode Booking: <span class="font-mono font-bold text-black">{{ $transaction->code }}</span></p>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg border border-dashed border-gray-300 mb-6">
                <div class="flex justify-between items-center mb-4 border-b border-gray-200 pb-4">
                    <div class="text-left">
                        <h3 class="font-bold text-gray-800">{{ $transaction->room->boardingHouse->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $transaction->room->name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">Durasi</p>
                        <p class="font-semibold">{{ $transaction->duration }} Bulan</p>
                    </div>
                </div>
                
                <div class="flex justify-between items-center">
                    <p class="text-gray-600 font-medium">Total Tagihan</p>
                    <p class="text-2xl font-bold text-green-600">Rp{{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
                </div>
            </div>

            @if($transaction->status == 'pending')
                <div class="mb-6">
                    <h3 class="font-bold text-gray-800 mb-2">Instruksi Pembayaran</h3>
                    <p class="text-sm text-gray-600 mb-4">Silakan transfer sesuai metode yang Anda pilih:</p>

                    <div class="flex items-center gap-3 bg-blue-50 p-4 rounded-lg border border-blue-100 mb-6">
                        @if($transaction->payment_method == 'transfer_bca')
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" class="h-10"> 
                            <div>
                                <p class="font-bold text-lg text-gray-800">123-456-7890</p>
                                <p class="text-sm text-gray-500">Bank BCA a.n Juragan Kos</p>
                            </div>
                        @elseif($transaction->payment_method == 'transfer_bri')
                            <img src="https://upload.wikimedia.org/wikipedia/commons/6/68/BANK_BRI_logo.svg" class="h-10"> 
                            <div>
                                <p class="font-bold text-lg text-gray-800">002-999-888-777</p>
                                <p class="text-sm text-gray-500">Bank BRI a.n Juragan Kos</p>
                            </div>
                        @elseif($transaction->payment_method == 'ewallet_gopay')
                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg" class="h-10"> 
                            <div>
                                <p class="font-bold text-lg text-gray-800">0812-3456-7890</p>
                                <p class="text-sm text-gray-500">GoPay a.n Juragan Kos</p>
                            </div>
                        @else
                            <p class="text-gray-800 font-bold">Rekening Belum Dipilih</p>
                        @endif
                    </div>

                    <form action="{{ route('booking.update', $transaction->code) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload Bukti Transfer</label>
                        <input type="file" name="payment_proof" required class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-green-50 file:text-green-700
                            hover:file:bg-green-100 mb-4
                            cursor-pointer border border-gray-300 rounded-lg
                        "/>
                        <p class="text-xs text-gray-400 mb-4">*Format: JPG, PNG. Maks: 2MB</p>
                        
                        <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition shadow-lg shadow-green-200">
                            <i class="fa-solid fa-upload mr-2"></i> Kirim Bukti Pembayaran
                        </button>
                    </form>
                </div>

            @elseif($transaction->status == 'paid')
                <div class="text-center py-6">
                    <div class="inline-block p-4 rounded-full bg-blue-50 mb-3">
                        <i class="fa-solid fa-file-invoice text-blue-500 text-3xl"></i>
                    </div>
                    <p class="text-gray-800 font-bold text-lg">Bukti Sedang Dicek</p>
                    <p class="text-sm text-gray-500 mb-6">Terima kasih! Pemilik kos akan memverifikasi pembayaran Anda dalam 1x24 jam.</p>
                    
                    <a href="{{ route('home') }}" class="block w-full bg-gray-100 text-gray-700 font-bold py-2 rounded-lg hover:bg-gray-200 transition">
                        Kembali ke Beranda
                    </a>
                </div>

            @else
                <div class="text-center py-6">
                    <div class="inline-block p-4 rounded-full bg-green-50 mb-3">
                        <i class="fa-solid fa-key text-green-500 text-3xl"></i>
                    </div>
                    <p class="text-gray-800 font-bold text-lg">Pembayaran Diterima!</p>
                    <p class="text-sm text-gray-500 mb-6">Selamat ngekos! Kunci kamar bisa diambil di lokasi.</p>
                    
                    <a href="{{ route('home') }}" class="block w-full bg-green-600 text-white font-bold py-2 rounded-lg hover:bg-green-700 transition">
                        Cari Kos Lain
                    </a>
                </div>
            @endif

        </div>
    </div>
</body>
</html>