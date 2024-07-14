<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_lampiran extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 't_lampiran';

    protected $primaryKey = 'lampiran_id';

    public $timestamps = false;

    // Kolom yang bisa diisi
    protected $fillable = [
        'lampiran_produk_id',
        'lampiran_nama',
    ];
}
