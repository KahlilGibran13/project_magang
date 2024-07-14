<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perubahan extends Model
{
    protected $table = 't_perubahan';

    protected $primaryKey = 'perubahan_id';

    public $timestamps = false;

    protected $fillable = [
        'perubahan_produk_id',
        'perubahan_produk_referal',
        'perubahan_status',
    ];
}
