<?php

namespace App\Http\Controllers;

use App\LaporanPengajuan;
use App\LaporanPengajuanBarangTidakTersedia;
use Illuminate\Http\Request;

class LaporanPengajuanBarangTidakTersediaController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $laporanPengajuanTidakTersedia = LaporanPengajuanBarangTidakTersedia::where('transaksi_id','=',$id)->get();
        if($request->ajax()){
            return datatables()->of($laporanPengajuanTidakTersedia)
            ->addColumn('nama_barang', function($data){
                $nama_barang = $data->nama_barang;
                $status = $data->statusItemPengajuan->status;
                if($status == "Pengajuan"){
                    return <<<EOD
                                <span class="badge bg-label-pengajuan">$nama_barang</span>
                            EOD;
                }elseif($status == "Ditolak"){
                    return <<<EOD
                                <span class="badge bg-label-ditolak">$nama_barang</span>
                            EOD;
                }
                elseif($status == "Disesuaikan"){
                    return <<<EOD
                                <span class="badge bg-label-diterima">$nama_barang</span>
                            EOD;
                }  
                elseif($status == "Dibatalkan"){
                    return <<<EOD
                                <span class="badge bg-label-dibatalkan">$nama_barang</span>
                            EOD;
                }
                elseif($status == "Proses Validasi"){
                    return <<<EOD
                                <span class="badge bg-label-validasi">$nama_barang</span>
                            EOD;
                }    
            })
            ->addColumn('status', function($data){
                $status = $data->statusItemPengajuan->status;
                if($status == "Pengajuan"){
                    return <<<EOD
                                <span class="badge bg-label-pengajuan">$status</span>
                            EOD;
                }elseif($status == "Ditolak"){
                    return <<<EOD
                                <span class="badge bg-label-ditolak">$status</span>
                            EOD;
                }
                elseif($status == "Disesuaikan"){
                    return <<<EOD
                                <span class="badge bg-label-diterima">$status</span>
                            EOD;
                }  
                elseif($status == "Dibatalkan"){
                    return <<<EOD
                                <span class="badge bg-label-dibatalkan">$status</span>
                            EOD;
                }
                elseif($status == "Proses Validasi"){
                    return <<<EOD
                                <span class="badge bg-label-validasi">$status</span>
                            EOD;
                } 
            })
            ->addColumn('laporan_pengajuan', function($data){
                if($data->laporanPengajuan == ""){
                    return "-";
                }else{
                    return $data->laporanPengajuan->barang->nama_barang;
                }
            })
            ->addColumn('jumlah_disesuaikan', function($data){
                if($data->laporanPengajuan == ""){
                    return "-";
                }else{
                    return $data->laporanPengajuan->jumlah_barang;
                }
            })
            ->addColumn('action', function($data){
                if($data->status_item_pengajuan_id == 4){
                    return '<button type="button" class="btn btn-outline-primary" data-notransaksi="'.$data->transaksi->nomor_transaksi.'" data-jumlahbarang="'.$data->jumlah_barang.'" data-satuan="'.$data->satuan->nama_satuan.'" data-transaksi="'.$data->transaksi->id.'"data-laporan="'.$data->id.'" data-update="1" data-barang="'.$data->nama_barang.'" onClick="sesuaikanPermintaan(event.target)" data-bs-toggle="modal" data-bs-target="#sesuaikanPermintaan">Sesuaikan Pengajuan</button>';
                } else{
                    return "";
                }
            })
            ->addColumn('satuan', function($data){
                return $data->satuan->nama_satuan;
            })
            ->rawColumns(['nama_barang',
                            'satuan', 
                            'laporan_pengajuan',
                            'jumlah_disesuaikan',
                            'status',
                            'action'])
            ->addIndexColumn()
            ->make(true);
        };
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
