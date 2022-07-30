<?php

namespace App;
use App\Transaksi;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $guarded = [];

    public function transaksi(){
        return $this->hasMany(Transaksi::class);
    } 
}
