<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use DB;

class Barang extends Model
{
    protected $guarded = [];

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function deleteImage(){
        Storage::delete($this->gambar);
    }
    public function getAllBarang(){
        $barang = DB::table('barangs')->paginate(3);
        return $barang;
    }

    public function getBarang ($data){
        $barang = DB::table('barangs')
            ->Where('nama_barang','LIKE', '%'.$data.'%')
            ->get();
            return $barang;
    }
}
