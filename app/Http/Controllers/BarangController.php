<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
                    $url = asset('storage/barangs/'.$data->gambar);
                }
                return '<img src="'.$url.'" border="0" width="40" height="40" class="img-rounded"">';
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
                               <a class="dropdown-item" data-id="$data->id" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalEdit" onClick="editJenis(event.target)">Edit</a>
                               <a class="dropdown-item" data-id="$data->id" href="javascript:void(0);" onClick="deleteJenis(event.target)">Delete</a>
                           </div>
                       </div>
                       EOD;     
           })
           ->rawColumns(['gambar','kategori','action'])
           ->addIndexColumn()
           ->make(true);
       }
        return view('barang.index');
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
            'harga_satuan'=>'required',
            'kategori_id'=>'required',
            'gambar'=>'image'
        ];

        $text =[
            'nomor_barang.required' => 'Mohon isi kolom Nomor Barang!',
            'nomor_barang.required' => 'Mohon isi kolom Nama Barang!',
            'nomor_barang.unique' => 'Nomor Barang telah terdata sebelumnya!',
            'nomor_barang.unique' => 'Nama Barang telah terdata sebelumnya!',
            'stok.unique' => 'Mohon isi kolom Stok!',
            'harga_satuan.unique' => 'Mohon isi kolom Harga Satuan!',
            'kategori_id.unique' => 'Mohon isi kolom Kategori!',
            'gambar.image' => 'Data yang di upload haruslah berupa file gambar!',

        ];

        $validasi = Validator::make($request->all(),$rules,$text);

        if($validasi->fails()){
            return response()->json(['success'=>0,'text' => $validasi->errors()->first()],422);
        }

        $barang = new Barang;
        $barang->nomor_barang = $request->input('nomor_barang');
        $barang->nama_barang = $request->input('nama_barang');
        $barang->stok = $request->input('stok');
        $barang->harga_satuan = $request->input('harga_satuan');
        $barang->kategori_id = $request->input('kategori_id');
        if($request->hasFile('gambar')){
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $file->move('storage/barangs',$fileName);
            $barang->gambar = $fileName;
        }
        $barang->save();
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

    public function getJenis(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data =Jenis::select("id","nama")
            		->where('nama','LIKE',"%$search%")
            		->get();
        }else{
            $data = Kategori::all();
        }
        return response()->json($data);
            // ini berhasil

    }
}
