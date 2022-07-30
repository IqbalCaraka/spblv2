<?php

namespace App;
use App\Barang;

use Illuminate\Database\Eloquent\Model;

class LaporanPengajuan extends Model
{
    protected $guarded = [];

    public function barang(){
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    
}
