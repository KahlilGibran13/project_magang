<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class r_tema extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'r_tema';

    protected $primaryKey = 'tema_id';

    public $timestamps = false;

    // Kolom yang bisa diisi
    protected $fillable = [
        'tema_status',
        'tema_deskripsi',
    ];

    public function produks()
    {
        return $this->belongsToMany(t_produk::class, 't_produk_temas', 'tema_id', 'produk_id');
    }
}
