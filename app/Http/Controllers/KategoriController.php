<?php

namespace App\Http\Controllers;

use App\Jenis;
use App\Kategori;
//use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list_kategori = Kategori::all();
         if($request->ajax()){
            return datatables()->of($list_kategori)
            ->addColumn('jenis', function($data){
                return $data->jenis->nama;
            })
            ->addColumn('jumlah_barang', function($data){
                return $data->barang->count();
            })
            ->addColumn('action', function($data){
                return <<<EOD
                    <div class="dropdown" style="text-align: center;">
                    <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                        <a class="dropdown-item" data-id="$data->id" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalEdit" onClick="editKategori(event.target)">Edit</a>
                        <a class="dropdown-item" data-id="$data->id" href="javascript:void(0);" onClick="deleteKetegori(event.target)">Delete</a>
                    </div>
                </div>
                EOD;
            })
            ->rawColumns(['jenis','jumlah_barang','action' ])
            ->addIndexColumn()
            ->make(true);
        }
        return view('kategori.index');
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
            'nomor_kategori'=>'required|unique:kategoris',
            'nama'=>'required|unique:kategoris',
            'jenis_id'=>'required'
        ];

        $text =[
            'nomor_kategori.required' => 'Mohon isi kolom Nomor Ketegori!',
            'nama.required' => 'Mohon isi kolom Nama Ketegori!',
            'jenis_id.required' => 'Mohon isi kolom Jenis!',
            'nomor_kategori.unique' => 'Nomor Ketegori telah terdata sebelumnya!',
            'nama.unique' => 'Nama Ketegori telah terdata sebelumnya!',
        ];

        $validasi = Validator::make($request->all(),$rules,$text);

        if($validasi->fails()){
            return response()->json(['success'=>0,'text' => $validasi->errors()->first()],422);
        }
        Kategori::create([
            'nomor_kategori' => $request->nomor_kategori,
            'nama' => $request->nama,
            'jenis_id' => $request->jenis_id
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
        $kategori = Kategori::find($id)->load('jenis');
        return response()->json($kategori);
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
        $rules =[
            'nomor_kategori'=>'required',
            'nama'=>'required',
            'jenis_id'=>'required',
        ];

        $text =[
            'nomor_kategori.required' => 'Mohon isi kolom Nomor Kategori!',
            'nama.required' => 'Mohon isi kolom Nama!',
            'jenis_id.required' => 'Mohon isi kolom Jenis',
        ];

        $validasi = Validator::make($request->all(),$rules,$text);
        if($validasi->fails()){
            return response()->json(['success'=>0,'text' => $validasi->errors()->first()],422);
        }
        Kategori::where('id', $id)->update($request->all());
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
        return response()->json();
    }

    public function getJenis(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data =Jenis::select("id","nama")
            		->where('nama','LIKE',"%$search%")
            		->get();
        }else{
            $data = Jenis::all();
        }
        return response()->json($data);
            // ini berhasil

    }
}
