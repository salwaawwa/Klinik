<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Produk;
use App\PesananDetail;

class DashboardController extends Controller
{
    
	public function index(){ 
		return view('dashboard.dashboard.index');
	}

	public function perhitungan($tglawal, $tglakhir){
		
		// dd(["Tanggal awal : ".$tglawal, 'Tanggal Akhirr :'.$tglakhir]);
		$perhitungan = PesananDetail::with('produk')->whereBetween('created_at',[$tglawal, $tglakhir])->get();
	
		$proo = $perhitungan->sum('pro');
		$kass = $perhitungan->sum('kas');
		return view('dashboard.dashboard.perhitungan-perperiode',compact('perhitungan','proo','kass'));
	}

}