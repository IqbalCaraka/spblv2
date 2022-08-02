<?php

namespace App\Http\Controllers;

use App\Transaksi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToDoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transaksis = Transaksi::where('status_id','=',1)
                        ->get();
        if($request->ajax()){
        return datatables()->of($transaksis)
            ->addColumn('nomor_transaksi', function($data){
                return <<<EOD
                            <div>
                                <a href="javascript:void(0);" data-transaksi="$data->id" data-notransaksi="$data->nomor_transaksi" data-bs-toggle="modal" data-bs-target="#laporan" onClick="detailLaporanPengajuan(event.target)">$data->nomor_transaksi</a>
                            </div>
                        EOD;
            })
            ->addColumn('pembuat_pengajuan', function($data){
                return $data->user->name;
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
            ->addColumn('action', function($data){
                return <<<EOD
                            <div class="dropdown" style="text-align: left;">
                                <button class="btn btn-sm btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                    <a class="dropdown-item" data-transaksi="$data->id" data-update="2" data-notransaksi="$data->nomor_transaksi" href="javascript:void(0);" onClick="updateTransaksi(event.target)">Validasi</a>
                                    <a class="dropdown-item" data-transaksi="$data->id" data-update="4" data-notransaksi="$data->nomor_transaksi" href="javascript:void(0);" onClick="updateTransaksi(event.target)">Tolak</a>
                                </div>
                            </div>
                        EOD;
            })
            ->rawColumns(['nomor_transaksi',
                        'pembuat_pengajuan',
                        'jumlah_barang',
                        'total_barang',
                        'tanggal_pengajuan',
                        'action'])
            ->addIndexColumn()
            ->make(true);
        };
        return view('todolist.index');
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
