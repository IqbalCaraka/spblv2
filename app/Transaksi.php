<?php

namespace App;
use App\Status;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = [];

    public function status(){
        return $this->belongsTo(Status::class, 'status_id');
    }
}
