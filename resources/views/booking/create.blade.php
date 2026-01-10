<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Kamar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">

    <nav class="bg-white shadow-sm p-4">
        <div class="max-w-2xl mx-auto flex items-center gap-4">
            <a href="{{ route('kos.show', $kos->slug) }}" class="text-gray-500 hover:text-green-600">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <h1 class="font-bold text-lg">Form Pemesanan</h1>
        </div>
    </nav>

    <main class="max-w-2xl mx-auto p-4 mt-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            
            <div class="flex gap-4 mb-6 border-b border-gray-100 pb-6">
                <img src="{{ $kos->thumbnail ? asset('storage/'.$kos->thumbnail) : 'https://placehold.co/100' }}" class="w-20 h-20 rounded-lg object-cover">
                <div>
                    <h2 class="font-bold text-gray-800">{{ $kos->name }}</h2>
                    <p class="text-sm text-gray-500">{{ $room->name }} - {{ $room->size }}</p>
                    <p class="text-green-600 font-bold mt-1">Rp{{ number_format($room->price_per_month, 0, ',', '.') }} / bulan</p>
                </div>
            </div>

            <form action="{{ route('booking.store', ['slug' => $kos->slug, 'room' => $room->id]) }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Mulai Ngekos</label>
                    <input type="date" name="start_date" required class="w-full border rounded-lg p-2.5 focus:ring-green-500 focus:border-green-500">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Durasi Sewa (Bulan)</label>
                    <select name="duration" id="duration" class="w-full border rounded-lg p-2.5 bg-white">
                        <option value="1">1 Bulan</option>
                        <option value="3">3 Bulan</option>
                        <option value="6">6 Bulan</option>
                        <option value="12">1 Tahun</option>
                    </select>
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-bold text-gray-700 mb-3">Pilih Metode Pembayaran</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        
                        <label class="cursor-pointer border rounded-lg p-3 flex items-center gap-3 hover:border-green-500 has-[:checked]:border-green-500 has-[:checked]:bg-green-50 transition">
                            <input type="radio" name="payment_method" value="BCA" class="accent-green-600" checked>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" class="h-4 w-auto">
                            <span class="text-sm font-medium ml-auto">Transfer BCA</span>
                        </label>

                        <label class="cursor-pointer border rounded-lg p-3 flex items-center gap-3 hover:border-green-500 has-[:checked]:border-green-500 has-[:checked]:bg-green-50 transition">
                            <input type="radio" name="payment_method" value="BRI" class="accent-green-600">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/6/68/BANK_BRI_logo.svg" class="h-4 w-auto">
                            <span class="text-sm font-medium ml-auto">Transfer BRI</span>
                        </label>

                        <label class="cursor-pointer border rounded-lg p-3 flex items-center gap-3 hover:border-green-500 has-[:checked]:border-green-500 has-[:checked]:bg-green-50 transition">
                            <input type="radio" name="payment_method" value="MANDIRI" class="accent-green-600">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg" class="h-4 w-auto">
                            <span class="text-sm font-medium ml-auto">Transfer Mandiri</span>
                        </label>

                        <label class="cursor-pointer border rounded-lg p-3 flex items-center gap-3 hover:border-green-500 has-[:checked]:border-green-500 has-[:checked]:bg-green-50 transition">
                            <input type="radio" name="payment_method" value="DANA" class="accent-green-600">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg" class="h-4 w-auto">
                            <span class="text-sm font-medium ml-auto">E-Wallet DANA</span>
                        </label>

                         <label class="cursor-pointer border rounded-lg p-3 flex items-center gap-3 hover:border-green-500 has-[:checked]:border-green-500 has-[:checked]:bg-green-50 transition">
                            <input type="radio" name="payment_method" value="GOPAY" class="accent-green-600">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg" class="h-4 w-auto">
                            <span class="text-sm font-medium ml-auto">Gopay</span>
                        </label>

                    </div>
                </div>

                <div class="border-t border-gray-100 pt-4 flex justify-between items-center">
                    <div>
                        <p class="text-xs text-gray-500">Total Pembayaran</p>
                        <p class="text-xl font-bold text-green-600" id="total_price">
                            Rp{{ number_format($room->price_per_month, 0, ',', '.') }}
                        </p>
                    </div>
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-green-700 transition">
                        Lanjut Bayar
                    </button>
                </div>

            </form>
        </div>
    </main>

    <script>
        // PERBAIKAN: Gunakan Number("...") agar VS Code tidak menganggapnya error sintaks
        const pricePerMonth = Number("{{ $room->price_per_month }}");
        
        const durationSelect = document.getElementById('duration');
        const totalPriceEl = document.getElementById('total_price');

        // Fungsi Format Rupiah
        const formatRupiah = (number) => {
            return new Intl.NumberFormat('id-ID', { 
                style: 'currency', 
                currency: 'IDR',
                minimumFractionDigits: 0 
            }).format(number);
        }

        durationSelect.addEventListener('change', function() {
            const duration = this.value;
            const total = pricePerMonth * duration;
            
            // Update teks harga
            totalPriceEl.textContent = formatRupiah(total);
        });
    </script>
</body>
</html>