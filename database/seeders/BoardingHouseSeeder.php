<?php

namespace Database\Seeders;

use App\Models\BoardingHouse;
use App\Models\BoardingHouseImage;
use App\Models\City;
use App\Models\User;
use App\Models\Facility;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BoardingHouseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Owner
        $user = User::firstOrCreate(
            ['email' => 'owner@example.com'],
            ['name' => 'Juragan Kos', 'password' => Hash::make('password123'), 'role' => 'owner']
        );

        $cities = ['Bandung', 'Jakarta', 'Yogyakarta', 'Surabaya', 'Semarang'];
        foreach ($cities as $cityName) {
            City::firstOrCreate(['name' => $cityName], ['slug' => Str::slug($cityName)]);
        }

        // 2. Buat Fasilitas (Gunakan kolom 'icon' sesuai database kamu)
        $facilityNames = ['WiFi', 'AC', 'Kamar Mandi Dalam', 'Parkir Motor', 'Dapur'];
        $facilities = [];
        foreach ($facilityNames as $fName) {
            $facilities[] = Facility::firstOrCreate(
                ['name' => $fName], 
                ['icon' => Str::slug($fName).'.png']
            );
        }

        $allCities = City::all();
        $categories = ['Putra', 'Putri', 'Campur'];

        // 3. Loop 20 Data Kos Dummy
        for ($i = 1; $i <= 20; $i++) {
            $name = "Kos Elite Nomor " . $i;
            $kos = BoardingHouse::create([
                'name' => $name,
                'slug' => Str::slug($name) . '-' . Str::random(5),
                'thumbnail' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800',
                'city_id' => $allCities->random()->id,
                'user_id' => $user->id,
                'address' => 'Jl. Informatika Raya No. ' . $i,
                'description' => 'Kos nyaman dengan fasilitas lengkap.',
                'price_start_from' => rand(500, 2500) * 1000,
                'category' => $categories[array_rand($categories)]
            ]);

            // Tambahkan foto slider
            for ($j = 1; $j <= 3; $j++) {
                BoardingHouseImage::create([
                    'boarding_house_id' => $kos->id,
                    'image_path' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800'
                ]);
            }

            // Tempelkan fasilitas
            $randomFacilities = collect($facilities)->pluck('id')->random(3);
            $kos->facilities()->attach($randomFacilities);
        }
    }
}