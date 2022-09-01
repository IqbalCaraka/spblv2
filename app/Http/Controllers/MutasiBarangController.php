<?php

namespace App\Http\Controllers;

use App\MutasiBarang;
use Illuminate\Http\Request;

class MutasiBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
        $title = 'Mutasi';
        return view('mutasibarang.index')->with('title', $title);
    }

    public function riwayatMutasi(Request $request){
        $riwayat_mutasi = MutasiBarang::all();
        if($request->ajax()){
            return datatables()->of($riwayat_mutasi)
            ->addColumn('nama_barang', function($data){
                $nama_barang = $data->barang->nama_barang;
                if($data->masuk == ""){
                    return <<<EOD
                                <span class="badge bg-label-ditolak">$nama_barang</span>
                            EOD;
                }else{
                    return <<<EOD
                                <span class="badge bg-label-ditolak">$nama_barang</span>
                            EOD;
                }
            })
            ->addColumn('mutasi_masuk', function($data){
                if($data->masuk == ""){
                    return "-";
                }else{
                    return <<<EOD
                                <span class="badge bg-label-disetujui">$data->masuk</span>
                            EOD;
                }
            })
            ->addColumn('mutasi_keluar', function($data){
                if($data->keluar == ""){
                    return "-";
                }else{
                    return <<<EOD
                                <span class="badge bg-label-ditolak">$data->keluar</span>
                            EOD;
                }
            })                
            ->addColumn('waktu_proses', function($data){
                return $data->created_at->format('d-m-Y H:i:s');
            })
            ->rawColumns(['nama_barang',
                        'mutasi_masuk',
                        'mutasi_keluar',
                        'waktu_proses'])
            ->addIndexColumn()
            ->make(true);
        };
        $title= 'Riwayat Mutasi';
        return view('mutasibarang.riwayatmutasi')->with('title', $title);
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
