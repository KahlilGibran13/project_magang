<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class r_cluster extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'r_cluster';
    protected $primaryKey = 'cluster_id';
    public $timestamps = false;

    // Kolom yang bisa diisi
    protected $fillable = [
        'cluster_nama',
        'cluster_gambar',
    ];

    // Relasi many-to-many dengan t_produk
    public function produk()
    {
        return $this->belongsToMany(t_produk::class, 't_produk_cluster', 'cluster_id', 'produk_id');
    }
}
