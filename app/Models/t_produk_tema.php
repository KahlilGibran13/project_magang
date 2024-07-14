<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_produk_tema extends Model
{
    use HasFactory;
    protected $table = 't_produk_temas';

    protected $fillable = [
        'produk_id',
        'tema_id'
    ];
}
