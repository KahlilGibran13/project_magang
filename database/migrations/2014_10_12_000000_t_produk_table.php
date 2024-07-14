<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_produk', function (Blueprint $table) {
            $table->id();
            $table->char('produk_status');
            $table->datetime('produk_date');
            $table->int('produk_user_id');
            $table->int('produk_jenis_id');
            $table->varchar('produk_nomor');
            $table->text('produk_judul');
            $table->varchar('produk_tajuk');
            $table->int('produk_tema_id');
            $table->varchar('produk_singkatan');
            $table->varchar('produk_cetakan');
            $table->varchar('produk_tempatterbit');
            $table->varchar('produk_penerbit');
            $table->date('produk_tglterbit');
            $table->date('produk_tgldiundangkan');
            $table->varchar('produk_deskripsifisik');
            $table->varchar('produk_sumber');
            $table->varchar('produk_subjek');
            $table->varchar('produk_isbn');
            $table->varchar('produk_statusberlaku');
            $table->varchar('produk_bahasa');
            $table->varchar('produk_lokasi');
            $table->varchar('produk_bidanghukum');
            $table->varchar('produk_nib');
            $table->varchar('produk_dokumen');
            $table->text('produk_abstrak');
            $table->varchar('produk_terjemah');
            $table->varchar('produk_tahun');
            $table->varchar('produk_ttd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_produk');
    }
};
