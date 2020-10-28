@extends('layouts.admin-theme')

@section('title','Dashboard')

@section('content')

    <section class="section">
        
      <div class="section-header">
        <h1>Dashboard</h1>
      </div>

      <div class="section-body">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Lihat Data Perperiode</h4>
              </div>
              <div class="card-body">
                <div class="form-group">
                    
                    <div class="row">

                      <div class="form-group col-md-5">
                      <label>Tanggal Awal</label>
                      <input type="date" name="tglawal" id="tglawal" class="form-control datemask">
                      </div>

                      <div class="form-group col-md-5">
                      <label>Tanggal Akhir</label>
                      <input type="date" name="tglakhir" id="tglakhir" class="form-control datemask">
                      </div>

                      <div class="col-md-2 mt-4">
                          <a href="" onclick="this.href='perhitungan-perperiode/' + document.getElementById('tglawal').value +
                          '/' + document.getElementById('tglakhir').value " target="_blank" class="btn btn-primary float-right mr-3">Lihat</a>
                      </div>

                    </div>
                  
                </div>
              </div>
            </div>
        </div>

      </div>
    </section>

{{-- <div class="row">
	 <div class="col-lg-6 col-md-4 col-sm-12">
      <div class="card card-statistic-2">
         <div class="card-icon shadow-primary bg-primary">
          <i class="fas fa-archive"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Kas Masuk</h4>
          </div>
          <div class="card-body">
            <p>Rp.50.000</p>
          </div>
        </div>
      </div>
    </div>    
           
    <div class="col-lg-6 col-md-4 col-sm-12">
      <div class="card card-statistic-2">
        <div class="card-icon shadow-primary bg-primary">
          <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Profit</h4>
          </div>
          <div class="card-body">
            <p>Rp.25.000</p>
          </div>
        </div>
      </div>
    </div>

  </div> --}}

@endsection
