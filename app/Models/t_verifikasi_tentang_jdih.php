<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_verifikasi_tentang_jdih extends Model
{
    use HasFactory;

    const CREATED_AT = 'date';

    protected $fillable = [
        'id',
        'user_id',
        'tentang_id',
        'status',
        'aksi',
        'catatan',
    ];
}
