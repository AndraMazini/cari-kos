<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\City;
use App\Models\Facility;
use App\Models\BoardingHouse;
use App\Models\Room;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; // Tambahan untuk handle file

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // --- BAGIAN INI AKAN DOWNLOAD GAMBAR OTOMATIS ---
        $this->command->info('Sedang menyiapkan gambar dummy...');
        
        // Pastikan folder penyimpanan ada
        $path = public_path('storage');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        // Cek apakah gambar sudah ada? Kalau belum, DOWNLOAD
        $imagePath = public_path('storage/kos_default.jpg');
        
        // Kita paksa download ulang biar pasti ada
        try {
            // URL Gambar Dummy (Hijau biar sesuai tema)
            $imageUrl = 'https://placehold.co/600x400/22c55e/ffffff.jpg?text=Kos+Nyaman';
            
            // Download gambar
            $content = file_get_contents($imageUrl);
            
            if ($content !== false) {
                file_put_contents($imagePath, $content);
                $this->command->info('✅ Berhasil mendownload gambar kos_default.jpg');
            } else {
                $this->command->error('Gagal download gambar. Pastikan internet nyala.');
            }
        } catch (\Exception $e) {
            $this->command->warn('Gagal koneksi internet: ' . $e->getMessage());
        }
        // -----------------------------------------------------

        // 1. Buat User
        User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'super@mamikos.local',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone_number' => '08000000000',
        ]);

        $owner = User::create([
            'name' => 'Juragan Kos',
            'username' => 'juragankos',
            'email' => 'admin@mamikos.local',
            'password' => Hash::make('password'),
            'role' => 'pemilik',
            'phone_number' => '081234567890',
        ]);

        User::create([
            'name' => 'Anak Rantau',
            'username' => 'anakrantau',
            'email' => 'user@mamikos.local',
            'password' => Hash::make('password'),
            'role' => 'penyewa',
            'phone_number' => '08987654321',
        ]);

        // 2. Buat Kota
        $citiesData = [
            ['name' => 'Jakarta', 'slug' => 'jakarta'],
            ['name' => 'Bandung', 'slug' => 'bandung'],
            ['name' => 'Yogyakarta', 'slug' => 'yogyakarta'],
            ['name' => 'Surabaya', 'slug' => 'surabaya'],
            ['name' => 'Malang', 'slug' => 'malang'],
        ];

        foreach ($citiesData as $city) {
            City::create($city);
        }

        // 3. Buat Fasilitas
        $facilities = ['WiFi', 'AC', 'Kamar Mandi Dalam', 'Kasur', 'Lemari', 'Parkir', 'TV'];
        $facilityIds = [];
        foreach ($facilities as $f) {
            $fac = Facility::create(['name' => $f, 'icon' => 'fa-solid fa-check']);
            $facilityIds[] = $fac->id;
        }

        // 4. Buat 20 Kos Dummy
        $kosNames = [
            'Kost Griya Melati', 'Kost Dago Asri', 'Kost Putri Sakinah', 
            'Apartemen Siswa', 'Kost Eksklusif Menteng', 'Wisma Mahasiswa', 
            'Kost Orange Jeruk', 'Pavilion Garden', 'Kost Bintang Lima',
            'Kost Hijau Daun', 'Kost Biru Langit', 'Kost Mawar Merah',
            'Pondok Indah Kapuk', 'Kost Sejahtera', 'Kost Bahagia',
            'Kost Murah Meriah', 'Kost Executive', 'Kost Nyaman',
            'Kost Strategis', 'Kost Pusat Kota'
        ];

        foreach ($kosNames as $name) {
            $city = City::inRandomOrder()->first();
            $basePrice = rand(5, 30) * 100000;

            $kos = BoardingHouse::create([
                'name' => $name,
                'slug' => Str::slug($name) . '-' . Str::random(5),
                'user_id' => $owner->id, 
                'city_id' => $city->id,
                'address' => 'Jl. ' . $name . ' No. ' . rand(1, 100),
                'category' => collect(['Putra', 'Putri', 'Campur'])->random(),
                'description' => 'Fasilitas lengkap, aman, dan nyaman.',
                'price_start_from' => $basePrice,
                // PENTING: Menggunakan nama file yang tadi didownload otomatis
                'thumbnail' => 'kos_default.jpg', 
            ]);

            $kos->facilities()->attach(collect($facilityIds)->random(3));

            for ($i = 1; $i <= 2; $i++) {
                Room::create([
                    'boarding_house_id' => $kos->id,
                    'name' => 'Tipe ' . chr(64 + $i),
                    'size' => '3x4m',
                    'price_per_month' => $basePrice,
                    'is_available' => true,
                ]);
            }
        }
    }
}