<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peran extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->hasMany(User::class,'peran_id');
    }
}
