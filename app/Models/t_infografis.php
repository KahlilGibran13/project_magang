<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_infografis extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 't_infografis';

    protected $primaryKey = 'infografis_id';

    public $timestamps = false;

    // Kolom yang bisa diisi
    protected $fillable = [
        'infografis_nama',
        'infografis_gambar',
    ];

    public function verifikasiInfografisLatest()
    {
        return $this->hasOne(t_verifikasi_infografis::class, 'infografis_id')->latestOfMany();
    }
}
