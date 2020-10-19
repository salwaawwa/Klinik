@extends('layouts.admin-theme')
@section('title','Confirm Transaksi')
@section('content')

	   <div class="row sortable-card">
              	<div class="col-12 col-md-12 col-lg-12">
	                <div class="card card-primary">

	                  <div class="card-header">
	                    <h4>Nota</h4>
	                  </div>

	                  <div class="card-body">

	                  	<div class="row">
	                  		<div class="col-md-6">
			                    <h5>KLINIK SPESIALIS UROLOGI</h5>
			                    <h6>dr. Ginanda Putra Siregar, SpU</h6>
	                  		</div>

	                  		<div class="col-md-6">
	                  			 <p style="padding-left:190px;">
	                  			 	@if($pesanan)
	                  			 		Jakarta, {{$pesanan->tanggal}}<br>
				                   		No. Nota : {{$pesanan->nota}}
				                   	@else
				                   		Jakarta, <br>
				                   		No. Nota :
				                   	@endif

				                </p>
	                  		</div>
	                  	</div>

	                   <div class="col-ld-4">

	                  		<table class="table">
	                  			<thead>
	                  				<tr align="center">
	                  					<th>No</th>
	                  					<th>Nama Produk</th>
	                  					<th>Harga</th>
	                  					<th>Jumlah</th>
	                  					<th>Jumlah Harga</th>
	                  				</tr>
	                  			</thead>
	                  			@php
		                            $no = 1;
		                        @endphp
		                        @foreach ($pesanan_details as $pesanan_detail)
		                        <tbody>
		                           <tr>
		                                <td align="center">{{$no++}}</td>  
		                                <td>{{$pesanan_detail->produk->nama_tindakan}}</td>
		                                <td>{{Awa::Rupiah($pesanan_detail->produk->harga)}}</td>
		                                <td align="center">{{$pesanan_detail->banyak}}</td>
		                                <td>{{Awa::Rupiah($pesanan_detail->jumlah_harga)}}</td>
		                           </tr> 
		                        </tbody>    
		                        @endforeach
		                         <tr>
			                          <td colspan="4" align="right"><strong>Total Harga : </strong></td>
			                          @if($pesanan)
			                          	<td align="left"> {{ Awa::Rupiah($pesanan->total_harga)}} </td>
			                          @else
			                          	<td> </td>
			                          @endif
			                      </tr>
			                      <tr>
			                      	<td colspan="4" align="right"><strong>Bayar : </strong> </td>
			                        <td aign="left"> {{ Awa::Rupiah($pesanan->bayar)}}</td>
			                      </tr>
			                      <tr>
			                      	<td colspan="4" align="right"><strong>Kembalian : </strong> </td>
			                        <td aign="left"> {{ Awa::Rupiah($pesanan->kembalian)}}</td>
			                      </tr>
	                  		</table>
	                  		
	                  		  	<a href="{{route('transaksi.create')}}" class="btn btn-outline-primary float-left">Kembali</a>
	                			<a href="{{route('transaksi.cetakdet', $pesanan->id)}}" class="btn btn-primary float-right">Cetak</a>

	                    </div>

	                  </div>
	                </div>
            	</div>
            </div>  
	
@endsection