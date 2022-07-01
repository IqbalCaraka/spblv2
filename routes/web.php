<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('jenis', 'JenisController');
Route::resource('kategori', 'KategoriController');
Route::get('get-jenis', 'KategoriController@getJenis')->name('get-jenis.index');
Route::resource('barang', 'BarangController',['except' => ['update']]);
Route::post('barang-update', 'BarangController@update')->name('barang.update');
Route::get('get-kategori', 'BarangController@getKategori')->name('get-kategori.index');
Route::resource('menu', 'MenuController');
Route::post ('search', 'MenuController@search');

Route::get('search',function(){
    return view('layouts.menu');
});
