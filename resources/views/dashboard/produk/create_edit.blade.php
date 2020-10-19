@extends('layouts.admin-theme')
@section('title')

	{{isset($produk) ? 'Edit' : 'Create' }} Tindakan

@endsection
@section('content')

	<section class="section">
		
		<div class="section-header">
			<h1>{{isset($produk) ? 'Edit' : 'Create' }} Tindakan </h1>
		</div>

		<div class="section-body">

			<div class="row sortable-card">
              	<div class="col-12 col-md-8 col-lg-6">
	                <div class="card card-primary">

	                  <div class="card-header">
	                    <h4>{{isset($produk) ? 'Edit' : 'Create' }} Tindakan </h4>
	                  </div>

	                  <div class="card-body">
	                    <div class="col-ld-4">

	                    	<form action="{{isset($produk) ? route('produk.update', $produk->slug) : route('produk.store') }}" method="POST" enctype="multipart/form-data">
	                  			@csrf
	                  			@isset($produk)
	                  				@method('PUT')
	                  			@endisset

		                  		<div class="form-group form-label-group">
		                  			<label for="">Nama Tindakan</label>
		                  			<input type="text" name="nama_tindakan" class="form-control {{$errors->has('nama_tindakan') ? 'is-invalid' : ' '}}" 
		                  			value="{{isset($produk) ? $produk->nama_tindakan : ' ' }}"
		                  			id="" required>

		                  			@if($errors->has('nama_tindakan'))
		                  				<div class="invalid-feedback">
		                  					{{$errors->first('nama_tindakan')}}
		                  				</div>
		                  			@endif

		                  		</div>

		                  		<div class="form-group form-label-group">
		                  			<label for="">Stok</label>
		                  			<input type="number" name="stok" class="form-control {{$errors->has('stok') ? 'is-invalid' : ' '}}" 
		                  			value="{{isset($produk) ? $produk->stok : ' ' }}"
		                  			id="" required>

		                  			@if($errors->has('stok'))
		                  				<div class="invalid-feedback">
		                  					{{$errors->first('stok')}}
		                  				</div>
		                  			@endif

		                  		</div>

		                  		<div class="form-group form-label-group">
		                  			<label for="">Harga Beli</label>
		                  			<input type="number" name="harga_beli" class="form-control {{$errors->has('harga_beli') ? 'is-invalid' : ' '}}" 
		                  			value="{{isset($produk) ? $produk->harga_beli : ' ' }}"
		                  			id="dengan-rupiah" required>

		                  			@if($errors->has('harga_beli'))
		                  				<div class="invalid-feedback">
		                  					{{$errors->first('harga_beli')}}
		                  				</div>
		                  			@endif

		                  		</div>

		                  		<div class="form-group form-label-group">
		                  			<label for="">Harga Jual</label>
		                  			<input type="number" name="harga" class="form-control {{$errors->has('harga') ? 'is-invalid' : ' '}}" 
		                  			value="{{isset($produk) ? $produk->harga : ' ' }}"
		                  			id="dengan-rupiah2" required>

		                  			@if($errors->has('harga'))
		                  				<div class="invalid-feedback">
		                  					{{$errors->first('harga')}}
		                  				</div>
		                  			@endif

		                  		</div>

		                  		<a href="{{route('produk.index')}}" class="btn btn-outline-primary float-left">Kembali</a>
		                  		<button type="submit" class="btn btn-primary float-right">{{isset($produk) ? 'Update' : 'Create' }} </button>

	                  		</form>
	                    </div>
	                  </div>

	                </div>
            	</div>
            </div>

		</div>

	</section>
@endsection

@push('scripts')
	
	<script type="text/javascript">
		function filePreview(input){
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e){
					$('#iGambar + image').remove();
					$('#iGambar').after('<img src="'+e.target.result +'" width="100" class="mt-3" /> ')
				}
				reader.readAsDataURL(input.files[0]);
			}
		}

		$(function(){
			$('#iGambar').change(function(){
				filePreview(this);
			})
		})

		// var dengan_rupiah = document.getElementById('dengan-rupiah');
	 //    dengan_rupiah.addEventListener('keyup', function(e)
	 //    {
	 //        dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
	 //    });

	 //    var dengan_rupiah2 = document.getElementById('dengan-rupiah2');
	 //    dengan_rupiah2.addEventListener('keyup', function(e)
	 //    {
	 //        dengan_rupiah2.value = formatRupiah(this.value, 'Rp. ');
	 //    });

	 //    function formatRupiah(angka, prefix)
	 //    {
	 //        var number_string = angka.replace(/[^,\d]/g, '').toString(),
	 //            split    = number_string.split(','),
	 //            sisa     = split[0].length % 3,
	 //            rupiah     = split[0].substr(0, sisa),
	 //            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
	            
	 //        if (ribuan) {
	 //            separator = sisa ? '.' : '';
	 //            rupiah += separator + ribuan.join('.');
	 //        }
	        
	 //        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	 //        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	 //    }

	</script>
@endpush