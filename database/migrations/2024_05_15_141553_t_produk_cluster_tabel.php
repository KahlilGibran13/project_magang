<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTProdukClusterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_produk_cluster', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('cluster_id');
            $table->timestamps();

            // Define foreign keys
            $table->foreign('produk_id')->references('produk_id')->on('t_produk')->onDelete('cascade');
            $table->foreign('cluster_id')->references('cluster_id')->on('r_cluster')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_produk_cluster');
    }
}

