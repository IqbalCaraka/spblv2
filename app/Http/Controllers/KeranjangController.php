<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Keranjang;
use App\KeranjangBarangTidakTersedia;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keranjang_barang_tidak_tersedia = KeranjangBarangTidakTersedia::where('user_id', Auth::user()->id)->get();
        $keranjangs = new Keranjang();
        $keranjangs = $keranjangs->getKeranjang();
        if($request->ajax()){
            return response()->json([
                'success'=>true,
                'keranjangs'=>$keranjangs,
                'keranjang_barang_tidak_tersedia'=>$keranjang_barang_tidak_tersedia
            ]);
        }
        $title = "Keranjang";
        return view ('pengguna.keranjang')->with('keranjangs', $keranjangs)
                                            ->with('keranjang_barang_tidak_tersedia', $keranjang_barang_tidak_tersedia)
                                            ->with('title',$title);
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
        $text = 'Jumlah permintaan sudah melebihi stok!';
        $keranjang = new Keranjang();
        $keranjang = $keranjang->getCekKeranjang($request);
        if($keranjang === null){
            Keranjang::create([
                'barang_id'=>$request->barang_id,
                'user_id'=>$request->user_id,
                'jumlah_barang'=> $request->jumlah_barang
            ]);
            return response()->json(['success'=>true],200);
        }else{  
            //cek apakah pengajuan barang tidak melebihi stok
            // if($keranjang->jumlah_barang < $keranjang->barang->stok && $request->jumlah_barang == 1){
            //     Keranjang::where('id', $keranjang->id)->update(['jumlah_barang' =>\DB::raw('jumlah_barang+1')]);
            // }elseif($keranjang->jumlah_barang == 1 ){
            //     return response()->json(['success'=>false],442);
            // }
            if($request->jumlah_barang == 1 ){
                Keranjang::where('id', $keranjang->id)->update(['jumlah_barang' =>\DB::raw('jumlah_barang+1')]);
            }elseif($keranjang->jumlah_barang == 1 ){
                return response()->json(['success'=>false],442);
            }
            elseif($request->jumlah_barang == -1){
                Keranjang::where('id', $keranjang->id)->update(['jumlah_barang' =>\DB::raw('jumlah_barang-1')]);
            }
            else{
                return response()->json(['success'=>false,$text],442);
            }
        }
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
        $keranjang = Keranjang::find($id);
        $keranjang->delete();
    }
}
