<?php

namespace App\Http\Controllers;

use App\Keranjang;
use App\LaporanPengajuan;
use App\Transaksi;
use App\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
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
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $keranjangs = Keranjang::Where('user_id','=', Auth::user()->id)->get();
        $nomor_transaksi = '#'.now()->format('dmY').random_int(10000,99999);
        $transaksi = Transaksi::create([
            'nomor_transaksi'=> $nomor_transaksi,
            'user_id'=> Auth::user()->id,
            'status_id'=>1,
        ]);
        foreach($keranjangs as $keranjang){
            LaporanPengajuan::create([
                'transaksi_id'=> $transaksi->id,
                'barang_id'=> $keranjang->barang_id,
                'jumlah_barang'=> $keranjang->jumlah_barang,
                'status_item_pengajuan_id'=> '1'
            ]);
            $keranjang = Keranjang::find($keranjang->id);
            $keranjang->delete();
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
        if($request->data == 3){
            $laporanPengajuan = LaporanPengajuan::with(['barang'])->where('transaksi_id','=',$id)->get();
            foreach ($laporanPengajuan as $item){
                if($item->status_item_pengajuan_id == "1"){
                    if($item->revisi_jumlah_barang == ""){
                        $jumlah_barang_terkonfirmasi = $item->jumlah_barang;
                    }else{
                        $jumlah_barang_terkonfirmasi = $item->revisi_jumlah_barang;
                    }

                    if($jumlah_barang_terkonfirmasi <= $item->barang->stok){
                        Barang::where('id','=', $item->barang_id)->update(['stok'=>\DB::raw('stok-'.$jumlah_barang_terkonfirmasi)]);
                    }else{
                        $item->status_item_pengajuan_id = "2";
                        $item->save();
                    }
                }
            }
        }
        Transaksi::where('id', '=', $id)->update(['status_id'=> $request->data]);
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
