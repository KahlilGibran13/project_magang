<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_verifikasi_infografis extends Model
{
    use HasFactory;

    const CREATED_AT = 'date';

    protected $fillable = [
        'id',
        'user_id',
        'infografis_id',
        'status',
        'aksi',
        'catatan',
    ];
}
