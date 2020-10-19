@extends('layouts.admin-theme')

@section('title','Data Tindakan')

@section('content')

	<section class="section">
		
		<div class="section-header">
			<h1>Data Tindakan</h1>
		</div>

		<div class="section-body">

			<div class="card">

				<div class="card-header">
					<h4>List Data Tindakan</h4>
				</div>

				<div class="card-body">

					@if(session()->has('info'))
                        <div class="alert alert-primary">
                            {{ session()->get('info') }}
                        </div>	
                    @endif

					<a href="{{route('produk.create')}}" class="btn btn-primary float-right mb-4"><i class="fas fa-plus-square" ></i> Tambah Data</a>
                    <a href="{{route('produk.show')}}" class="btn btn-primary float-right mb-4 mr-2"><i class="fa fa-info"></i> Detail Data</a>
                    <a href="{{route('produk.print')}}" class="btn btn-primary float-left mb-4 mr-2"><i class="fa fa-print"></i> Cetak Data</a>

					<table class="table" id="table-produk">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Tindakan</th>
								<th>Stok</th>
                                <th>Harga Jual</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>

				</div>

			</div>

		</div>

	</section>

@endsection

@push('scripts')
    
    <script>
        var table = $('#table-produk').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('produk.data') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama_tindakan', name: 'nama_tindakan'},
                {data: 'stok', name: 'stok'},
                {data: 'harga', name: 'harga'},
                ]
            })
            function myConfirm(id) {
                var r = confirm("Yakin ingin menghapus ?")
                console.log(id)
                if (r) {
                    $.ajax({
                        url : "/produk/"+id+"/destroy",
                        type: 'GET',
                        success: function(result) {
                            console.log(result)
                            if (result.status == true) {
                                alert(result.pesan)
                                table.draw()
                            } else {
                                alert(result.pesan)
                            }
                        }
                    })
                }
            }
    </script>

 @endpush