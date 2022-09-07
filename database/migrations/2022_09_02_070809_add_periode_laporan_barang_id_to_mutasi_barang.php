<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPeriodeLaporanBarangIdToMutasiBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mutasi_barangs', function (Blueprint $table) {
            $table->integer('periode_laporan_barang_id')->nullable();
            $table->integer('transaksi_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mutasi_barangs', function (Blueprint $table) {
            $table->dropColumn('periode_laporan_barang_id');
            $table->dropColumn('transaksi_id');
        });
    }
}
