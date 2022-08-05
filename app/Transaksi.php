<?php

namespace App;
use App\Status;
use App\User;
use App\LaporanPengajuan;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = [];

    public function status(){
        return $this->belongsTo(Status::class, 'status_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function laporanPengajuan(){
        return $this->hasMany(LaporanPengajuan::class, 'transaksi_id');
    }

    public function riwayatTransaksi(){
        return $this->hasMany(RiwayatTransaksi::class, 'transaksi_id');
    }


}
