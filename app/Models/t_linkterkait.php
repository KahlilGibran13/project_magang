<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_linkterkait extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 't_linkterkait';

    protected $primaryKey = 'link_id';

    public $timestamps = false;

    // Kolom yang bisa diisi
    protected $fillable = [
        'link_instansi',
        'link_url',
        'link_logo',
    ];
    
    public function verifikasiLinkTerkaitLatest()
    {
        return $this->hasOne(t_verifikasi_linkterkait::class, 'link_id')->latestOfMany();
    }
}
