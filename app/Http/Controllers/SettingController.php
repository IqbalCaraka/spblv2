<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id)->load('jabatan')
                                            ->load('bidang')
                                            ->load('peran');
        $title = "Setting";
        return view('pengguna.setting')->with('user', $user)->with('title',$title);
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
        $rules=[
            'password_lama' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ];

        $text=[
            'password_lama.required' => "Password lama harus diisi!",
            'password.required' => "Password baru harus diisi!",
            'password.min' => "Password baru minimal 8 karakter!",
            'password_confirmation.required' => "Konfirmasi password tidak sesuai!",
            'password.confirmed' => "Konfirmasi password tidak sesuai!",
            
        ];

        $validasi = Validator::make($request->all(),$rules,$text);

        if($validasi->fails()){
            return response()->json(['success'=>0,'text' => $validasi->errors()->first()],422);
        }

        if(!Hash::check($request->password_lama, Auth::user()->password)){
            return response()->json(['success'=>0,'text' => 'Password lama tidak sesuai!'],422);
        }

        User::find(Auth::user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json(['succes'=>1],200);
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
