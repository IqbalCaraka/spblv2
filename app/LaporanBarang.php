<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanBarang extends Model
{
    protected $guarded = [];

    public function barang(){
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    public function mutasi(){
        return $this->belongsTo(PeriodeLaporanBarang::class, 'periode_laporan_barang_id');
    }
}
