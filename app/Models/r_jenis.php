<?php

// app/Models/RJenis.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class r_jenis extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'r_jenis';

    protected $fillable = [
        'jenis_id',
        'jenis_status',
        'jenis_nama',
        'jenis_tipedokumen',
    ];

    public static function jenisPutusan()
    {
        return self::where('jenis_nama', 'putusan')->get();
    }
}

