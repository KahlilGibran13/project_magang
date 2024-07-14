<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class t_produk_cluster extends Model
{
    protected $table = 't_produk_cluster';
    public $timestamps = false; // Jika tidak memiliki kolom created_at dan updated_at

    protected $fillable = [
        'produk_id',
        'cluster_id'
    ];

//     // Jika Anda ingin menambahkan relasi dengan model Produk, Anda dapat menambahkan fungsi seperti ini:

//     public function produk()
//     {
//         return $this->belongsTo(Produk::class, 'produk_id');
//     }

//     // Jika Anda ingin menambahkan relasi dengan model Cluster, Anda dapat menambahkan fungsi seperti ini:

//     public function cluster()
//     {
//         return $this->belongsTo(Cluster::class, 'cluster_id');
//     }
}
