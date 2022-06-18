<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Jenis;

class Kategori extends Model
{ 
    protected $guarded = [];

    public function jenis(){
        return $this->belongsTo(Jenis::class);
    }
    public function barang(){
        return $this->hasMany(Barang::class);
    }
}

