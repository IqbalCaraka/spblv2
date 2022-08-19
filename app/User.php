<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Jabatan;
use App\Bidang;
use App\Peran;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function keranjang(){
        return $this->hasMany(Keranjang::class,'user_id');
    }

    public function jabatan(){
        return $this->belongsTo(Jabatan::class,'jabatan_id');
    }

    public function bidang(){
        return $this->belongsTo(Bidang::class,'bidang_id');
    }

    public function peran(){
        return $this->belongsTo(Peran::class,'peran_id');
    }

    public function administratorUser(){
        return $this->belongsTo(Jabatan::class,'jabatan_id');
    }
    
}
