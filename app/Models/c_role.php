<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'c_role';

    protected $primaryKey = 'role_id';

    public $timestamps = false;

    // Kolom yang bisa diisi
    protected $fillable = [
        'role_status',
        'role_nama',
    ];
}
