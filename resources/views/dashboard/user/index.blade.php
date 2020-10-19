@extends('layouts.admin-theme')

@section('title','Users')

@section('content')
	<section class="section">
		<div class="section-header">
			<h1>User</h1>
		</div>

		<div class="section-body">
			<div class="card">
				<div class="card-header">
					<h4>List Users</h4>
				</div>

				<div class="card-body">

					@if(session()->has('info'))
                        <div class="alert alert-primary">
                            {{ session()->get('info') }}
                        </div>
                    @elseif(session()->has('danger'))
                    	 <div class="alert alert-danger">
                            {{ session()->get('danger') }}
                        </div>
                    @endif


					<a href="{{route('user.create')}}" class="btn btn-primary float-right mb-4">Tambah Data</a>

					<table class="table" id="table-user">
						<thead>
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Email Address</th>
								<th>Role</th>
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
        var table = $('#table-user').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.data') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'role', name: 'role'},
                ]
            })
    </script>

@endpush