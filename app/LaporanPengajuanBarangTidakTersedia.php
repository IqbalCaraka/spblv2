<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanPengajuanBarangTidakTersedia extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function transaksi(){
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    public function statusItemPengajuan(){
        return $this->belongsTo(StatusItemPengajuan::class, 'status_item_pengajuan_id');
    }
}
