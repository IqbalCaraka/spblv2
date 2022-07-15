<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Auth;

class Keranjang extends Model
{
    protected $guarded = [];

    public function barang(){
        return $this->belongsTo(Barang::class);
    }

    public function user(){
        return $this->belongsTo(Barang::class);
    }

    public function getKeranjang(){
        $keranjang = Keranjang::with('barang')
                    -> Where('user_id','=', Auth::user()->id)
                    -> get()
                    -> groupBy('barang.kategori_id');
        // dd((object)$keranjang);
        return $keranjang;
    }

    public function getCekKeranjang($data){
        $keranjang = Keranjang::with('barang')
                    ->Where('barang_id','=', $data->barang_id)
                    ->Where('user_id','=', $data->user_id)
                    ->first();
                    // dd(json_decode($data));
        // echo($keranjang);
        return $keranjang;
    }

   
}
