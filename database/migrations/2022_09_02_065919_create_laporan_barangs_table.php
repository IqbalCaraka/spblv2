<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_barangs', function (Blueprint $table) {
            $table->id();
            $table->integer('barang_id');
            $table->integer('saldo_awal');
            $table->integer('saldo_akhir')->nullable();
            $table->integer('periode_laporan_barang_id');
            $table->integer('status');
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
        Schema::dropIfExists('laporan_barangs');
    }
}
