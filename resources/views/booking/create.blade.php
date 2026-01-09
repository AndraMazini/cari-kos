<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Kos - {{ $kos->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans">

    <div class="max-w-2xl mx-auto px-4 py-8">
        <a href="{{ route('kos.show', $kos->slug) }}" class="text-gray-500 hover:text-green-600 mb-4 inline-block">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Ajukan Sewa</h1>

            <div class="flex gap-4 mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                <img src="{{ $kos->thumbnail ? asset('storage/'.$kos->thumbnail) : 'https://placehold.co/100' }}" class="w-20 h-20 object-cover rounded-md">
                <div>
                    <h3 class="font-bold text-gray-800">{{ $kos->name }}</h3>
                    <p class="text-sm text-gray-600">{{ $room->name }} • {{ $room->size }}</p>
                    <p class="text-green-600 font-bold mt-1">Rp{{ number_format($room->price_per_month, 0, ',', '.') }} / bulan</p>
                </div>
            </div>

            <form action="{{ route('booking.store', ['slug' => $kos->slug, 'room' => $room->id]) }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Mulai Ngekos</label>
                    <input type="date" name="start_date" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-green-500">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Mau Sewa Berapa Bulan?</label>
                    <select name="duration" id="duration" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-green-500">
                        <option value="1">1 Bulan</option>
                        <option value="3">3 Bulan</option>
                        <option value="6">6 Bulan</option>
                        <option value="12">1 Tahun</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-3">Pilih Metode Pembayaran</label>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="payment_method" value="transfer_bca" class="peer sr-only" checked>
                            <div class="p-4 rounded-lg border border-gray-200 peer-checked:border-green-500 peer-checked:bg-green-50 hover:bg-gray-50 flex items-center gap-3 transition">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" class="h-6">
                                <span class="text-sm font-semibold text-gray-700">Transfer BCA</span>
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="payment_method" value="transfer_bri" class="peer sr-only">
                            <div class="p-4 rounded-lg border border-gray-200 peer-checked:border-green-500 peer-checked:bg-green-50 hover:bg-gray-50 flex items-center gap-3 transition">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/6/68/BANK_BRI_logo.svg" class="h-6">
                                <span class="text-sm font-semibold text-gray-700">Transfer BRI</span>
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="payment_method" value="ewallet_gopay" class="peer sr-only">
                            <div class="p-4 rounded-lg border border-gray-200 peer-checked:border-green-500 peer-checked:bg-green-50 hover:bg-gray-50 flex items-center gap-3 transition">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg" class="h-6">
                                <span class="text-sm font-semibold text-gray-700">GoPay</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-4 mt-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-600">Total Pembayaran</span>
                        <span class="text-xl font-bold text-green-600" id="total_price">Rp{{ number_format($room->price_per_month, 0, ',', '.') }}</span>
                    </div>
                    
                    <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition">
                        Lanjut ke Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const pricePerMonth = Number("{{ $room->price_per_month }}"); 
        const durationSelect = document.getElementById('duration');
        const totalPriceDisplay = document.getElementById('total_price');

        durationSelect.addEventListener('change', function() {
            const duration = this.value;
            const total = pricePerMonth * duration;
            totalPriceDisplay.textContent = 'Rp' + new Intl.NumberFormat('id-ID').format(total);
        });
    </script>
</body>
</html>