@extends('layouts.app')

@section('title','Register')

@section('content')

	<section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

                    <div class="login-brand">
                        Klinik UROLOGI
                    </div>

                    <div class="card card-primary">

                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="card-body">
                            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input class="form-control" type="text" name="name" placeholder="Nama"
                                    autocomplete="off" autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="">Email Address</label>
                                    <input class="form-control" type="email" name="email" placeholder="email"
                                    autocomplete="off"> 
                                </div>
                               
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input class="form-control" type="password" name="password" placeholder="password">
                                </div>

                                <div class="form-group">
                                    <label for="">Password Confirm</label>
                                    <input class="form-control" type="password" name="password_confirmation" placeholder="password confirmation">
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
                                
                                <button type="submit" class="btn btn-primary" >Daftar</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>	

@endsection