<?php

namespace App\Http\Controllers;

use App\Keranjang;
use App\LaporanPengajuan;
use App\Transaksi;
use App\Barang;
use App\Bidang;
use App\DokumenPenyerahan;
use App\Jabatan;
use App\KeranjangBarangTidakTersedia;
use App\LaporanPengajuanBarangTidakTersedia;
use App\MutasiBarang;
use App\RiwayatTransaksi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $keranjangs = Keranjang::Where('user_id','=', Auth::user()->id)->get();
        $keranjang_barang_tidak_tersedias = KeranjangBarangTidakTersedia::where('user_id', Auth::user()->id)->get();

        $nomor_transaksi = '#'.now()->format('dmY').random_int(10000,99999);
        $transaksi = Transaksi::create([
            'nomor_transaksi'=> $nomor_transaksi,
            'user_id'=> Auth::user()->id,
            'status_id'=>1,
            'bidang_id'=> Auth::user()->bidang_id
        ]);
        RiwayatTransaksi::create([
            'transaksi_id'=> $transaksi->id,
            'user_id'=> Auth::user()->id,
            'status_id'=>1,
        ]);

        if($keranjangs->count() > 0){
            foreach($keranjangs as $keranjang){
                LaporanPengajuan::create([
                    'transaksi_id'=> $transaksi->id,
                    'barang_id'=> $keranjang->barang_id,
                    'jumlah_barang'=> $keranjang->jumlah_barang,
                    'status_item_pengajuan_id'=> '3'
                ]);
                $keranjang->delete();
            }
        }
        if($keranjang_barang_tidak_tersedias->count() > 0){
            foreach($keranjang_barang_tidak_tersedias as $keranjang_barang_tidak_tersedia){
                LaporanPengajuanBarangTidakTersedia::create([
                    'transaksi_id'=> $transaksi->id,
                    'nama_barang'=> $keranjang_barang_tidak_tersedia->nama_barang,
                    'jumlah_barang'=> $keranjang_barang_tidak_tersedia->jumlah_barang,
                    'satuan_id'=> $keranjang_barang_tidak_tersedia->satuan_id,
                    'status_item_pengajuan_id'=> '3'
                ]);
                $keranjang_barang_tidak_tersedia->delete();
            }
        }

        return response()->json(['success'=>1, 'text'=>$nomor_transaksi]);
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
        //ketika status proses dokumen
        if($request->status == 3){           
            //Pembuatan Dokumen Penyerahan
            $transaksi = Transaksi::where('id', $id)->first();
            $laporanPengajuan = LaporanPengajuan::where('transaksi_id', $transaksi->id)
                                                ->where('status_item_pengajuan_id', '1')
                                                ->get();
            if($laporanPengajuan->count() == '0'){
                $transaksi->update(['status_id'=> '4']);
                LaporanPengajuanBarangTidakTersedia::where('transaksi_id', '=', $id)->update(['status_item_pengajuan_id'=> '2']);
                RiwayatTransaksi::create([
                    'transaksi_id'=> $id,
                    'user_id'=> Auth::user()->id,
                    'status_id'=>'4',
                ]);
                return response()->json(['success'=>1,'text'=>'0']);
            }else{
                $penerima = User::where('id', $transaksi->user_id)->first();
                $bidang = Bidang::where('id', $penerima->bidang_id)->first();
                $kasub_umum = Jabatan::where('jabatan', 'like', '%Kepala Sub Bagian Umum%')->first();
                $administrator = Jabatan::where('jabatan', 'like', '%Kepala '.$bidang->bidang.'%')->first();
                
                $dokumenPenyerahan = DokumenPenyerahan::all()->last();
                if($dokumenPenyerahan == ""){
                    $nomor = '1';
                }
                elseif($dokumenPenyerahan->transaksi->created_at->format('Y')== now()->format('Y')){
                    $nomor = $dokumenPenyerahan->no_agenda;
                    $nomor = strtok($nomor, '/');
                    $nomor = $nomor+1;
                }else{
                    $nomor ='1';
                }
                $bulan = $this->convertBulanToRomawi($transaksi->created_at->format('m'));
                $no_agenda = $nomor.'/TU/PER/'.$bulan.'/'.$transaksi->created_at->format('Y');
                
                DokumenPenyerahan::create([
                    'no_agenda' => $no_agenda,
                    'kasub_umum' => $kasub_umum->user[0]->id,
                    'administrator'=> $administrator->user[0]->id,
                    'penerima' => $penerima->id,
                    'ttd_kasub_umum' => '0',
                    'ttd_administrator' => '0',
                    'ttd_penerima' => '0',
                    'ttd_penyerah' => '0',
                    'tgl_pengajuan' => $transaksi->created_at,
                    'transaksi_id'=>$transaksi->id
                ]);
            }

            //Menolak Pengajuan barang tidak tersedia apabila tidak disesuaikan
            LaporanPengajuanBarangTidakTersedia::where('transaksi_id','=',$id)
                                                ->where('status_item_pengajuan_id', '!=', '6' )
                                                ->update(['status_item_pengajuan_id'=>'2']);
        
        //Ketika status dari proses dokumen menjadi selesai
        } elseif($request->status == 5){
            $dokumenPenyerahan = DokumenPenyerahan::where('transaksi_id', $id)->first();
            if($dokumenPenyerahan->ttd_kasub_umum == "0"){
                return response()->json(['success'=>0,'text'=>'Kasubag Umum belum menandatangani dokumen!'], 442);
            }elseif($dokumenPenyerahan->ttd_administrator == "0"){
                return response()->json(['success'=>0,'text'=>'Administrator belum menandatangani dokumen!'], 442);
            }elseif($dokumenPenyerahan->ttd_penerima == "0"){
                return response()->json(['success'=>0,'text'=>'Penerima belum menandatangani dokumen!'], 442);
            }elseif($dokumenPenyerahan->ttd_penyerah == "0"){   
                return response()->json(['success'=>0,'text'=>'Penyerah belum menandatangani dokumen!'], 442);
            }   
            $dokumenPenyerahan->update(['tgl_penyerahan'=>now()]);
            $laporanPengajuan = LaporanPengajuan::with(['barang'])->where('transaksi_id','=',$id)->get();
            
            foreach ($laporanPengajuan as $item){
                if($item->status_item_pengajuan_id == "1"){
                    if($item->revisi_jumlah_barang == ""){
                        $jumlah_barang_terkonfirmasi = $item->jumlah_barang;
                    }else{
                        $jumlah_barang_terkonfirmasi = $item->revisi_jumlah_barang;
                    }
                    
                    MutasiBarang::create([
                        'barang_id'=> $item->barang_id,
                        'stok_sebelumnya' => $item->barang->stok,
                        'keluar' => $jumlah_barang_terkonfirmasi,
                    ]);

                    //Jika jumlah pengajuan barang kurang dari stok maka item pengajuan disetujui
                    if($jumlah_barang_terkonfirmasi <= $item->barang->stok){
                        Barang::where('id','=', $item->barang_id)->update(['stok'=>\DB::raw('stok-'.$jumlah_barang_terkonfirmasi)]);
                    //Jika jumlah pengajuan barang lebih dari stok maka item pengajuan ditolak
                    }else{
                        $item->status_item_pengajuan_id = "2";
                        $item->save();
                    }
                    

                }
            }


        }
        Transaksi::where('id', '=', $id)->update(['status_id'=> $request->status]);
        if($request->status == '2'){
            LaporanPengajuan::where('transaksi_id', '=', $id)->update(['status_item_pengajuan_id'=> '1']);
            LaporanPengajuanBarangTidakTersedia::where('transaksi_id', '=', $id)->update(['status_item_pengajuan_id'=> '4']);    
        }elseif($request->status == '4'){
            LaporanPengajuan::where('transaksi_id', '=', $id)->update(['status_item_pengajuan_id'=> '2']);
            LaporanPengajuanBarangTidakTersedia::where('transaksi_id', '=', $id)->update(['status_item_pengajuan_id'=> '2']);
        }
        elseif($request->status == '6') {
            LaporanPengajuan::where('transaksi_id', '=', $id)->update(['status_item_pengajuan_id'=> '5']);
            LaporanPengajuanBarangTidakTersedia::where('transaksi_id', '=', $id)->update(['status_item_pengajuan_id'=> '5']);
        }
        
        RiwayatTransaksi::create([
            'transaksi_id'=> $id,
            'user_id'=> Auth::user()->id,
            'status_id'=>$request->status,
        ]);
    }

    public function convertBulanToRomawi($bulan){
        switch ($bulan){
            case '01': 
                return "I";
                break;
            case '02':
                return "II";
                break;
            case '03':
                return "III";
                break;
            case '04':
                return "IV";
                break;
            case '05':
                return "V";
                break;
            case '06':
                return "VI";
                break;
            case '07':
                return "VII";
                break;
            case '08':
                return "VIII";
                break;
            case '09':
                return "IX";
                break;
            case '10':
                return "X";
                break;
            case '11':
                return "XI";
                break;
            case '12':
                return "XII";
                break;
        };
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
