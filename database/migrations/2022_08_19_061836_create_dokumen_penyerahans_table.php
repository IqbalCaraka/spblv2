<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenPenyerahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_penyerahans', function (Blueprint $table) {
            $table->id();
            $table->string('no_agenda');
            $table->string('kasub_umum');
            $table->string('ttd_kasub_umum');
            $table->string('administrator');
            $table->string('ttd_administrator');
            $table->string('penyerah')->nullable();
            $table->string('ttd_penyerah');
            $table->string('penerima');
            $table->string('ttd_penerima');
            $table->date('tgl_pengajuan');
            $table->date('tgl_penyerahan')->nullable();
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
        Schema::dropIfExists('dokumen_penyerahans');
    }
}
