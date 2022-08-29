<?php

namespace App\Http\Controllers;
use App\Transaksi;

use Illuminate\Http\Request;

class SemuaStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transaksi = Transaksi::orderBy('created_at', 'DESC')->get();
        if($request->ajax()){
            return datatables()->of($transaksi)
        ->addColumn('nomor_transaksi', function($data){
            return <<<EOD
                    <div>
                        <a href="javascript:void(0);" data-transaksi="$data->id" data-notransaksi="$data->nomor_transaksi" value="$data->id" data-bs-toggle="modal" data-bs-target="#exLargeModal" onClick="detailLaporanPengajuan(event.target)">$data->nomor_transaksi</a>
                    </div>
                EOD;
        })
        ->addColumn('pembuat_pengajuan', function($data){
            return $data->user->name;
        })
        ->addColumn('bidang', function($data){
            return $data->user->bidang->bidang;
        })
        ->addColumn('jumlah_barang', function($data){
            return $data->laporanPengajuan->count();
        })
        ->addColumn('total_barang', function($data){
            $total_barang = $data->laporanPengajuan->toArray();
            return array_sum(array_column($total_barang,'jumlah_barang'));
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
            }
            elseif($status == "Proses Validasi"){
                return <<<EOD
                            <span class="badge bg-label-validasi">$status</span>
                        EOD;
            }
            elseif($status == "Proses Dokumen"){
                return <<<EOD
                            <span class="badge bg-label-dokumen">$status</span>
                        EOD;
            }elseif($status == "Selesai"){
                    return <<<EOD
                                <span class="badge bg-label-selesai">$status</span>
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
        ->rawColumns(['nomor_transaksi',
                'pembuat_pengajuan',
                'bidang',
                'jumlah_barang',
                'total_barang',
                'tanggal_pengajuan',
                'status'])
        ->addIndexColumn()
        ->make(true);
        };
        $title = 'Semua Status';
        return view('semuastatus.index')->with('title', $title);
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
