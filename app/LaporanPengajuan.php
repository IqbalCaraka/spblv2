<?php

namespace App;
use App\Barang;
use App\User;
use App\Transaksi;

use Illuminate\Database\Eloquent\Model;

class LaporanPengajuan extends Model
{
    protected $guarded = [];

    public function barang(){
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function transaksi(){
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    public function revisiLaporanPengajuan(){
        return $this->belongsTo(RevisiLaporanPengajuan::class, 'laporan_pengajuan_id');
    }

    public function statusItemPengajuan(){
        return $this->belongsTo(StatusItemPengajuan::class, 'status_item_pengajuan_id');
    }
    
}
