<?php

namespace App\Http\Controllers;

use App\LaporanPengajuan;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanPengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transaksis = Transaksi::where('user_id','=',Auth::user()->id)->get();
        if($request->ajax()){
            return datatables()->of($transaksis)
            ->addColumn('nomor_transaksi', function($data){
                return <<<EOD
                            <div>
                                <a href="javascript:void(0);" data-id="$data->id" data-bs-toggle="modal" data-bs-target="#laporan" onClick="detailLaporanPengajuan(event.target)">$data->nomor_transaksi</a>
                            </div>
                        EOD;
            })
            ->addColumn('tanggal_pengajuan', function($data){
                return $data->created_at->format('d-m-Y');
            })
            ->addColumn('status', function($data){
                $status = $data->status->status;
                if($status == "Pengajuan"){
                    return <<<EOD
                                <span class="badge bg-label-pengajuan">$status</span>
                            EOD;
                }elseif($status == "Proses Validasi"){
                    return <<<EOD
                                <span class="badge bg-label-validasi">$status</span>
                            EOD;
                }elseif($status == "Diterima"){
                        return <<<EOD
                                    <span class="badge bg-label-diterima">$status</span>
                                EOD;
                }elseif($status == "Ditolak"){
                    return <<<EOD
                                <span class="badge bg-label-ditolak">$status</span>
                            EOD;
                }elseif($status == "Dibatalkan"){
                    return <<<EOD
                                <span class="badge bg-label-dibatalkan">$status</span>
                            EOD;
                };               
                
            })
            ->rawColumns(['nomor_transaksi','tanggal_pengajuan','status'])
            ->addIndexColumn()
            ->make(true);
        };

        return view('pengguna.laporanPengajuan');
    }

    public function getPengajuan(Request $request){
        $transaksis = Transaksi::where('user_id','=',Auth::user()->id)
                                        ->where('status_id','=',1)
                                        ->get();
        if($request->ajax()){
            return datatables()->of($transaksis)
            ->addColumn('nomor_transaksi', function($data){
                return <<<EOD
                            <div>
                                <a href="javascript:void(0);" data-id="$data->id" data-bs-toggle="modal" data-bs-target="#laporan" onClick="detailLaporanPengajuan(event.target)">$data->nomor_transaksi</a>
                            </div>
                        EOD;
            })
            ->addColumn('tanggal_pengajuan', function($data){
                return $data->created_at->format('d-m-Y');
            })
            ->addColumn('action', function($data){
                return <<<EOD
                        <div class="batal">
                            <button class="btn btn-sm btn-danger btn-check-out" data-id="$data->id" onclick="batalTransaksi(event.target)">
                                Batal
                            </button>
                        </div>
                        EOD;  
            })
            ->rawColumns(['nomor_transaksi','tanggal_pengajuan','action'])
            ->addIndexColumn()
            ->make(true);
        };
    }

    public function getValidasi (Request $request){
        $transaksis = Transaksi::where('user_id','=',Auth::user()->id)
                                    ->where('status_id','=',2)
                                    ->get();
        if($request->ajax()){
            return datatables()->of($transaksis)
            ->addColumn('nomor_transaksi', function($data){
                return <<<EOD
                            <div>
                                <a href="javascript:void(0);" data-id="$data->id" data-bs-toggle="modal" data-bs-target="#laporan" onClick="detailLaporanPengajuan(event.target)">$data->nomor_transaksi</a>
                            </div>
                        EOD;
            })
            ->addColumn('tanggal_pengajuan', function($data){
                return $data->created_at->format('d-m-Y');
            })
            ->rawColumns(['nomor_transaksi','tanggal_pengajuan'])
            ->addIndexColumn()
            ->make(true);
        };
    }

    public function getSelesai (Request $request){
        $transaksis = Transaksi::where('user_id','=',Auth::user()->id)
                                ->where('status_id','=',3)
                                ->get();
        if($request->ajax()){
            return datatables()->of($transaksis)
            ->addColumn('nomor_transaksi', function($data){
                return <<<EOD
                            <div>
                                <a href="javascript:void(0);" data-id="$data->id" data-bs-toggle="modal" data-bs-target="#laporan" onClick="detailLaporanPengajuan(event.target)">$data->nomor_transaksi</a>
                            </div>
                        EOD;
            })
            ->addColumn('tanggal_pengajuan', function($data){
                return $data->created_at->format('d-m-Y');
            })
            ->rawColumns(['nomor_transaksi','tanggal_pengajuan'])
            ->addIndexColumn()
            ->make(true);
        };
    }

    public function getDitolak (Request $request){
        $transaksis = Transaksi::where('user_id','=',Auth::user()->id)
                                ->where('status_id','=',4)
                                ->get();
        if($request->ajax()){
            return datatables()->of($transaksis)
            ->addColumn('nomor_transaksi', function($data){
                return <<<EOD
                            <div>
                                <a href="javascript:void(0);" data-id="$data->id" data-bs-toggle="modal" data-bs-target="#laporan" onClick="detailLaporanPengajuan(event.target)">$data->nomor_transaksi</a>
                            </div>
                        EOD;
            })
            ->addColumn('tanggal_pengajuan', function($data){
                return $data->created_at->format('d-m-Y');
            })
            ->rawColumns(['nomor_transaksi','tanggal_pengajuan'])
            ->addIndexColumn()
            ->make(true);
        };
    }

    public function getDibatalkan(Request $request){
        $transaksis = Transaksi::where('user_id','=',Auth::user()->id)
                                ->where('status_id','=', 6)
                                ->get();
        if($request->ajax()){
            return datatables()->of($transaksis)
            ->addColumn('nomor_transaksi', function($data){
                return <<<EOD
                            <div>
                                <a href="javascript:void(0);" data-id="$data->id" data-bs-toggle="modal" data-bs-target="#laporan" onClick="detailLaporanPengajuan(event.target)">$data->nomor_transaksi</a>
                            </div>
                        EOD;
            })
            ->addColumn('tanggal_pengajuan', function($data){
                return $data->created_at->format('d-m-Y');
            })
            ->rawColumns(['nomor_transaksi','tanggal_pengajuan'])
            ->addIndexColumn()
            ->make(true);
        };
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
        $laporanPengajuan = LaporanPengajuan::where('transaksi_id','=',$id)->get();
        if($request->ajax()){
            return datatables()->of($laporanPengajuan)
            ->addColumn('nama_barang', function($data){
                return $data->barang->nama_barang;
            })
            ->rawColumns(['nama_barang'])
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
        LaporanPengajuan::where('id', '=', $id)->update(['status_item_pengajuan_id'=> $request->data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
