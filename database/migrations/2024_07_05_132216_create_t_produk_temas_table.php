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
        Schema::create('t_produk_temas', function (Blueprint $table) {
            $table->id();
            $table->integer('produk_id');
            $table->integer('tema_id');
            $table->timestamps();

            // Define foreign keys
            $table->foreign('produk_id')->references('produk_id')->on('t_produk')->onDelete('cascade');
            $table->foreign('tema_id')->references('tema_id')->on('r_tema')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_produk_temas');
    }
};
