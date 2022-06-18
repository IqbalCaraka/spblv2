<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kategori;

class Jenis extends Model
{
    protected $guarded = [];

    public function kategoris(){
        return $this->hasMany(Kategori::class);
    }
}
