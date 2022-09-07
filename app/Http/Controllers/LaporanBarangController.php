<?php

namespace App\Http\Controllers;

use App\LaporanBarang;
use App\MutasiBarang;
use App\PeriodeLaporanBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $periodeLaporanBarang = PeriodeLaporanBarang::where('bulan', now()->format('m'))
                                                            ->where('tahun', now()->format('Y'))
                                                            ->first();
        $periodeLaporanBarangSebelumnya = PeriodeLaporanBarang::where('bulan', now()->subMonth()->format('m'))
                                                            ->where('tahun', now()->subMonth()->format('Y'))
                                                            ->first();
        $periodeBulanSebelumnya = Carbon::parse(now()->subMonth()->locale('id'))->translatedFormat('F Y');
        $periodeBulanSekarang = Carbon::parse(now()->locale('id'))->translatedFormat('F Y');
        if($periodeLaporanBarang != ""){
            $laporanBarang = LaporanBarang::where('periode_laporan_barang_id', $periodeLaporanBarang->id)->orderBy('barang_id', 'ASC')->get();
            $judul_periode_laporan_barang =Carbon::parse(now()->locale('id'))->translatedFormat('F Y');
        }elseif($periodeLaporanBarangSebelumnya != ""){
            $laporanBarang = LaporanBarang::where('periode_laporan_barang_id', $periodeLaporanBarangSebelumnya->id)->orderBy('barang_id', 'ASC')->get();
            $judul_periode_laporan_barang = Carbon::parse(now()->subMonth()->locale('id'))->translatedFormat('F Y');
        }else{
            $title = 'Laporan Barang';
            return view('laporanbarang.index')->with('title', $title)
                        ->with('periodeLaporanBarang', $periodeLaporanBarang)
                        ->with('periodeLaporanBarangSebelumnya', $periodeLaporanBarangSebelumnya)
                        ->with('periodeBulanSebelumnya', $periodeBulanSebelumnya)
                        ->with('periodeBulanSekarang', $periodeBulanSekarang);
        }

        if($request->ajax()){
            return datatables()->of($laporanBarang)
            ->addColumn('nama_barang', function($data){
                return $data->barang->nama_barang;
            })
            ->addColumn('mutasi_masuk', function($data){
                $mutasi = MutasiBarang::where('periode_laporan_barang_id', $data->periode_laporan_barang_id)
                                                ->where('barang_id', $data->barang_id)
                                                ->get();
                $jumlah_mutasi_masuk=0;
                foreach($mutasi as $item){
                    $jumlah_mutasi_masuk += $item->masuk;
                }
                if($jumlah_mutasi_masuk == 0){
                    return '0';
                }else{
                    return $jumlah_mutasi_masuk;
                }
            })
            ->addColumn('mutasi_keluar', function($data){
                $mutasi = MutasiBarang::where('periode_laporan_barang_id', $data->periode_laporan_barang_id)
                                                ->where('barang_id', $data->barang_id)
                                                ->get();
                $jumlah_mutasi_keluar=0;
                foreach($mutasi as $item){
                    $jumlah_mutasi_keluar += $item->keluar;
                }
                if($jumlah_mutasi_keluar == 0){
                    return '0';
                }else{
                    return $jumlah_mutasi_keluar;
                }
            })  
            ->addIndexColumn()
            ->make(true);
        }

        $title = 'Laporan Barang';
        return view('laporanbarang.index')->with('title', $title)
                        ->with('periodeLaporanBarang', $periodeLaporanBarang)
                        ->with('periodeLaporanBarangSebelumnya', $periodeLaporanBarangSebelumnya)
                        ->with('periodeBulanSebelumnya', $periodeBulanSebelumnya)
                        ->with('periodeBulanSekarang', $periodeBulanSekarang)
                        ->with('judul_periode_laporan_barang', $judul_periode_laporan_barang );
    }

    public function getLaporanBarang (Request $request){
        $periodeLaporanBarang = PeriodeLaporanBarang::where('bulan', $request->bulan)
                                                            ->where('tahun', $request->tahun)
                                                            ->first();
        if($periodeLaporanBarang == ""){
            return response()->json(['success'=>0,'text'=>'Laporan barang pada periode tersebut belum pernah dicatatkan!'], 442);
        }else{
            $laporanBarang = LaporanBarang::where('periode_laporan_barang_id', $periodeLaporanBarang->id)->orderBy('barang_id', 'ASC')->get();
            if($request->ajax()){
                return datatables()->of($laporanBarang)
                ->addColumn('nama_barang', function($data){
                    return $data->barang->nama_barang;
                })
                ->addColumn('mutasi_masuk', function($data){
                    $mutasi = MutasiBarang::where('periode_laporan_barang_id', $data->periode_laporan_barang_id)
                                                    ->where('barang_id', $data->barang_id)
                                                    ->get();
                    $jumlah_mutasi_masuk=0;
                    foreach($mutasi as $item){
                        $jumlah_mutasi_masuk += $item->masuk;
                    }
                    if($jumlah_mutasi_masuk == 0){
                        return '0';
                    }else{
                        return $jumlah_mutasi_masuk;
                    }
                })
                ->addColumn('mutasi_keluar', function($data){
                    $mutasi = MutasiBarang::where('periode_laporan_barang_id', $data->periode_laporan_barang_id)
                                                    ->where('barang_id', $data->barang_id)
                                                    ->get();
                    $jumlah_mutasi_keluar=0;
                    foreach($mutasi as $item){
                        $jumlah_mutasi_keluar += $item->keluar;
                    }
                    if($jumlah_mutasi_keluar == 0){
                        return '0';
                    }else{
                        return $jumlah_mutasi_keluar;
                    }
                })  
                ->addIndexColumn()
                ->make(true);
            }
            return response()->json(['success'=>0,'text'=>'Laporan barang pada periode tersebut belum pernah dicatatkan!'], 442);
        }
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
