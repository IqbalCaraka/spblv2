<?php

namespace App\Http\Controllers;

use App\Barang;
use App\LaporanPengajuan;
use App\Transaksi;
use Illuminate\Http\Request;

class KebutuhanPermintaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {                    
        $barang = Barang::all();
        if($request->ajax()){
            return datatables()->of($barang)
            ->addColumn('total_permintaan', function($data){
                $laporan_pengajuan = LaporanPengajuan:: where('status_item_pengajuan_id','=','1')
                ->where('barang_id','=',$data->id)
                ->whereHas('transaksi', function ($q){
                    $q->where('status_id','=','1')
                        ->orWhere('status_id','=','2');
                })
                ->get();
            $total_permintaan = 0;
            foreach($laporan_pengajuan as $item){
                if($item->revisi_jumlah_barang == null){
                    $total_permintaan += (int)$item->jumlah_barang;
                }else{
                    $total_permintaan += (int)$item->revisi_jumlah_barang;
                }
            } 
            return $total_permintaan;   
        })
        ->addColumn('selisih', function($data){
            return $data->stok;
        })
        ->rawColumns(['total_permintaan',
                    'selisih'
                    ])
            ->addIndexColumn()
            ->make(true);
        }
        $title ='Kebutuhan Permintaan';
        return view('kebutuhanpermintaan.index')->with('title', $title);
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
        //
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
