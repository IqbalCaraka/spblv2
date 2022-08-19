<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\Bidang;
use App\DokumenPenyerahan;
use App\LaporanPengajuan;
use Illuminate\Http\Request;
use App\Transaksi;
use Illuminate\Support\Facades\Auth;
use PDF;

class ProsesDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transaksi = Transaksi::where('status_id','=',3)->orderBy('created_at', 'ASC')->get();
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
            ->addColumn('action', function($data){
                // $url = route('proses-dokumen.show',$data->id);
                return '
                            <div style="text-align: left;">
                                    <button id="lihatdokumen" class="btn btn-sm btn-outline-primary" data-transaksi="'.$data->id.'" data-update="3" data-notransaksi="'.$data->nomor_transaksi.'" data-bs-toggle="modal" data-bs-target="#modalAksi" onClick="lihatDokumen(event.target)">
                                    Tanda Tangan</button>
                            </div>
                        ';
            })
            ->rawColumns(['nomor_transaksi',
                        'pembuat_pengajuan',
                        'bidang',
                        'jumlah_barang',
                        'total_barang',
                        'tanggal_pengajuan',
                        'action'])
            ->addIndexColumn()
            ->make(true);
        };
        $title = 'Proses Dokumen';
        return view('prosesdokumen.index')->with('title', $title);
    }

    public function generatePDF($id){        
        $laporanPengajuan = LaporanPengajuan::where('transaksi_id',$id)->get();
        $data = ['title' => 'Penyerahan Barang Persediaan'];
        $laporanPengajuan =['laporanPengajuan'=> $laporanPengajuan];
        $pdf = PDF::loadView('dokumen.penyerahanbarang', $data, $laporanPengajuan);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('penyerahanbarang.pdf');
    }

    public function getDokumen($id){
        $dokumenPenyerahan = DokumenPenyerahan::where('transaksi_id', $id)
                            ->with('kasubumumUser')
                            ->with('administratorUser', 'administratorUser.jabatan')
                            ->with('penerimaUser')
                            ->first();
        return response()->json($dokumenPenyerahan);
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
        $laporanPengajuan = LaporanPengajuan::where('transaksi_id',$id)
                                                ->where('status_item_pengajuan_id', '1')
                                                ->with('barang')->get();
        $dokumenPenyerahan = DokumenPenyerahan::where('transaksi_id', $id)->first();
        $data = [
                'no_agenda'=>$dokumenPenyerahan->no_agenda,
                'kasubumum'=> $dokumenPenyerahan->kasubumumUser,
                'administrator' => $dokumenPenyerahan->administratorUser,
                'penerima'=> $dokumenPenyerahan->penerimaUser,
                'penyerah' => Auth::user(),
                'tgl_pengajuan' => $dokumenPenyerahan->transaksi->created_at->format('d-m-Y')
            ];
        $laporanPengajuan =['laporanPengajuan'=> $laporanPengajuan];
        $pdf = PDF::loadView('dokumen.penyerahanbarang', $data, $laporanPengajuan);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('penyerahanbarang.pdf');
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
