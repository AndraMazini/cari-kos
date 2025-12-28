## 🚀 Update Pondasi Backend & Database

Halo tim! Kerangka utama aplikasi (Skeleton) sudah selesai. Ini mencakup struktur database lengkap, relasi antar tabel (Model), dan data dummy otomatis.

### 📋 Apa yang Selesai Dikerjakan?
1. **Database Migrations:** Membuat 8 tabel (`users`, `cities`, `boarding_houses`, `rooms`, `facilities`, `transactions`, dll).
2. **Models & Relationships:** Semua tabel sudah saling terhubung (Relasi One-to-Many & Many-to-Many).
3. **Seeders (Data Dummy):** Script untuk mengisi database otomatis dengan data kos, harga, dan fasilitas.
4. **Home Page Integration:** Halaman depan sekarang mengambil data *real* dari database, bukan hardcode lagi.
5. **Fixes:** Menambahkan kolom `username` dan `avatar` pada user, serta perbaikan logic fasilitas.

### ⚠️ CARA SETUP (Wajib Ikuti Urutan!)
Supaya tidak error di laptop kalian, lakukan langkah ini setelah `git pull`:

1. **Install Dependencies:**
   ```bash
   composer install

Setup Environment: Copy file .env.example menjadi .env, lalu atur nama database kalian.

Generate Key:

Bash

php artisan key:generate
Run Migration & Seeder (PENTING 🛑): Jalankan perintah ini untuk mereset database & mengisi data dummy:

Bash

php artisan migrate:fresh --seed
Jalankan Server:

Bash

php artisan serve
🔑 Akun Login untuk Testing
Gunakan akun ini untuk masuk (Login):

Role Pemilik/Admin:

Email: admin@mamikos.local

Pass: password

Role Pencari Kos:

Email: user@mamikos.local

Pass: password

🔜 Next Steps (Pembagian Tugas)
Silakan lanjutkan fitur masing-masing di atas kerangka ini:

Frontend: Styling detail halaman kos.

Auth: Fitur Login/Register.

Admin: CRUD tambah data kos.

Transaksi: Fitur booking/sewa.