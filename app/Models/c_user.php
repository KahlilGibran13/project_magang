<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class c_user extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'c_user';

    protected $primaryKey = 'user_id';

    public $timestamps = false;

    // Kolom yang bisa diisi
    protected $fillable = [
        'user_fullname',
        'user_name',
        'user_password',
        'user_role_id',
    ];

    // Kolom yang harus disembunyikan (misalnya saat serialisasi)
    protected $hidden = [
        'user_password',
    ];

    // Untuk penggunaan custom kolom password pada autentikasi
    public function getAuthPassword()
    {
        return $this->user_password;
    }
    public function verfikasiPeraturans()
    {
        return $this->hasMany(t_verifikasi_peraturan::class, 'user_id');
    }

    public function verfikasiTentangJDIH()
    {
        return $this->hasMany(t_verifikasi_tentang_jdih::class, 'user_id');
    }

    public function verifikasiLinkTerkait()
    {
        return $this->hasMany(t_verifikasi_linkterkait::class, 'user_id');
    }

    public function verifikasiInfografis()
    {
        return $this->hasMany(t_verifikasi_infografis::class, 'user_id');
    }
}
