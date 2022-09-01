<?php

namespace App\Providers;

use App\Transaksi;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $todolist = Transaksi::where('status_id', '1')->get();
        $todolist = $todolist->count();
        $validasi = Transaksi::where('status_id', '2')->get();
        $validasi = $validasi->count();
        $dokumen = Transaksi::where('status_id', '3')->get();
        $dokumen = $dokumen->count();
        $data =[$todolist, $validasi, $dokumen];
        view()->share('data', $data);
    }
}
