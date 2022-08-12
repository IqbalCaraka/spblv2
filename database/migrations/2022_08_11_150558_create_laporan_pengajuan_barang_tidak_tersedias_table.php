<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPengajuanBarangTidakTersediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_pengajuan_barang_tidak_tersedias', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('jumlah_barang');
            $table->string('revisi_jumlah_barang')->nullable();
            $table->integer('status_item_pengajuan_id');
            $table->integer('satuan_id');
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
        Schema::dropIfExists('laporan_pengajuan_barang_tidak_tersedias');
    }
}
