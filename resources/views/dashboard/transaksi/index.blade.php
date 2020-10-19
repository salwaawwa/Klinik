@extends('layouts.admin-theme')
@section('title','Transaksi')
@section('content')

	<section class="section">

		<div class="section-header">
			<h1>Transaksi</h1>
		</div>

		<div class="section-body">

			<div class="card">

				<div class="card-header">
					<h4>List Transaksi</h4>
				</div>

				<div class="card-body">
                        <a href="{{route('transaksi.print')}}" class="btn btn-primary float-left mb-4 mr-2"><i class="fa fa-print"></i> Cetak Data</a>                    <table class="table" id="table-transaksi">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nota</th>
                                <th>Tanggal</th>
                                <th>Total Harga</th>
                                <th>Status Bayar</th>
                            </tr>
                        </thead>
                    </table>
                </div>

			</div>

		</div>

	</section>

@endsection

@push('scripts')
    
    <script>
        var table = $('#table-transaksi').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('transaksi.data') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nota', name: 'nota'},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'total_harga', name: 'total_harga'},
                {data: 'status', name: 'status'},
                ]
            })
            function myConfirm(id) {
                var r = confirm("Yakin ingin menghapus ?")
                console.log(id)
                if (r) {
                    $.ajax({
                        url : "/transaksi/"+id+"/destroy",
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