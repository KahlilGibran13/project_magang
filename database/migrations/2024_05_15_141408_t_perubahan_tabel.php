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
        Schema::create('t_perubahan', function (Blueprint $table) {
            $table->id();
            $table->int('perubahan_produk_id');
            $table->int('perubahan_produk_referal');
            $table->int('perubahan_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_perubahan');
    }
};
