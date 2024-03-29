<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Kategori;
use App\MutasiBarang;
use App\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\PeriodeLaporanBarang;
use App\LaporanBarang;


class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list_barang = Barang::all();
        if($request->ajax()){
           return datatables()->of($list_barang)
            ->addColumn('gambar', function($data){
                if(empty($data->gambar)){
                    $url = asset('img/nopict.png');
                }else {
                    $url = asset('storage/'.$data->gambar);
                }
                return '<img src="'.$url.'" border="0" width="40" height="40">';
            })
            ->addColumn('satuan', function($data){
                return $data->satuan->nama_satuan;
            })
            ->addColumn('kategori', function($data){
                return $data->kategori->nama;
            })
            ->addColumn('action', function($data){
               return <<<EOD
                       <div class="dropdown" style="text-align: center;">
                           <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   <i class="bx bx-dots-vertical-rounded"></i>
                           </button>
                           <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                               <a class="dropdown-item" data-id="$data->id" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalEdit" onClick="editBarang(event.target)">Edit</a>
                               <a class="dropdown-item" data-id="$data->id" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalTambahStok" onClick="tambahStok(event.target)">Tambah Stok</a>
                               <a class="dropdown-item" data-id="$data->id" href="javascript:void(0);" onClick="deleteBarang(event.target)">Delete</a>
                           </div>
                       </div>
                       EOD;     
           })
           ->rawColumns(['gambar','satuan','kategori','action'])
           ->addIndexColumn()
           ->make(true);
       }
       $title = "Barang";
        return view('barang.index')->with('title', $title);
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
            'nomor_barang'=>'required|unique:barangs',
            'nama_barang'=>'required|unique:barangs',
            'stok'=>'required',
            'kategori_id'=>'required',
            // 'harga_total'=>'required',
            'gambar'=>'image'
        ];

        $text =[
            'nomor_barang.required' => 'Mohon isi kolom Nomor Barang!',
            'nama_barang.required' => 'Mohon isi kolom Nama Barang!',
            'nomor_barang.unique' => 'Nomor Barang telah terdata sebelumnya!',
            'nama_barang.unique' => 'Nama Barang telah terdata sebelumnya!',
            'stok.required' => 'Mohon isi kolom Stok!',
            'kategori_id.required' => 'Mohon isi kolom Kategori!',
            // 'harga_total.required' => 'Mohon isi kolom Harga Total!',
            'gambar.image' => 'Data yang di upload haruslah berupa file gambar!',

        ];

        $validasi = Validator::make($request->all(),$rules,$text);

        if($validasi->fails()){
            return response()->json(['success'=>0,'text' => $validasi->errors()->first()],422);
        }

        $periodeSebelumnya = Carbon::parse(now()->subMonth()->locale('id'));
        $periodeLaporanBarang = PeriodeLaporanBarang::where('bulan', now()->format('m'))
                                                            ->where('tahun', now()->format('Y'))
                                                            ->first();
        if($periodeLaporanBarang == ""){
            return response()->json(['success'=>0,'text'=>'Periode Laporan Bulan '.$periodeSebelumnya->translatedFormat('F').' Tahun '. $periodeSebelumnya->translatedFormat('Y'). ' belum ditutup!'], 442);
        }
        $gambar ='';
        if(! is_null ($request->gambar)){
            $gambar = $request->gambar->store('barangs');
        }
        $barang = Barang::create([
            'nomor_barang' => $request->nomor_barang,
            'nama_barang' => $request->nama_barang,
            'stok' => $request->stok,
            // 'harga_total' => "",
            'kategori_id' => $request->kategori_id,
            'satuan_id' => $request->satuan_id,
            'gambar' => $gambar,
        ]);

        LaporanBarang::create([
            'barang_id' => $barang->id,
            'saldo_awal' => '0',
            'periode_laporan_barang_id' => $periodeLaporanBarang->id
        ]);

        MutasiBarang::create([
            'stok_sebelumnya' =>'0',
            'masuk' => $request->stok,
            'barang_id' => $barang->id,
            'periode_laporan_barang_id' => $periodeLaporanBarang->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Barang::find($id)->load('kategori')->load('satuan');
        return response()->json($barang);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::find($id)->load('kategori')->load('satuan');
        return response()->json($barang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request){
        $barang = Barang::find($request->id);
        $data = $request->only(['nomor_barang','nama_barang','satuan_id','kategori_id','stok']);//,'harga_total']);        
        $gambar ='';
        if(! is_null ($request->gambar)){
            $gambar = $request->gambar->store('barangs');
            File::delete($request->gambar);
            $barang->deleteImage();
            $data['gambar'] = $gambar;
        }
        $barang->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->deleteImage();
        $barang->delete();
        return response()->json();
    }

    public function getSatuan(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data =Satuan::select("id","nama_satuan")
            		->where('nama_satuan','LIKE',"%$search%")
            		->get();
        }else{
            $data = Satuan::all();
        }
        return response()->json($data);

    }

    public function getKategori(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data =Kategori::select("id","nama")
            		->where('nama','LIKE',"%$search%")
            		->get();
        }else{
            $data = Kategori::all();
        }
        return response()->json($data);

    }

    public function getBarangPenyesuaian(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data =Barang::select("id","nama_barang")
            		->where('nama_barang','LIKE',"%$search%")
            		->get();
        }else{
            $data = Barang::all();
        }
        return response()->json($data);
    }

    public function tambahStok($id){
        $barang = Barang::find($id);
        return response()->json($barang);
    }

    public function updateTambahStok(Request $request){
        $periodeSebelumnya = Carbon::parse(now()->subMonth()->locale('id'));
        $periodeLaporanBarang = PeriodeLaporanBarang::where('bulan', now()->format('m'))
                                                            ->where('tahun', now()->format('Y'))
                                                            ->first();
        if($periodeLaporanBarang == ""){
            return response()->json(['success'=>0,'text'=>'Periode Laporan Bulan '.$periodeSebelumnya->translatedFormat('F').' Tahun '. $periodeSebelumnya->translatedFormat('Y'). ' belum ditutup!'], 422);
        }
        $barang = Barang::find($request->id);
        MutasiBarang::create([
            'stok_sebelumnya' =>$barang->stok,
            'masuk' => $request->masuk,
            'barang_id' => $request->id,
            'periode_laporan_barang_id' => $periodeLaporanBarang->id
        ]);
        $barang->update(["stok"=>$request->masuk + $barang->stok]);
        return response()->json();
    
    }
}
