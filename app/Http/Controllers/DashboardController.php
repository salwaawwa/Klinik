<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Produk;
use DB;

class DashboardController extends Controller
{
    
	public function index(){ 
		// Request $request
		// $dari = $request->dari;
		// $sampai = $request->sampai;
		// $data = DB::table('produks')
		// ->whereBetween('created_at', [$dari, $sampai])
		// ->selectRaw('sum(kas_masuk)')
		// ->selectRaw('sum(profit)')
		// ->selectRaw('id')
		// ->groupBy('id')
		// ->get();
		return view('dashboard.dashboard.index');
	}

	// public function show(){ 

		

	// 	return view('dashboard.index',compact('data'));
	// }

	// public function store(Request $request){
	// 	\Validator::make($request->all(), [
 //            'dari'  => 'required|date',
 //            'sampai' => 'required|date'
 //        ])->validate();

 //        $data = Data::create($request->all());

 //        return redirect()->route('dashboard.index');

	// }

	// public function data(){
 //    	$data = Data::all();

 //        return DataTables::of($data)
 //                        ->addIndexColumn()
 //                        ->editColumn('bulan', function($item) {
 //                            $nama = $item->bulan.'<br>';
 //                            // $edit = '<a href="'. route('produk.edit', $item->slug).'">Edit</a> ';
 //                            // $delete = '<a href="javascript:void(0)" onclick="myConfirm('.$item->id.')">Delete</a> ';
 //                            return $nama;
 //                        })
 //                        ->escapeColumns([])
 //                        ->make(true);
 //    }

}
