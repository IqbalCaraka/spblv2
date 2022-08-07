<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtamaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('pengguna.utama');
    }
}
