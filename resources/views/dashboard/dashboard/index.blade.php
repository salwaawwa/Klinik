@extends('layouts.admin-theme')

@section('title','Dashboard')

@section('content')

<!--  <div class="col-12 col-md-12 col-lg-12">
      <div class="card card-success">
        <div class="card-header">
          <h4>Lihat Data Perbulan</h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <form action="{{ route('dashboard.index') }}" method="get">
              
              <div class="row">

                <div class="form-group col-md-5">
                 <label>Dari Tanggal</label>
                 <input type="date" name="dari" class="form-control datemask">
                </div>

                <div class="form-group col-md-5">
                 <label>Sampai Tanggal</label>
                 <input type="date" name="sampai" class="form-control datemask">
                </div>

                <div class="col-md-2 mt-4">
                    <button type="submit" class="btn btn-primary float-right mr-3">Tampilkan</button>
                </div>

              </div>
            
            </form>
          </div>
        </div>
      </div>
    </div> -->

<div class="row">
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

  </div>

@endsection

<!-- @push('scripts')
    
    <script>
        var table = $('#table-data').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dashboard.data') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'bulan', name: 'bulan'},
                {data: 'dari', name: 'dari'},
                {data: 'sampai', name: 'sampai'},
                ]
            })
            function myConfirm(id) {
                var r = confirm("Yakin ingin menghapus ?")
                console.log(id)
                if (r) {
                    $.ajax({
                        url : "/dashboard/"+id+"/destroy",
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

 @endpush -->