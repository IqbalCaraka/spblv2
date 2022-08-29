<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\Bidang;
use App\DokumenPenyerahan;
use App\LaporanPengajuan;
use Illuminate\Http\Request;
use App\Transaksi;
use App\TandaTangan;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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
                return <<<EOD
                            <div class="dropdown" style="text-align: left;">
                                <button class="btn btn-sm btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                    <a class="dropdown-item" href="javascript:void(0);" id="lihatdokumen" data-transaksi="$data->id" data-notransaksi="$data->nomor_transaksi" data-bs-toggle="modal" data-bs-target="#modalAksi" onClick="lihatDokumen(event.target)">Status Tanda Tangan</a>
                                    <a class="dropdown-item" href="javascript:void(0);" id="transaksi_selesai" data-transaksi="$data->id" data-update="5" data-notransaksi="$data->nomor_transaksi" onClick="updateTransaksi(event.target)">Selesai</a>
                                </div>
                            </div>
                        EOD;
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
                            ->with('penyerahUser')
                            ->first();
        return response()->json($dokumenPenyerahan);
    }

    // public function generateQrCode ($id, $peran, $user_id){
    //     $qrCode = DokumenPenyerahan::where('transaksi_id', $id)
    //                                 ->where($peran, $user_id)
    //                                 ->get();
    //     $qrCode = QrCode::style('dot')->eye('circle')->size(200)->generate(route('tanda-tangan',[$id, $user_id]));
    //     return response()->json($qrCode);
    //     // echo($qrCode);

    // }
 

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
        // $ttd = TandaTangan::where('user_id', Auth::user()->id)->first();
        // $dokumenPenyerahan = DokumenPenyerahan::find($request->id);
        // $kolom_update = 'ttd_'.$request->peran;
        // echo('hi');
        // // if($ttd == null){
        // //     $folderPath = public_path('storage/ttd/'); // create signatures folder in public directory
        // //     $image_parts = explode(";base64,", $request->ttd);
        // //     $image_type_aux = explode("image/", $image_parts[0]);
        // //     $image_type = $image_type_aux[1];
        // //     $image_base64 = base64_decode($image_parts[1]);
        // //     $image_name = Auth::user()->nip.'.'.$image_type;
        // //     $file = $folderPath . $image_name;
        // //     file_put_contents($file, $image_base64);

        // //     $ttd = TandaTangan::create([
        // //         'ttd' => 'ttd/'.$image_name,
        // //         'user_id' => Auth::user()->id,
        // //     ]);
        // //     if($request->peran == "penyerah"){
        // //         $dokumenPenyerahan->update([
        // //             $kolom_update => Auth::user()->id,
        // //             'penyerah' => Auth::user()->id
        // //         ]);
        // //     }else{
        // //         $dokumenPenyerahan->update([
        // //             $kolom_update => Auth::user()->id,
        // //         ]);
        // //     }
        // // }else{
        // //     $ttd->deleteImage();
        // //     $folderPath = public_path('storage/ttd/');
        // //     $image_parts = explode(";base64,", $request->ttd);
        // //     $image_type_aux = explode("image/", $image_parts[0]);
        // //     $image_type = $image_type_aux[1];
        // //     $image_base64 = base64_decode($image_parts[1]);
        // //     $image_name = Auth::user()->nip.'.'.$image_type;
        // //     $file = $folderPath . $image_name;
        // //     file_put_contents($file, $image_base64);

        // //     if($request->peran == "penyerah"){
        // //         $dokumenPenyerahan->update([
        // //             $kolom_update => Auth::user()->id,
        // //             'penyerah' => Auth::user()->id
        // //         ]);
        // //     }else{
        // //         $dokumenPenyerahan->update([
        // //             $kolom_update => Auth::user()->id,
        // //         ]);
        // //     }
        // // }
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
                'dokumenPenyerahan' => $dokumenPenyerahan,
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
