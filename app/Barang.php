<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Barang extends Model
{
    protected $guarded = [];

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function deleteImage(){
        Storage::delete($this->gambar);
    }
}
