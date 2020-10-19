@extends('layouts.admin-theme')

@section('title','Detail Data Tindakan')

@section('content')

	<section class="section">
		
		<div class="section-header">
			<h1>Detail Data Tindakan</h1>
		</div>

		<div class="section-body">

			<div class="card">

				<div class="card-header">
					<h4>List Detail Data Tindakan</h4>
				</div>

				<div class="card-body">

					@if(session()->has('info'))
                        <div class="alert alert-primary">
                            {{ session()->get('info') }}
                        </div>	
                    @endif

					<table class="table" id="table-show">
						<thead align="center">
							<tr>
								<th>No</th>
								<th>Nama Tindakan</th>
								<th>Stok</th>
								<th>Terjual</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Kas Masuk</th>
                                <th>Profit</th>
							</tr>
						</thead>
						<tbody align="center">
							
						</tbody>
					</table>

				</div>

			</div>

			<a href="{{route('produk.index')}}" class="btn btn-outline-primary float-left">Kembali</a>

		</div>

	</section>

@endsection

@push('scripts')
    
    <script>
             var table = $('#table-show').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('produk.data') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama_tindakan', name: 'nama_tindakan'},
                {data: 'stok', name: 'stok'},
                {data: 'terjual', name: 'terjual'},
                {data: 'harga_beli', name: 'harga_beli'},
                {data: 'harga', name: 'harga'},
                {data: 'kas_masuk', name: 'kas_masuk'},
                {data: 'profit', name: 'profit'}
                ]
            })
              
    </script>

@endpush
