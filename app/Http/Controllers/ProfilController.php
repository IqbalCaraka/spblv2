<?php

namespace App\Http\Controllers;

use App\Bidang;
use App\Jabatan;
use App\Peran;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::all();
        if($request->ajax()){
            return datatables()->of($user)
            ->addColumn('nip', function($data){
                // $nip = $data->nip;
                return $data->nip;
                // return response()->json($nip.toString());
            })
            ->addColumn('jabatan', function($data){
                return $data->jabatan ->jabatan;
            })
            ->addColumn('bidang', function($data){
                return $data->bidang->bidang;
            })
            ->addColumn('peran', function($data){
                return $data->peran->peran;
            })
            ->addColumn('action', function($data){
                return <<<EOD
                            <div class="dropdown" style="text-align: center;">
                                <button class="btn btn-sm btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                    <a class="dropdown-item" data-id="$data->id" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalEdit" onClick="editProfil(event.target)">Edit</a>
                                    <a class="dropdown-item" data-id="$data->id" href="javascript:void(0);" onClick="hapusProfil(event.target)">Hapus</a>
                                </div>
                            </div>
                        EOD;
            })
            
            ->rawColumns(['jabatan','bidang', 'peran', 'action'])
            ->addIndexColumn()
            ->make(true);
        }
        $title = "Atur Profil";
        return view('profil.index')->with('title', $title);
    }

    public function getJabatan(Request $request){
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data =Jabatan::select("id","jabatan")
            		->where('jabatan','LIKE',"%$search%")
            		->get();
        }else{
            $data = Jabatan::all();
        }
        return response()->json($data);
    }

    public function getBidang(Request $request){
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data =Bidang::select("id","bidang")
            		->where('bidang','LIKE',"%$search%")
            		->get();
        }else{
            $data = Bidang::all();
        }
        return response()->json($data);
    }

    public function getPeran(Request $request){
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            if(Auth::user()->peran_id == '1'){
                $data =Peran::select("id","peran")
                        ->where('peran','LIKE',"%$search%")
                        ->get();
            }else{
                $data =Peran::select("id","peran")
                        ->where('peran','LIKE',"%$search%")
                        ->where('id', '!=', '1')
                        ->where('id', '!=', '2')
                        ->get();
            }
        }else{
            if(Auth::user()->peran_id == '1'){
                $data = Peran::all();
            }else{
                $data = Peran::where('id','!=','1')
                                ->where('id', '!=', '2')
                                ->get();
            }
        }
        return response()->json($data);
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
            'nip' => 'required|unique:users', 
            'name' => 'required|max:255',
            'email' => 'email|max:255',
            'jabatan_id' => 'required',
            'peran_id' => 'required',
            'bidang_id' => 'required',
        ];

        $text =[
            'nip.unique' => 'NIP telah tercatat sebelumnya!',
            'nip.required' => 'NIP harus diisi!',
            'name.required' => 'Nama harus diisi!',
            'name.max' => 'Nama maximal 255 karakter!',
            'email.required' => 'Email harus diisi!',
            'email.max' => 'Email maximal 255 karakter!',
            'jabatan_id.required' => 'Jabatan harus diisi!',
            'peran_id.required' => 'Peran harus diisi!',
            'bidang_id.required' => 'Bidang harus diisi!',
        ];

        $validasi = Validator::make($request->all(),$rules,$text);

        if($validasi->fails()){
            return response()->json(['success'=>0,'text' => $validasi->errors()->first()],422);
        }
        $password = $request->nip;
        $password = substr($password, 0,8);

        User::create([
            'nip' => $request->nip,
            'name' => $request->name,
            'peran_id' => $request->peran_id,
            'bidang_id' => $request->bidang_id,
            'jabatan_id' => $request->jabatan_id,
            'password' => Hash::make($password),
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
        $user = User::find($id)->load('jabatan')
                                ->load('bidang')
                                ->load('peran');
        return response()->json($user);
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
        // $rules =[
        //     'id' => 'required', 
        //     'name' => 'required|max:255',
        //     'jabatan_id' => 'required',
        //     'peran_id' => 'required',
        //     'bidang_id' => 'required',
        // ];

        // $text =[
        //     'id.required' => 'NIP harus diisi!',
        //     'name.required' => 'Nama harus diisi!',
        //     'name.max' => 'Nama maximal 255 karakter!',
        //     'jabatan_id.required' => 'Jabatan harus diisi!',
        //     'peran_id.required' => 'Peran harus diisi!',
        //     'bidang_id.required' => 'Bidang harus diisi!',
        // ];

        // $validasi = Validator::make($request->all(),$rules,$text);

        // if($validasi->fails()){
        //     return response()->json(['success'=>0,'text' => $validasi->errors()->first()],422);
        // }

        // return response()->json($request->jabatan_id);
        
        User::where('id', $id)->update($request->all());
        // $data = $request->only(['id','name','jabatan_id','peran_id','bidang_id']); 
        // $user->update($data);
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
