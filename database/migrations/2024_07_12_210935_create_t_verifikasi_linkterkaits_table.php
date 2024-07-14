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
        Schema::create('t_verifikasi_linkterkaits', function (Blueprint $table) {
            $table->id();
            $table->integer('link_id');
            $table->integer('user_id');
            $table->integer('status');
            $table->integer('aksi');
            $table->text('catatan');
            $table->timestamps();

            $table->foreign('link_id')->references('link_id')->on('t_linkterkait')->onDelete('cascade');
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
        Schema::dropIfExists('t_verifikasi_linkterkaits');
    }
};
