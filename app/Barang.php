<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;

class Barang extends Model
{
    protected $guarded = [];

    public function kategori(){
        return $this->belongsTo(Kategori::class,'kategori_id');
    }

    public function keranjang(){
        return $this->hasMany(Keranjang::class);
    }

    public function deleteImage(){
        Storage::delete($this->gambar);
    }
    public function getAllBarang(){
        $barang = DB::table('barangs')->paginate(8);
        return $barang;
    }

    public function getBarang ($data){
        $barangs = DB::table('barangs')
            ->Where('nama_barang','LIKE', '%'.$data.'%')
            ->paginate(3);
            return $barangs;
    }

    public function getBarangMenu($data){
        $barang = Barang::load('keranjang')
            ->Where('barangs.nama_barang', 'like', '%'.$data.'%')
            ->paginate(12);
            // dd($barang);
            return $barang;
        // $barang = DB::table('barangs')
        //     ->Where('barangs.nama_barang', 'like', '%'.$data.'%')
        //     ->paginate(12);
        //     // dd($barang);
        //     return $barang;
    }
}
