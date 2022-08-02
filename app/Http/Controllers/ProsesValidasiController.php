<?php

namespace App\Http\Controllers;
use App\Transaksi;
use App\LaporanPengajuan;
use App\RevisiLaporanPengajuan;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class ProsesValidasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transaksi = Transaksi::where('status_id','=',2)
                        ->get();
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
                return '
                            <div style="text-align: left;">
                                <button class="btn btn-sm btn-outline-primary" data-transaksi="'.$data->id.'" data-update="3" data-notransaksi="'.$data->nomor_transaksi.'" onClick="updateTransaksi(event.target)">Terima Pengajuan</button>
                            </div>
                        ';
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
        return view('prosesvalidasi.index');
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
        $rules =[
            'revisi_jumlah_barang'=>'required',
        ];

        $text =[
            'revisi_jumlah_barang.required' => 'Mohon isi jumlah barang yang akan direvisi!'
        ];

        $validasi = Validator::make($request->all(),$rules,$text);

        if($validasi->fails()){
            return response()->json(['success'=>0,'text' => $validasi->errors()->first()],422);
        }

        if($request->revisi_jumlah_barang <= $request->stok){
            LaporanPengajuan::where('id','=',$request->laporan_pengajuan_id)
                            ->update(['revisi_jumlah_barang'=>$request->revisi_jumlah_barang]);
        }else{
            return response()->json(['success'=>0,'text' => "Revisi jumlah barang melebihi stok!"],422);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $laporanPengajuan = LaporanPengajuan::where('transaksi_id','=',$id)->get();
        if($request->ajax()){
            return datatables()->of($laporanPengajuan)
            ->addColumn('nama_barang', function($data){
                if($data->status_item_pengajuan_id == 1){
                    return '<span class="badge bg-label-disetujui">'.$data->barang->nama_barang.'</span>';
                }else{
                    return '<span class="badge bg-label-ditolak">'.$data->barang->nama_barang.'</span>';
                }
            })
            ->addColumn('revisi_jumlah_barang', function($data){
                if($data->revisi_jumlah_barang == ""){
                    return '-';
                }else{
                    return $data->revisi_jumlah_barang;
                }
            })
            ->addColumn('stok', function($data){
                return $data->barang->stok;
            })
            ->addColumn('harga_satuan', function($data){
                return $data->barang->harga_satuan;
            })
            ->addColumn('total_harga', function($data){
                $total_harga = $data->barang->harga_satuan * $data->jumlah_barang;
                return $total_harga;
                
            })
            ->addColumn('persetujuan', function($data){
                return $data->statusItemPengajuan->status;
            })
            ->addColumn('action', function($data){
                if($data->status_item_pengajuan_id == 1){
                    $a = '<a class="dropdown-item" href="javascript:void(0);" data-transaksi="'.$data->transaksi->id.'"data-laporan="'.$data->id.'" data-update="2" data-barang="'.$data->barang->nama_barang.'" onClick="updateStatusItemPengajuan(event.target)">Tolak Item Pengajuan</a>';
                } else{
                    $a = '<a class="dropdown-item" href="javascript:void(0);" data-transaksi="'.$data->transaksi->id.'"data-laporan="'.$data->id.'" data-update="1" data-barang="'.$data->barang->nama_barang.'" onClick="updateStatusItemPengajuan(event.target)">Setujui Item Pengajuan</a>';
                }
                return '
                        <div class="dropdown" style="text-align: left;">
                            <button class="btn btn-sm btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                <a class="dropdown-item" href="javascript:void(0);" data-laporan="'.$data->id.'"data-transaksi="'.$data->transaksi->id.'" data-notransaksi="'.$data->transaksi->nomor_transaksi.'" data-bs-toggle="modal" data-bs-target="#revisiPengajuan" onClick="revisiItemPengajuan(event.target)" data-jumlahbarang="'.$data->jumlah_barang.'" data-stok="'.$data->barang->stok.'">Revisi Item Pengajuan</a>
                                '.$a.'
                            </div>
                        </div>
                        ';
            })
            ->rawColumns(['nama_barang',
                           'revisi_jumlah_barang',
                           'stok',
                           'harga_satuan',
                           'total_harga',
                           'persetujuan',
                           'action' ])
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
