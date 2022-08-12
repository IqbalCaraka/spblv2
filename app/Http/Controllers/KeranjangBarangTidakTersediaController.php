<?php

namespace App\Http\Controllers;

use App\KeranjangBarangTidakTersedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KeranjangBarangTidakTersediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keranjang = KeranjangBarangTidakTersedia::where('user_id', Auth::user()->id)->get();
        if($request->ajax()){
            return datatables()->of($keranjang)
            ->addColumn('satuan', function($data){
                return $data->satuan->nama_satuan;
            })
            ->addColumn('action', function($data){
                return <<<EOD
                        <div class="row d-inline-flex justify-content-start">
                            <div class="col aksi">
                                <button class="btn btn-sm btn-outline-primary btn-check-out" data-id="$data->id" data-bs-toggle="modal" data-bs-target="#modalKeranjang" onclick="editKeranjangBarangTidakTersedia(event.target)">
                                    Edit
                                </button>
                                <button class="btn btn-sm btn-outline-danger btn-check-out" data-id="$data->id" onclick="hapusKeranjangBarangTidakTersedia(event.target)">
                                    Hapus
                                </button>
                            </div>
                        </div>
                        EOD;  
            })
            ->rawColumns(['satuan','action'])
            ->addIndexColumn()
            ->make(true);
        }

        return response()->json($keranjang);
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
            'nama_barang'=>'required',
            'jumlah_barang'=>'required',
            'satuan_id'=>'required'
        ];

        $text =[
            'nama_barang.required' => 'Mohon isi kolom Nama Barang!',
            'jumlah_barang.required' => 'Mohon isi kolom Jumlah Pengajuan!',
            'satuan_id.required' => 'Mohon isi kolom Satuan!',

        ];

        $validasi = Validator::make($request->all(),$rules,$text);

        if($validasi->fails()){
            return response()->json(['success'=>0,'text' => $validasi->errors()->first()],422);
        }
        KeranjangBarangTidakTersedia::create([
            'nama_barang'=>$request->nama_barang,
            'jumlah_barang'=>$request->jumlah_barang,
            'satuan_id'=> $request->satuan_id,
            'user_id'=> Auth::user()->id
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
        $keranjang = KeranjangBarangTidakTersedia::find($id)->load('satuan');
        return response()->json($keranjang);

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
            'jumlah_barang'=>'required',
            'satuan_id'=>'required'
        ];

        $text =[
            'jumlah_barang.required' => 'Mohon isi kolom Jumlah Pengajuan!',
            'satuan_id.required' => 'Mohon isi kolom Satuan!',

        ];

        $validasi = Validator::make($request->all(),$rules,$text);

        if($validasi->fails()){
            return response()->json(['success'=>0,'text' => $validasi->errors()->first()],422);
        }

        KeranjangBarangTidakTersedia::where('id', $id)->update($request->all());
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
        $keranjang = KeranjangBarangTidakTersedia::find($id);
        $keranjang->delete();
    }
}
