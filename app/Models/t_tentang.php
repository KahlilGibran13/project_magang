<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_tentang extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 't_tentang';

    protected $primaryKey = 'tentang_id';

    public $timestamps = false;

    // Kolom yang bisa diisi
    protected $fillable = [
        'tentang_misi',
        'tentang_visi',
        'tentang_landasan',
        'tentang_sop',
        'tentang_struktur',
    ];

    public function verifikasiTentangJDIHLatest()
    {
        return $this->hasOne(t_verifikasi_tentang_jdih::class, 'tentang_id')->latestOfMany();
    }

    public function verifikasiTentangJDIH()
    {
        return $this->hasMany(t_verifikasi_tentang_jdih::class, 'tentang_id');
    }
}
