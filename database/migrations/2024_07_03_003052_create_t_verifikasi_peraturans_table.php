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
        Schema::create('t_verifikasi_peraturans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->foreignId('user_id')->constrained('c_user', 'user_id')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('produk_id')->foreignId('produk_id')->constrained('t_produk', 'produk_id')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('status');
            $table->integer('aksi');
            $table->text('catatan');
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
        Schema::dropIfExists('t_verifikasi_peraturans');
    }
};
