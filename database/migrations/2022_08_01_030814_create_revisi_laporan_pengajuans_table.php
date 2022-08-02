<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisiLaporanPengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisi_laporan_pengajuans', function (Blueprint $table) {
            $table->id();
            $table->integer('revisi_jumlah_barang');
            $table->integer('laporan_pengajuan_id');
            $table->integer('transaksi_id');
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
        Schema::dropIfExists('revisi_laporan_pengajuans');
    }
}
