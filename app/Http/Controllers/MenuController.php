<?php

namespace App\Http\Controllers;

use App\Barang;
use DB;
use App\Kategori;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengguna.menu');
        // $barangs = new Barang();
        // $barangs = $barangs->getAllBarang();
        // return view('layouts.menu', compact('barangs'));

        // Search V2
        // $barangs = new Barang();
        // $barangs = $barangs->getAllBarang();
        // if ($request->ajax()) {
        //     return view('partials.menuLoadBarang', ['barangs' => $barangs])->render();  
  
        // }
        // return view('layouts.menu', compact('barangs'));
        

        // Live search ajax V1
        // $barang = new Barang();
        // $barang = $barang->getAllBarang();
        // // echo $barang;
        // if($request->ajax()){
        //     return response()->json([
        //         'success' => true,
        //         'barang' => $barang,
        //         'pagination' => $barang->links()
        //     ]);
        // }
        // return view("layouts.menu");
 
    }

    // public function search (Request $request){
    //     if ($request->ajax()) {
    //         $query = $request->get('query');
    //         $query = str_replace(" ", "%", $query);
    //         $data = DB::table('barangs')
    //             ->Where('nama_barang','LIKE', '%'.$query.'%')
    //             ->paginate(3);
    //         return view('partials.menuLoadBarang', compact('data'))->render;
    //     }

    //     // if ($request->ajax()) {
    //     //     $barangs = new Barang();
    //     //     $inputSearch = $request->get('inputSearch');
    //     //     $barangs = $barangs->getBarang($inputSearch);
    //     //     return view('partials.menuLoadBarang', ['barangs' => $barangs])->render();
    //     // }

    //     //Live Search V.2
    //     // if ($request->ajax()) {
    //     //     $barangs = new Barang();
    //     //     $inputSearch = $request['inputSearch'];
    //     //     $barangs = $barangs->getBarang($inputSearch);
    //     //     return view('partials.menuLoadBarang', ['barangs' => $barangs])->render();
    //     // }
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
