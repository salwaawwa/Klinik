@extends('layouts.admin-theme')

@section('title','Create User')

@section('content')

	<section class="section">
		<div class="section-header">
			<h1>Create User</h1>
		</div>

		<div class="section-body">
			<div class="card">
				<div class="card-header">
					<h4>Create User</h4>
				</div>

				<div class="card-body">
					<form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
						@csrf

						<div class="row">

							<div class="col-md-6">
								<div class="form-group">
									<label for="">Name</label>
									<input type="text" class="form-control" id="" name="name" autocomplete="off">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="">Email Address</label>
									<input type="email" class="form-control" id="" name="email" autocomplete="off">
								</div>
							</div>

						</div>

						<div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" id="" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Password Confirmation</label>
                                    <input type="password" name="password_confirmation" id="" class="form-control">
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Role</label>
                                    <select class="form-control" name="role" id="">
                                        <option value="owner">Owner</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select class="form-control" name="status" id="">
                                        <option value="1">Active</option>
                                        <option value="0">Non Active</option>
                                    </select>
                                </div>
                            </div>


                        </div>

                        <a href="{{route('user.index')}}" class="btn btn-outline-primary float-left">Kembali</a>
                        <button type="submit" class="btn btn-primary float-right">Simpan</button>

					</form>
				</div>
			</div>
		</div>
	</section>

@endsection

@push('scripts')

	$( document ).ready(function() {
	    $('input').attr('autocomplete','off');
	});

@endpush