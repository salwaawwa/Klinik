@extends('layouts.admin-theme')
@section('title','Create Transaksi')
@section('content')

	<section class="section">

		<div class="section-header">
			<h1>Create Transaksi</h1>
		</div>

		<div class="section-body">

			<div class="row sortable-card">
              	<div class="col-12 col-md-12 col-lg-12">
	                <div class="card card-primary">

	                  <div class="card-header">
	                    <h4>Create Transaksi</h4>
	                  </div>

	                  <div class="card-body">

	                  	@if(session()->has('info'))
	                        <div class="alert alert-primary">
	                            {{ session()->get('info') }}
	                        </div>
                    	@endif

	                    <div class="col-ld-4">

	                    	<form action="{{route('transaksi.store') }}" method="POST" enctype="multipart/form-data">
	                  			@csrf

	                  			<div class="form-group">
                                    <label for="">Tindakan / Obat</label>
                                    <select name="produk_id" id="" class="form-control select2">
                                        @foreach ($produk as $item)
                                    <option value="{{$item->id}}">{{$item->nama_tindakan}}  ({{Awa::Rupiah($item->harga)}})</option>
                                        @endforeach
                                    </select>
                                </div>  

                        		<div class="form-group">
                                    <label for="">Qty</label>
                                    <input type="number" name="banyak" class="form-control {{$errors->has('banyak') ? 'is-invalid' : ' '}}" >

                                    @if($errors->has('banyak'))
		                  				<div class="invalid-feedback">
		                  					{{$errors->first('banyak')}}
		                  				</div>
		                  			@endif

                                </div>
        
		                  		<button type="submit" class="btn btn-primary">Add</button>

	                  		</form>

	                    </div>

	                  </div>

	                </div>
            	</div>
            </div>

            <div class="row sortable-card">
              	<div class="col-12 col-md-12 col-lg-12">
	                <div class="card card-primary">

	                  <div class="card-header">
	                    <h4>Transaksi</h4>
	                  </div>

	                  <div class="card-body">

	                  	@if(session()->has('primary'))
	                        <div class="alert alert-primary">
	                            {{ session()->get('primary') }}
	                        </div>
                    	@endif


	                  	<div class="row">
	                  		<div class="col-md-6">
			                    <h5>KLINIK SPESIALIS UROLOGI</h5>
			                    <h6>dr. Ginanda Putra Siregar, SpU (K)</h6>
	                  		</div>

	                  		<div class="col-md-6">
	                  			 <p style="padding-left:190px;">
	                  			 	@if($pesanan)
	                  			 		Medan, {{$pesanan->tanggal}}<br>
	                  			 		Kepada Yth : <br>
				                   		No. Nota : {{$pesanan->nota}}
				                   	@else
				                   		Medan, <br>
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
	                  					<th>Harga Satuan</th>
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
			                        	

				                        	<td colspan="3"> </td>
				                        	<td><strong>Bayar : </strong> </td>
				                  			<td>
				                  				<form action="{{ route('transaksi.confirm') }}" method="post">
                                            		@csrf
				                  					<input type="numeric" name="uang_bayar" class="{{$errors->has('bayar') ? 'is-invalid' : ' '}}" required>
	                  								<button type="submit" class="btn btn-primary float-right">Confirm</button>
			                        			</form>
												
				                  			</td>
			                        			
				                  			@if($errors->has('bayar'))
				                  				<div class="invalid-feedback">
				                  					{{$errors->first('bayar')}}
				                  				</div>
				                  			@endif 


			                        </tr>
	                  		</table>

	                  		
	                    </div>

	                  </div>

	                </div>
            	</div>
            </div>         			

		</div>

	</section>

@endsection

<!-- @push('scripts')

 <script type="text/javascript">
 	var dengan_rupiah = document.getElementById('dengan-rupiah');
    dengan_rupiah.addEventListener('keyup', function(e)
    {
        dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
 </script>

@endpush -->