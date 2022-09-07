<?php

namespace App\Http\Controllers;

use App\PeriodeLaporanBarang;
use App\Barang;
use App\LaporanBarang;
use Illuminate\Http\Request;

class PeriodeLaporanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        $periodeLaporanBarangSebelumnya = PeriodeLaporanBarang::where('bulan', now()->subMonth()->format('m'))
                                                                ->where('tahun', now()->subMonth()->format('Y'))
                                                                ->first();
        $barang = Barang::all();
        if($periodeLaporanBarangSebelumnya != ""){
            $periodeLaporanBarangSebelumnya->update(['status'=>'0']);
            //update periode laporan barang sebelumnya
            foreach($barang as $item){
                $laporanBarangSebelumnya = LaporanBarang::where('periode_laporan_barang_id', $periodeLaporanBarangSebelumnya->id)
                                            ->where('barang_id', $item->id)
                                            ->first();
                $laporanBarangSebelumnya->update(['saldo_akhir'=> $item->stok]);
            }
        }
        $periodeLaporanBarang = PeriodeLaporanBarang::create([
            'bulan' => now()->format('m'),
            'tahun' => now()->format('Y'),
            'status' => '1'
        ]);
        foreach($barang as $item){
            LaporanBarang::create([
                'barang_id' => $item->id,
                'saldo_awal' => $item->stok,
                'periode_laporan_barang_id' => $periodeLaporanBarang->id
            ]);
                
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
