@extends('layouts.admin-theme')

@section('title','Edit User')

@section('content')

	<section class="section">
		<div class="section-header">
			<h1>Edit User</h1>
		</div>

		<div class="section-body">
			<div class="card">
				<div class="card-header">
					<h4>Edit User</h4>
				</div>

				<div class="card-body">
					<form action="{{route('user.update', $user->id)}}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')

						<div class="row">

							<div class="col-md-6">
								<div class="form-group">
									<label for="">Name</label>
									<input type="text" class="form-control" value="{{$user->name}}" id="" name="name" autocomplete="off">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="">Email Address</label>
									<input type="email" class="form-control" value="{{$user->email}}" id="" name="email" autocomplete="off">
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
                                        <option value="owner" {{isset($user) ? $user->role == "owner" ? 'selected' : '' : ''}}>Owner</option>
                                        <option value="admin" {{isset($user) ? $user->role == "admin" ? 'selected' : '' : ''}}>Admin</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select class="form-control" name="status" id="">
                                        <option value="1" {{isset($user) ? $user->status == "1" ? 'selected' : '' : ''}}>Active</option>
                                        <option value="0" {{isset($user) ? $user->status == "0" ? 'selected' : '' : ''}}>Non Active</option>
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