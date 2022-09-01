<?php

namespace App\Http\Controllers;

use App\Barang;
use App\LaporanPengajuan;
use App\LaporanPengajuanBarangTidakTersedia;
use App\Transaksi;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KebutuhanPermintaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {                    
        $barang = Barang::selectRaw("SUM(CASE WHEN laporan_pengajuans.revisi_jumlah_barang IS NULL 
                                        THEN laporan_pengajuans.jumlah_barang 
                                        ELSE laporan_pengajuans.revisi_jumlah_barang END) 
                                        AS permintaan, 
                                        barangs.id,
                                        barangs.nomor_barang,
                                        barangs.nama_barang,
                                        barangs.stok")
                        ->join('laporan_pengajuans', 'barangs.id', 'laporan_pengajuans.barang_id')
                        ->join('transaksis', 'transaksis.id', 'laporan_pengajuans.transaksi_id')
                        ->where('status_item_pengajuan_id','3')
                        ->orWhere(function($q){
                            $q->where('status_item_pengajuan_id','1')
                                ->where('status_id', '2');
                        })
                        ->groupBy('barangs.id')
                        ->get();    
        if($request->ajax()){
        return datatables()->of($barang)
        ->addColumn('permintaan', function($data){
            return $data->permintaan;   
        })
        ->addColumn('nomor_barang', function($data){
            return $data->nomor_barang;   
        })
        ->addColumn('nama_barang', function($data){
            return $data->nama_barang;
        })
        ->addColumn('stok', function($data){
            return $data->stok;
        })
        ->addColumn('selisih', function($data){
            $selisih = $data->stok - $data->permintaan;
            if($selisih >= 0){
                return <<<EOD
                            <span class="badge bg-label-disetujui">$selisih</span>
                        EOD;
            }else{
                return <<<EOD
                            <span class="badge bg-label-ditolak">$selisih</span>
                        EOD;
            }
        })
        ->rawColumns(['permintaan',
                    'nomor_barang',
                    'nama_barang',
                    'stok',
                    'selisih'
                    ])
            ->addIndexColumn()
            ->make(true);
        }
        $title ='Kebutuhan Permintaan';
        return view('kebutuhanpermintaan.index')->with('title', $title);
    }

    public function tidakTersedia(Request $request){
        $laporan_pengajuan = LaporanPengajuanBarangTidakTersedia::where('status_item_pengajuan_id', '3')
                                                                ->orWhere('status_item_pengajuan_id', '4')
                                                                ->get();
        if($request->ajax()){
            return datatables()->of($laporan_pengajuan)
        ->addColumn('satuan', function($data){
            return $data->satuan->nama_satuan;
        })
        ->rawColumns(['satuan'])
        ->addIndexColumn()
        ->make(true);
        }
        $title ='Permintaan Tidak Tersedia';
        return view('kebutuhanpermintaan.permintaantidaktersedia')->with('title', $title);
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
