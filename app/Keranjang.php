<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Auth;

class Keranjang extends Model
{
    protected $guarded = [];

    public function barang(){
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getKeranjang(){
        $keranjang = Keranjang::with(['barang','barang.kategori'])
                    -> Where('user_id','=', Auth::user()->id)
                    -> get()
                    -> sortBy('barang.kategori_id')
                    -> groupBy('barang.kategori_id');
        return $keranjang;
    }

    public function getCekKeranjang($data){
        $keranjang = Keranjang::with('barang')
                    ->Where('barang_id','=', $data->barang_id)
                    ->Where('user_id','=', $data->user_id)
                    ->first();
        return $keranjang;
    }

   
}
