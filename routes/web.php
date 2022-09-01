<?php

use App\DokumenPenyerahan;
use App\LaporanPengajuan;
use App\Transaksi;
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


Auth::routes();

Route::group(['middleware' => ['auth','superadmin']], function(){
    //Admin
    Route::get('/', 'MenuController@index');
    Route::get('admin/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('admin/jenis', 'JenisController');
    Route::resource('admin/kategori', 'KategoriController');
    Route::get('admin/get-jenis', 'KategoriController@getJenis')->name('get-jenis.index');
    Route::resource('admin/barang', 'BarangController',['except' => ['update']]);
    Route::get('admin/get-barang', 'BarangController@getBarangPenyesuaian')->name('get-barang');
    Route::post('admin/barang-update', 'BarangController@update')->name('barang.update');
    Route::get('admin/get-satuan', 'BarangController@getSatuan')->name('get-satuan');
    Route::get('admin/get-kategori', 'BarangController@getKategori')->name('get-kategori.index');
    Route::resource('admin/satuan', 'SatuanController');
    Route::resource('admin/mutasi-barang', 'MutasiBarangController');
    Route::resource('admin/to-do-list', 'ToDoListController');
    Route::resource('admin/proses-validasi', 'ProsesValidasiController');
    Route::post('admin/sesuaikan-permintaan', 'ProsesValidasiController@sesuaikanPermintaan')->name('sesuaikan-permintaan');
    Route::resource('admin/proses-dokumen', 'ProsesDokumenController',['except' => ['show']]);
    Route::resource('admin/semua-status', 'SemuaStatusController');
    Route::resource('admin/kebutuhan-permintaan', 'KebutuhanPermintaanController');
    Route::get('admin/permintaan-tidak-tersedia', 'KebutuhanPermintaanController@tidakTersedia')->name(('permintaan-tidak-tersedia'));
    Route::resource('admin/riwayat-transaksi', 'RiwayatTransaksiController');
    Route::get('admin/riwayat-mutasi-barang', 'MutasiBarangController@riwayatMutasi')->name(('riwayat-mutasi'));
    Route::resource('admin/profil', 'ProfilController');
    Route::post('admin/profil-reset-password', 'ProfilController@resetPassword')->name('reset-password');
    Route::get('admin/get-jabatan', 'ProfilController@getJabatan')->name('get-jabatan');
    Route::get('admin/get-bidang', 'ProfilController@getBidang')->name('get-bidang');
    Route::get('admin/get-peran', 'ProfilController@getPeran')->name('get-peran');

});
Route::group(['middleware' => ['auth']], function(){
    //Pengguna
    Route::resource('menu', 'MenuController');
    Route::get('get-satuan', 'MenuController@getSatuan')->name('get-satuan');
    Route::resource('keranjang', 'KeranjangController');
    Route::resource('keranjang-barang-tidak-tersedia', 'KeranjangBarangTidakTersediaController');
    Route::resource('transaksi', 'TransaksiController');
    Route::put('transaksi-validasi', 'TransaksiController@updateValidasi')->name('update-validasi');
    Route::resource('laporan-pengajuan', 'LaporanPengajuanController');
    Route::resource('laporan-barang-tidak-tersedia', 'LaporanPengajuanBarangTidakTersediaController');
    Route::get('laporan-pengajuan-pengajuan', 'LaporanPengajuanController@getPengajuan')->name('laporan-pengajuan.pengajuan');
    Route::get('laporan-pengajuan-validasi', 'LaporanPengajuanController@getValidasi')->name('laporan-pengajuan.validasi');
    Route::get('laporan-pengajuan-dokumen', 'LaporanPengajuanController@getDokumen')->name('laporan-pengajuan.dokumen');
    Route::get('laporan-pengajuan-selesai', 'LaporanPengajuanController@getSelesai')->name('laporan-pengajuan.selesai');
    Route::get('laporan-pengajuan-ditolak', 'LaporanPengajuanController@getDitolak')->name('laporan-pengajuan.ditolak');
    Route::get('laporan-pengajuan-dibatalkan', 'LaporanPengajuanController@getDibatalkan')->name('laporan-pengajuan.dibatalkan');
    Route::resource('setting', 'SettingController');
    Route::get('get-dokumen/{id}','ProsesDokumenController@getDokumen')->name('get-dokumen');
    Route::get('/denied', function(){
        return View::make('partials.denied');
    })->name('denied');
    Route::resource('tanda-tangan','TandaTanganController');
    Route::resource('proses-dokumen', 'ProsesDokumenController',['only' => ['show']]);
});

Route::group(['middleware' => ['auth','tandatangan']], function(){
    Route::get('tanda-tangan/{id}/{peran}/{user}','TandaTanganController@index')->name('tandatangan.index');
});