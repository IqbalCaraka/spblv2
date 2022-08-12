<?php

namespace App\Http\Controllers;

use App\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $satuan = Satuan::all();
        if($request->ajax()){
            return datatables()->of($satuan)
            ->addColumn('action', function($data){
                return <<<EOD
                        <div class="dropdown" style="text-align: center;">
                            <button class="btn btn-sm btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                <a class="dropdown-item" data-id="$data->id" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalEdit" onClick="editSatuan(event.target)">Edit</a>
                                <a class="dropdown-item" data-id="$data->id" href="javascript:void(0);" onClick="deleteSatuan(event.target)">Delete</a>
                            </div>
                        </div>
                        EOD;     
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $title = "Satuan";
        return view('satuan.index')->with('title', $title);;
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
            'nama_satuan'=>'required|unique:satuans',
        ];

        $text =[
            'nama_satuan.required' => 'Mohon isi kolom Nama Satuan!',
            'nama_satuan.unique' => 'Nama Satuan telah terdata sebelumnya!',
        ];

        $validasi = Validator::make($request->all(),$rules,$text);

        if($validasi->fails()){
            return response()->json(['success'=>0,'text' => $validasi->errors()->first()],422);
        }

        Satuan::create([
            'nama_satuan'=>$request->nama_satuan
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $satuan = Satuan::find($id);
        return response()->json($satuan);
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
            'nama_satuan'=>'required',
        ];

        $text =[
            'nama_satuan.required' => 'Mohon isi kolom Nama Satuan!'
        ];

        $validasi = Validator::make($request->all(),$rules,$text);

        if($validasi->fails()){
            return response()->json(['success'=>0,'text' => $validasi->errors()->first()],422);
        }

        Satuan::where('id', $id)->update($request->all());
        return response()->json(['success'=>1],200);
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
