<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class t_produk extends Model
{
    protected $connection = 'mysql';
    protected $table = 't_produk';
    protected $primaryKey = 'produk_id';
    public $timestamps = false;
    // Jika tidak memiliki kolom created_at dan updated_at

    public function clusters()
    {
        return $this->belongsToMany(r_cluster::class, 't_produk_cluster', 'produk_id', 'cluster_id');
    }

    public function temas()
    {
        return $this->belongsToMany(r_tema::class, 't_produk_temas', 'produk_id', 'tema_id');
    }

    public function verfikasiPeraturans()
    {
        return $this->hasMany(t_verifikasi_peraturan::class, 'produk_id');
    }
    public function verifikasiPeraturanLatest()
    {
        return $this->hasOne(t_verifikasi_peraturan::class, 'produk_id', 'produk_id')->latestOfMany();
    }

    protected $fillable = [
        'produk_status',
        'produk_date',
        'produk_user_id',
        'produk_jenis_id',
        'produk_nomor',
        'produk_judul',
        'produk_tajuk',
        'produk_tema_id',
        'produk_singkatan',
        'produk_cetakan',
        'produk_tempatterbit',
        'produk_penerbit',
        'produk_tglterbit',
        'produk_tgldiundangkan',
        'produk_deskripsifisik',
        'produk_sumber',
        'produk_subjek',
        'produk_isbn',
        'produk_statusberlaku',
        'produk_bahasa',
        'produk_lokasi',
        'produk_bidanghukum',
        'produk_nib',
        'produk_dokumen',
        'produk_abstrak',
        'produk_terjemah',
        'produk_tahun',
        'produk_ttd',
        'produk_pemrakarsa',
        'produk_abstraks',
        'produk_terkait',
        'produk_diubah',
        'produk_mengubah',
        'produk_dicabut',
        'produk_mencabut',
        'produk_dilihat',
        'produk_download',
        'produk_cluster',
        'produk_keyword',
        'produk_dibuat',
        'produk_diupdate',
        'produk_pembuat'
    ];
}
