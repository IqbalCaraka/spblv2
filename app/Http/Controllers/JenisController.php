<?php

namespace App\Http\Controllers;

use App\Jenis;
use App\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list_jenis = Jenis::all();
        if($request->ajax()){
            return datatables()->of($list_jenis)
            ->addColumn('jumlah_kategori', function($data){
                return $data->kategoris->count();
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
            ->rawColumns(['jumlah_kategori','action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('jenis.index');
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
            'nomor_jenis'=>'required|unique:jenis',
            'nama'=>'required|unique:jenis',
        ];

        $text =[
            'nomor_jenis.required' => 'Mohon isi kolom Nomor Jenis!',
            'nama.required' => 'Mohon isi kolom Nama Jenis!',
            'nomor_jenis.unique' => 'Nomor Jenis telah terdata sebelumnya!',
            'nama.unique' => 'Nama Jenis telah terdata sebelumnya!',
        ];

        $validasi = Validator::make($request->all(),$rules,$text);

        if($validasi->fails()){
            return response()->json(['success'=>0,'text' => $validasi->errors()->first()],422);
        }
        Jenis::create([
            'nomor_jenis' => $request->nomor_jenis,
            'nama' => $request->nama
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
        $jenis = Jenis::find($id);
        return response()->json($jenis);
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
            'nomor_jenis'=>'required',
            'nama'=>'required',
        ];

        $text =[
            'nomor_jenis.required' => 'Mohon isi kolom Nomor Jenis!',
            'nama.required' => 'Mohon isi kolom Nama Jenis!',
        ];

        $validasi = Validator::make($request->all(),$rules,$text);

        if($validasi->fails()){
            return response()->json(['success'=>0,'text' => $validasi->errors()->first()],422);
        }
        Jenis::where('id', $id)->update($request->all());
        return response()->json(Jenis::where('id', $id)->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenis = Jenis::find($id);
        if($jenis->kategoris->count() > 0){
            return response()->json(['success'=>0,'text'=>'Masih terdapat list kategori terkait!'], 442);
        }
        $jenis->delete();
        return response()->json();
    }
}
