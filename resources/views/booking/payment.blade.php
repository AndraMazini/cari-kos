<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">

    <main class="max-w-xl mx-auto p-4 py-8">
        
        <div class="bg-orange-50 border border-orange-200 rounded-xl p-4 mb-6 text-center">
            <h1 class="text-orange-700 font-bold text-lg mb-1"><i class="fa-regular fa-clock"></i> Menunggu Pembayaran</h1>
            <p class="text-sm text-orange-600">Selesaikan pembayaran sebelum 24 jam.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <p class="text-sm text-gray-500 mb-1">Total Tagihan</p>
                <div class="flex justify-between items-center">
                    <h2 class="text-3xl font-bold text-gray-800">Rp{{ number_format($transaction->total_amount, 0, ',', '.') }}</h2>
                    <button onclick="navigator.clipboard.writeText('{{ $transaction->total_amount }}'); alert('Nominal disalin!')" class="text-green-600 text-sm font-bold hover:underline">
                        Salin
                    </button>
                </div>
            </div>

            <div class="p-6 bg-gray-50">
                <p class="text-sm font-bold text-gray-700 mb-3">Transfer ke {{ $transaction->payment_method }}:</p>
                
                <div class="bg-white border border-gray-200 rounded-lg p-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        @if($transaction->payment_method == 'BCA')
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" class="h-6 w-auto">
                        @elseif($transaction->payment_method == 'BRI')
                            <img src="https://upload.wikimedia.org/wikipedia/commons/6/68/BANK_BRI_logo.svg" class="h-6 w-auto">
                        @elseif($transaction->payment_method == 'MANDIRI')
                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg" class="h-6 w-auto">
                        @elseif($transaction->payment_method == 'DANA')
                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg" class="h-6 w-auto">
                        @elseif($transaction->payment_method == 'GOPAY')
                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg" class="h-6 w-auto">
                        @endif

                        <div>
                            @php
                                $rek = '';
                                $nama = 'PT Juragan Kos Indonesia'; // Nama Default
                                switch($transaction->payment_method) {
                                    case 'BCA': $rek = '123-456-7890'; break;
                                    case 'BRI': $rek = '0000-01-000000-50-0'; break;
                                    case 'MANDIRI': $rek = '100-00-0000000-0'; break;
                                    case 'DANA': $rek = '0812-3456-7890'; $nama = 'Admin Juragan'; break;
                                    case 'GOPAY': $rek = '0812-3456-7890'; $nama = 'Admin Juragan'; break;
                                    default: $rek = 'Hubungi Admin';
                                }
                            @endphp
                            <p class="font-mono font-bold text-lg text-gray-800" id="rekNumber">{{ $rek }}</p>
                            <p class="text-xs text-gray-500">a.n {{ $nama }}</p>
                        </div>
                    </div>
                    <button onclick="navigator.clipboard.writeText(document.getElementById('rekNumber').innerText); alert('No Rekening disalin!')" class="text-gray-400 hover:text-green-600">
                        <i class="fa-regular fa-copy text-xl"></i>
                    </button>
                </div>
            </div>

            <div class="p-6">
                <h3 class="font-bold text-gray-800 mb-4">Upload Bukti Transfer</h3>
                
                <form action="{{ route('booking.update', $transaction->code) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block w-full border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:bg-gray-50 hover:border-green-400 transition cursor-pointer">
                            <i class="fa-solid fa-cloud-arrow-up text-3xl text-gray-400 mb-2"></i>
                            <p class="text-sm text-gray-500">Klik untuk upload bukti (JPG/PNG)</p>
                            <input type="file" name="payment_proof" class="hidden" onchange="document.querySelector('.text-gray-500').textContent = this.files[0].name">
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 rounded-xl hover:bg-green-700 transition shadow-lg shadow-green-200">
                        Konfirmasi Pembayaran
                    </button>
                </form>
            </div>
        </div>
        
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-gray-500 text-sm hover:underline">Bayar Nanti (Kembali ke Home)</a>
        </div>

    </main>

</body>
</html>