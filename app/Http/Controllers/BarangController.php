<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;

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
                $url = asset('storage/barangs/'.$data->gambar);
                return '<img src="'.$url.'" border="0" width="40" class="img-rounded"">';
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
           ->rawColumns(['gambar','action'])
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
        // $gambar = $request->gambar->store('barangs');
        // Barang::create([
        //     'nama_barang' => $request->nama_barang,
        //     'gambar' => $gambar
        // ]);

        // return redirect(route('barang.index'));
        $barang = new Barang;
        $barang->nama_barang = $request->input('nama_barang');
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
}
