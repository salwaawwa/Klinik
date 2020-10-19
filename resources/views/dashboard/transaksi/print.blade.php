<html>
	<head>
		<title>Cetak Daftar Transaksi</title>
		 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	</head>
	<body>

	<div class="container">

		<div align="center" class="mt-5">
			<h4><strong>Data Transaksi</strong></h4>
		</div>
        <div class="card-body p-0">

            <table class="table table-striped mt-3">
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>Nota</th>
                        <th>Nama Tindakan/Obat</th>
                        <th>Banyak</th>
                        <th>Jumlah Harga</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  @foreach($cetak as $item)
                      <tr>
                          <td align="center"> {{ $no++ }} </td>
                          <td> {{ $item->nota}}</td>
                          <td> {{ $item->produk->nama_tindakan}}</td>
                          <td align="center"> {{ $item->banyak}}</td>
                          <td> 
                          	@if($item->jumlah_harga == 0)
                          		<div align="center">
                          			{{$item->jumlah_harga}}
                          		</div>
                          	@else
                          		{{ Awa::Rupiah($item->jumlah_harga)}} 
                          	@endif
                          </td>
                      </tr>
                  @endforeach
                </tbody>
            </table>
          
          </div>
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