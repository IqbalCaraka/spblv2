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
Route::resource('to-do-list', 'ToDoListController');
Route::resource('proses-validasi', 'ProsesValidasiController');
Route::resource('menu', 'MenuController');
Route::resource('keranjang', 'KeranjangController');
Route::resource('transaksi', 'TransaksiController');
Route::put('transaksi-validasi', 'TransaksiController@updateValidasi')->name('update-validasi');
Route::resource('laporan-pengajuan', 'LaporanPengajuanController');
Route::get('laporan-pengajuan-pengajuan', 'LaporanPengajuanController@getPengajuan')->name('laporan-pengajuan.pengajuan');
Route::get('laporan-pengajuan-validasi', 'LaporanPengajuanController@getValidasi')->name('laporan-pengajuan.validasi');
Route::get('laporan-pengajuan-selesai', 'LaporanPengajuanController@getSelesai')->name('laporan-pengajuan.selesai');
Route::get('laporan-pengajuan-ditolak', 'LaporanPengajuanController@getDitolak')->name('laporan-pengajuan.ditolak');
Route::get('laporan-pengajuan-dibatalkan', 'LaporanPengajuanController@getDibatalkan')->name('laporan-pengajuan.dibatalkan');
// Route::get ('/menu/search', 'MenuController@search');

