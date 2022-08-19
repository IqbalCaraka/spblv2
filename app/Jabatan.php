<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->hasMany(User::class,'jabatan_id');
    }
    
}
