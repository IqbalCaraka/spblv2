<?php

namespace App\Http\Controllers;

use App\DokumenPenyerahan;
use App\TandaTangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class TandaTanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $peran = request()->segment(3);
        $transaksi_id = request()->segment(2);
        $dokumenPenyerahan = DokumenPenyerahan::where('transaksi_id', $transaksi_id)
                            ->first();     
        
        // $dokumenPenyerahan = DokumenPenyerahan::
        return view('tandatangan.index')->with('dokumenPenyerahan', $dokumenPenyerahan)->with('peran', $peran);
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
        $ttd = TandaTangan::where('user_id', Auth::user()->id)->first();
        $dokumenPenyerahan = DokumenPenyerahan::find($request->id);
        $kolom_update = 'ttd_'.$request->peran;
        // echo('hi');
        if($ttd == null){
            $folderPath = public_path('storage/ttd/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->ttd);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $image_name = Auth::user()->nip.'.'.$image_type;
            $file = $folderPath . $image_name;
            file_put_contents($file, $image_base64);

            $ttd = TandaTangan::create([
                'ttd' => 'ttd/'.$image_name,
                'user_id' => Auth::user()->id,
            ]);
            if($request->peran == "penyerah"){
                $dokumenPenyerahan->update([
                    $kolom_update => Auth::user()->id,
                    'penyerah' => Auth::user()->id
                ]);
            }else{
                $dokumenPenyerahan->update([
                    $kolom_update => Auth::user()->id,
                ]);
            }
        }else{
            $ttd->deleteImage();
            $folderPath = public_path('storage/ttd/');
            $image_parts = explode(";base64,", $request->ttd);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $image_name = Auth::user()->nip.'.'.$image_type;
            $file = $folderPath . $image_name;
            file_put_contents($file, $image_base64);

            if($request->peran == "penyerah"){
                $dokumenPenyerahan->update([
                    $kolom_update => Auth::user()->id,
                    'penyerah' => Auth::user()->id
                ]);
            }else{
                $dokumenPenyerahan->update([
                    $kolom_update => Auth::user()->id,
                ]);
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
        $dokumenPenyerahan = DokumenPenyerahan::find($request->id);
        $ttd = TandaTangan::where('user_id', Auth::user()->id)->first();
        $kolom_update = 'ttd_'.$request->peran;
        if($ttd == ""){
            return response()->json(['success'=>0,'text' => "Record tanda tangan Anda tidak ditemukan! Yuk, lakukan tanda tangan untuk yang pertama kali!"],422);
        }
        if($request->peran == "penyerah"){
            $dokumenPenyerahan->update([
                $kolom_update => Auth::user()->id,
                'penyerah' => Auth::user()->id
            ]);
        }else{
            $dokumenPenyerahan->update([
                $kolom_update => Auth::user()->id,
            ]);
        }
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
