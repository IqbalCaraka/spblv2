<?php

namespace App\Http\Controllers;

use App\RiwayatTransaksi;
use Illuminate\Http\Request;

class RiwayatTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $riwayat_transaksi = RiwayatTransaksi::orderBy('created_at', 'DESC')->get();
        if($request->ajax()){
            return datatables()->of($riwayat_transaksi)
            ->addColumn('nomor_transaksi', function($data){
                return $data->transaksi->nomor_transaksi;
            })
            ->addColumn('pembuat_pengajuan', function($data){
                return $data->transaksi->user->name;
            })
            ->addColumn('pemroses', function($data){
                return $data->user->name;
            })
            ->addColumn('status_telah_proses', function($data){
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
            ->addColumn('waktu_proses', function($data){
                return $data->created_at->format('d-m-Y H:i:s');
            })
            ->addColumn('status_saat_ini', function($data){
                $status = $data->transaksi->status->status;
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
            ->rawColumns(['nomor_transaksi',
                        'pembuat_pengajuan',
                        'pemroses',
                        'status_telah_proses',
                        'waktu_proses',
                        'status_saat_ini'])
            ->addIndexColumn()
            ->make(true);
        };
        
        $title = "Riwayat Transaksi";
        return view('riwayattransaksi.index')->with('title', $title);
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
