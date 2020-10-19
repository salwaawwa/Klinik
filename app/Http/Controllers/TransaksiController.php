<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Produk;
use App\Pesanan;
use App\PesananDetail;
use App\User;
use Auth;
use Str;
use Carbon\Carbon;
use DataTables;

class TransaksiController extends Controller
{
    public function index(){
    	return view('dashboard.transaksi.index');
    }

    public function create(){ 

    	$produk = Produk::all();

        $pesanan = Pesanan::where('user_id',  Auth::user()->id)->where('status',0)->first();
        if(!empty($pesanan))
        {
            $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();
        }
        else{
            $pesanan_details = PesananDetail::where('pesanan_id',null)->get();
        }

    	return view('dashboard.transaksi.create',compact('produk','pesanan','pesanan_details'));
    }

    public function store(Request $request){


         \Validator::make($request->all(), [
            'banyak'  => 'required'
        ])->validate();

    	$latest = Pesanan::latest()->first();

        if (! $latest || !$latest->nota) {
           $nota = 'N00001';
        }
        else{
            $string = preg_replace("/[^0-9\.]/", '', $latest->nota);
            $nota = 'N' . sprintf('%04d', $string+1);
        }

        // Deskripsi ID
        $produk = Produk::findOrFail($request->produk_id);
        $tanggal = Carbon::now();

        if($produk->stok === 0)
        {
            return redirect()->route('transaksi.create')->with('info','Stok Sedang Habis');
        }elseif($request->banyak > $produk->stok){
            return redirect()->route('transaksi.create')->with('info','Qty Melebihi Stok. Stok tersisa: ' .$produk->stok);
        }

        // Cek Validasi
        $cek_pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status',0)->first();

         if(empty($cek_pesanan)){
         	$transaksi = Pesanan::create([
	            'user_id' => Auth::user()->id,
	            'tanggal' => $tanggal,
	            'total_harga' => 0,
	            'nota' => $nota,
	            'status' => 0
	        ]);
         }

        $produk->update([
            'stok' => $produk->stok - $request->banyak,
        ]);

         // Simpan Ke DB Pesanan Detail
        $pesanan_baru = Pesanan::where('user_id',Auth::user()->id)->where('status',0)->first();

         // Cek Pesanan Detail
        $cek_pesanan_detail = PesananDetail::where('produk_id',$produk->id)->where('pesanan_id',
                              $pesanan_baru->id)->first();

        $jumlah_harga = $produk->harga * $request->banyak;

        if(empty($cek_pesanan_detail)){
        	$transaksi_det = PesananDetail::create([
	            'produk_id' => $produk->id,
	            'pesanan_id' => $pesanan_baru->id,
	            'banyak' => $request->banyak,
	            'nota' =>  isset($transaksi) ? $transaksi->nota : $cek_pesanan->nota,
	            'jumlah_harga' => $jumlah_harga,
	        ]);
        } else{
            $pesanan_detail = PesananDetail::where('produk_id',$produk->id)->where('pesanan_id',$pesanan_baru->id)->first();

            $pesanan_detail->banyak = $pesanan_detail->banyak+$request->banyak;

            // Harga Sekarang
            $harga_pesan_detail_baru = $produk->harga * $request->banyak;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga+ $harga_pesan_detail_baru;
            $pesanan_detail->update();
        }

        //jumlah Total
         $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
         $pesanan->total_harga = $pesanan->total_harga+$produk->harga * $request->banyak;
         $pesanan->update();

        return redirect()->route('transaksi.create');
    }

     public function show($id)
    {
        $user = user::where('id', Auth::user()->id)->first();
        $pesanan = Pesanan::findOrFail($id);
        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();

        return view('dashboard.transaksi.show',compact('pesanan','pesanan_details','user'));
    }

    public function print(){
        $cetak = PesananDetail::all();
        return view('dashboard.transaksi.print',compact('cetak'));
    }

    public function confirm(Request $request){
       
        $user = user::where('id', Auth::user()->id)->first();
        $pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status',0)->first();

        if($pesanan){

            $pesanan_id = $pesanan->id;
            $pesanan->status = 1;
            $pesanan->update();
            // $pesanan->bayar = $request->uang_bayar;

            //     if($request->uang_bayar === NULL){
            //        return redirect()->route('transaksi.create')->with('primary','Silahkan Masukan Uang Bayar');
            //     }elseif($request->uang_bayar < $pesanan->total_harga){
            //         return redirect()->route('transaksi.create')->with('primary','Uang Bayar Kurang');
            //     }

            

            $pesanan_details = PesananDetail::where('pesanan_id',$pesanan_id)->get();
            foreach($pesanan_details as $pesanan_detail)
            {
                $produk = Produk::find($pesanan_detail->produk_id);
                $terjual = $produk->terjual + $pesanan_detail->banyak;
                $kas_masuk = $produk->harga * $terjual;
                $profit = $kas_masuk - ($produk->harga_beli * $terjual);
                $produk->update([
                        'terjual' => $terjual,
                        'kas_masuk' => $kas_masuk,
                        'profit' => $profit
                    ]);
            }

            return view('dashboard.transaksi.confirm',compact('pesanan','pesanan_details'));

        }else{
            return redirect()->route('transaksi.create')->with('primary','Belum ada Pesanan');
        }

    }

    public function cetakDetail($id){
        $user = user::where('id', Auth::user()->id)->first();
        $pesanan = Pesanan::where('id',$id)->first();
        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();

        return view('dashboard.transaksi.cetak-detail',compact('pesanan','pesanan_details','user'));
    }


     public function destroy($slug){
        $transaksi = Pesanan::find($slug);
        $detail = PesananDetail::where('nota', $transaksi->nota)->get();

        try{
            //Kalo sukses
            $ids = [];
            foreach($detail as $item){
                array_push($ids,[
                    $item->id,
                ]);
            }

            PesananDetail::destroy($ids);
            $transaksi->delete();
            return response()->json([
                'status' => true,
                'pesan'  => 'Transaksi berhasil di hapus'
            ]);

        }catch(\throwable $th) {
            //Kalo error
            throw $th;
             return response()->json([
                'status' => false,
                'pesan'  => 'Transaksi gagal di hapus'
            ]);
        }
      
        //return $slug;
        // if ($transaksi) {
        //     $transaksi->delete();
            // return response()->json([
            //     'status' => true,
            //     'pesan'  => 'Transaksi berhasil di hapus'
            // ]);
        // } else {
            // return response()->json([
            //     'status' => false,
            //     'pesan'  => 'Transaksi gagal di hapus'
            // ]);
        // }
    }

    public function data(){
        $data = Pesanan::all();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->editColumn('nota', function($item) {
                            $nama = $item->nota.'<br>';
                            $delete = '<a href="javascript:void(0)" onclick="myConfirm('.$item->id.')">Delete</a> ';
                            $show = '<a href="'.route("transaksi.show" , $item->id).'">Show</a> ' ;
                            return $nama.$delete.$show;
                        })
                        ->editColumn('total_harga', function($item){
                                return \Awa::Rupiah($item->total_harga);
                        })
                        ->editColumn('status', function($item){
                            if($item->status == 1){
                                return 'Sudah Bayar';
                            }else{
                                return 'Belum Bayar';
                            }
                        })
                        ->escapeColumns([])
                        ->make(true);

    }

}
