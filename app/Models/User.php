<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute; // [PENTING] Import ini wajib ada

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username', // Pastikan username ada jika Anda menggunakannya
        'email',
        'password',
        'role',          // penyewa, pemilik, admin
        'phone_number',  // 0812xxxx
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- ACCESSOR WHATSAPP (BARU) ---
    // Cara panggil di view: $user->whatsapp_link
    protected function whatsappLink(): Attribute
    {
        return Attribute::make(
            get: function () {
                $phone = $this->phone_number;
                
                // 1. Hapus karakter aneh (spasi, strip, dll), ambil angka saja
                $phone = preg_replace('/[^0-9]/', '', $phone);

                // 2. Jika diawali '0', ubah jadi '62'
                if (substr($phone, 0, 1) === '0') {
                    $phone = '62' . substr($phone, 1);
                }

                // 3. Jika belum ada 62 (misal user input 812xxx), tambahkan 62
                if (substr($phone, 0, 2) !== '62') {
                    $phone = '62' . $phone;
                }

                return "https://wa.me/{$phone}";
            }
        );
    }
}