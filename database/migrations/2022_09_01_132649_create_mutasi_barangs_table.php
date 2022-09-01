<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMutasiBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutasi_barangs', function (Blueprint $table) {
            $table->id();
            $table->integer('stok_sebelumnya');
            $table->integer('masuk')->nullable();
            $table->integer('keluar')->nullable();
            $table->integer('barang_id');
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
        Schema::dropIfExists('mutasi_barangs');
    }
}
