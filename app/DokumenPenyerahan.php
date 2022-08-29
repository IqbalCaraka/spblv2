<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DokumenPenyerahan extends Model
{
    protected $guarded = [];

    public function transaksi(){
        return $this->belongsTo(Transaksi::class,'transaksi_id');
    }

    public function kasubumumUser(){
        return $this->belongsTo(User::class,'kasub_umum');
    }

    public function administratorUser(){
        return $this->belongsTo(User::class,'administrator');
    }

    public function penerimaUser(){
        return $this->belongsTo(User::class,'penerima');
    }

    public function penyerahUser(){
        return $this->belongsTo(User::class,'penyerah');
    }

    public function ttdKasubUmum(){
        return $this->belongsTo(User::class, 'ttd_kasub_umum');
    }

    public function ttdAdministrator(){
        return $this->belongsTo(User::class, 'ttd_administrator');
    }

    public function ttdPenerima(){
        return $this->belongsTo(User::class, 'ttd_penerima');
    }

    public function ttdPenyerah(){
        return $this->belongsTo(User::class, 'ttd_penyerah');
    }
}
