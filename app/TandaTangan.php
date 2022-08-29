<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TandaTangan extends Model
{
    protected $guarded = [];

    public function deleteImage(){
        Storage::delete($this->ttd);
    }
}
