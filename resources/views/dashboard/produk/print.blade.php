<html>
	<head>
		<title>Cetak Data Tindakan</title>
		 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	</head>
	<body>

	<div class="container">

		<div align="center" class="mt-5">
			<h4><strong>Data Tindakan</strong></h4>
		</div>
        <div class="card-body p-0">

            <table class="table table-striped mt-3">
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>Nama Tindakan</th>
                        <th>Stok</th>
                        <th>Tejual</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Kas Masuk</th>
                        <th>Profit</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  @foreach($cetak as $item)
                      <tr>
                          <td align="center"> {{ $no++ }} </td>
                          <td> {{ $item->nama_tindakan}}</td>
                          <td align="center"> {{ $item->stok}}</td>
                          <td align="center"> {{ $item->terjual}}</td>
                          <td> 
                          	@if($item->harga_beli == 0)
                          		<div align="center">
                          			{{$item->harga_beli}}
                          		</div>
                          	@else
                          		{{ Awa::Rupiah($item->harga_beli)}} 
                          	@endif
                          </td>
                          <td> 
                          	@if($item->harga == 0)
                          		<div align="center">
                          			{{$item->harga}}
                          		</div>
                          	@else
                          		{{ Awa::Rupiah($item->harga)}} 
                          	@endif
                          </td>
                          <td> 
                          	@if($item->kas_masuk == 0)
                          		<div align="center">
                          			{{$item->kas_masuk}}
                          		</div>
                          	@else
                          		{{ Awa::Rupiah($item->kas_masuk)}} 
                          	@endif
                          </td>
                          <td> 
                          	@if($item->profit == 0)
                          		<div align="center">
                          			{{$item->profit}}
                          		</div>
                          	@else
                          		{{ Awa::Rupiah($item->profit)}} 
                          	@endif
                          </td>
                      </tr>
                  @endforeach
                </tbody>
            </table>

        </div>
	</div>

	 <script type="text/javascript">
            window.print();
     </script>
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

	</body>
</html>