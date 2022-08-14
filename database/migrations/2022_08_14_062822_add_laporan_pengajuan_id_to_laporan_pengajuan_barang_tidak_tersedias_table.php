<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLaporanPengajuanIdToLaporanPengajuanBarangTidakTersediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laporan_pengajuan_barang_tidak_tersedias', function (Blueprint $table) {
            $table->integer('laporan_pengajuan_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laporan_pengajuan_barang_tidak_tersedias', function (Blueprint $table) {
            $table->integer('laporan_pengajuan_id')->nullable();
        });
    }
}
