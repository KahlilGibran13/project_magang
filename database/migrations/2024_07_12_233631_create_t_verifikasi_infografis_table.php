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
        Schema::create('t_verifikasi_infografis', function (Blueprint $table) {
            $table->id();
            $table->integer('infografis_id');
            $table->integer('user_id');
            $table->integer('status');
            $table->integer('aksi');
            $table->text('catatan');
            $table->timestamps();

            $table->foreign('infografis_id')->references('infografis_id')->on('t_infografis')->onDelete('cascade');
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
        Schema::dropIfExists('t_verifikasi_infografis');
    }
};
