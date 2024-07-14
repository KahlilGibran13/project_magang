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
        Schema::create('t_verifikasi_tentang_jdihs', function (Blueprint $table) {
            $table->id();
            $table->integer('tentang_id');
            $table->integer('user_id');
            $table->integer('status');
            $table->integer('aksi');
            $table->text('catatan');
            $table->timestamps();

            $table->foreign('tentang_id')->references('tentang_id')->on('t_tentang')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('c_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_verifikasi_tentang_jdihs');
    }
};
