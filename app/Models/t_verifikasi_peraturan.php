<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_verifikasi_peraturan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'produk_id',
        'status',
        'aksi',
        'catatan',
    ];

    const CREATED_AT = 'date';

    public function produk()
    {
        return $this->belongsTo(t_produk::class, 'produk_id');
    }

    public function user()
    {
        return $this->belongsTo(c_user::class, 'user_id');
    }
}
