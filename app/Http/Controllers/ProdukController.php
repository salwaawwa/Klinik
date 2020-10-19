<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Produk;
use Str;
use DataTables;

class ProdukController extends Controller
{
    public function index(){
    	
    	return view('dashboard.produk.index');
    }

    public function create(){
    	return view('dashboard.produk.create_edit');
    }

    public function store(Request $request)
    {

        \Validator::make($request->all(), [
            'nama_tindakan'  => 'required|',
            'harga_beli' => 'required|numeric',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ])->validate();

        $slug = Str::of($request->nama_tindakan)->slug('-');
        $request->merge([
            'slug'=>$slug,
            'terjual' => 0,
            'profit' => 0,
            'kas_masuk' => 0,
            ]);

        $produk = Produk::create($request->all());
        if($produk){
            return redirect()->route('produk.index');
        } else{
            return back();
        }
    }

    public function edit($slug){
        $produk = Produk::where('slug', $slug)->first();
        if(!$produk){
            abort(404);
        }
        return view('dashboard.produk.create_edit',compact('produk'));
    }

    public function update(Request $request, $slug){
    	$produk = Produk::whereSlug($slug)->first();
        if($produk){
            $slug = Str::of($request->nama_produk)->slug('-');
            $request->merge(['slug'=>$slug]);
            $produk->update($request->all());
            return redirect()->route('produk.index');
        }else{
            return redirect()->route('produk.edit',$slug);
        }
    }

    public function show(){
        return view('dashboard.produk.show');
    }

    public function print(){
        $cetak = Produk::all();
        return view('dashboard.produk.print',compact('cetak'));
    }

    public function destroy($slug){
    	$produk = Produk::find($slug);
        //return $slug;
        if ($produk) {
            $produk->delete();
            return response()->json([
                'status' => true,
                'pesan'  => 'Produk berhasil di hapus'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'pesan'  => 'Produk gagal di hapus'
            ]);
        }
    }

    public function data(){
    	$data = Produk::all();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->editColumn('nama_tindakan', function($item) {
                            $nama = $item->nama_tindakan.'<br>';
                            $edit = '<a href="'. route('produk.edit', $item->slug).'">Edit</a> ';
                            $delete = '<a href="javascript:void(0)" onclick="myConfirm('.$item->id.')">Delete</a> ';
                            return $nama.$edit.$delete;
                        })
                        ->editColumn('harga', function($item) {
                           return \Awa::Rupiah($item->harga);
                        })
                        ->editColumn('harga_beli', function($item) {
                            if($item->harga_beli == 0)
                                return $item->harga_beli;
                            else
                                return \Awa::Rupiah($item->harga_beli);
                        })
                        ->editColumn('kas_masuk', function($item) {
                            if($item->kas_masuk == 0)
                                return $item->kas_masuk;
                            else
                                return \Awa::Rupiah($item->kas_masuk);
                        })
                         ->editColumn('profit', function($item) {
                            if($item->profit == 0)
                                return $item->profit;
                            else
                                return \Awa::Rupiah($item->profit);
                        })
                        ->escapeColumns([])
                        ->make(true);
    }

}
