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

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat User ADMIN
        User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'super@mamikos.local',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone_number' => '08000000000',
        ]);

        // 2. Buat User Pemilik Kos
        $owner = User::create([
            'name' => 'Juragan Kos',
            'username' => 'juragankos',
            'email' => 'admin@mamikos.local',
            'password' => Hash::make('password'),
            'role' => 'pemilik',
            'phone_number' => '081234567890',
        ]);

        // 3. Buat User Pencari Kos
        User::create([
            'name' => 'Anak Rantau',
            'username' => 'anakrantau',
            'email' => 'user@mamikos.local',
            'password' => Hash::make('password'),
            'role' => 'penyewa',
            'phone_number' => '08987654321',
        ]);

        // 4. Buat Data Kota
        $cities = [
            ['name' => 'Jakarta', 'slug' => 'jakarta'],
            ['name' => 'Bandung', 'slug' => 'bandung'],
            ['name' => 'Yogyakarta', 'slug' => 'yogyakarta'],
            ['name' => 'Surabaya', 'slug' => 'surabaya'],
            ['name' => 'Malang', 'slug' => 'malang'],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }

        // 5. Buat Data Fasilitas
        $facilities = [
            'WiFi', 'AC', 'Kamar Mandi Dalam', 'Kasur', 'Lemari', 
            'Meja Belajar', 'Parkir Motor', 'Parkir Mobil', 'Dapur Umum'
        ];
        
        $facilityIds = [];
        foreach ($facilities as $f) {
            $fac = Facility::create([
                'name' => $f,
                'icon' => 'fa-solid fa-check'
            ]);
            $facilityIds[] = $fac->id;
        }

        // 6. Buat Dummy Boarding House
        $kosNames = [
            'Kost Griya Melati', 'Kost Dago Asri', 'Kost Putri Sakinah', 
            'Apartemen Siswa', 'Kost Eksklusif Menteng', 'Wisma Mahasiswa', 
            'Kost Orange Jeruk', 'Pavilion Garden'
        ];

        foreach ($kosNames as $index => $name) {
            $city = City::inRandomOrder()->first();
            $category = collect(['Putra', 'Putri', 'Campur'])->random();

            $kos = BoardingHouse::create([
                'name' => $name,
                'slug' => Str::slug($name) . '-' . Str::random(5),
                'user_id' => $owner->id, 
                'city_id' => $city->id,
                'address' => 'Jl. ' . $name . ' No. ' . rand(1, 100) . ', ' . $city->name,
                'category' => $category,
                'description' => 'Kos nyaman, aman, dan strategis dekat kampus.',
                'price_start_from' => rand(5, 25) * 100000,
                'thumbnail' => null,
            ]);

            // Attach Fasilitas
            if (!empty($facilityIds)) {
                $randomFacilities = collect($facilityIds)->random(min(count($facilityIds), rand(3, 5)));
                $kos->facilities()->attach($randomFacilities);
            }

            // 7. Buat Kamar
            for ($i = 1; $i <= rand(2, 4); $i++) {
                Room::create([
                    'boarding_house_id' => $kos->id,
                    'name' => 'Kamar Tipe ' . chr(64 + $i),
                    'size' => '3x4 meter',
                    'price_per_month' => $kos->price_start_from + ($i * 100000),
                    'is_available' => true,
                ]);
            }
        }
    }
}