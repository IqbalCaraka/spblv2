<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeranjangBarangTidakTersedia extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function satuan(){
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }
}
