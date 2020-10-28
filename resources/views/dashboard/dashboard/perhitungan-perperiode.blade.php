<html>
	<head>
		<title>Perhitungan Perperiode</title>
		 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	</head>
	<body>

        <div class="container">

        <div align="center" class="mt-5">
        <h4><strong>Data Kas Masuk Dan Profit Perperiode</strong></h4>
        </div>
        <div class="card-body p-0">

            <table class="table table-striped mt-3">
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>Nota</th>
                        <th>Tanggal</th>
                        <th>Nama Tindakan</th>
                        <th>Tejual</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Kas Masuk</th>
                        <th>Profit</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; ?>
                @foreach($perhitungan as $item)
                    <tr>
                        <td align="center"> {{ $no++ }} </td>
                        <td> {{ $item->nota}}</td>
                        <td> {{ $item->pesanan->tanggal}}</td>
                        <td> {{ $item->produk->nama_tindakan}}</td>
                        <td align="center"> {{ $item->banyak}}</td>
                        <td> 
                            @if($item->produk->harga_beli == 0)
                                <div align="center">
                                    {{$item->produk->harga_beli}}
                                </div>
                            @else
                                {{ Awa::Rupiah($item->produk->harga_beli)}} 
                            @endif
                        </td>
                        <td> 
                            @if($item->produk->harga == 0)
                                <div align="center">
                                    {{$item->produk->harga}}
                                </div>
                            @else
                                {{ Awa::Rupiah($item->produk->harga)}} 
                            @endif
                        </td>
                        <td> 
                            @if($item->kas == NULL)
                                <div align="center">
                                    0
                                </div>
                            @else
                                {{ Awa::Rupiah($item->kas)}} 
                            @endif
                        </td>
                        <td> 
                            @if($item->pro == NULL)
                                <div align="center">
                                    0
                                </div>
                            @else
                                {{ Awa::Rupiah($item->pro)}} 
                            @endif
                        </td>
                    </tr>
                @endforeach
                    <tr>
                        <td colspan="6">  </td>
                        <td align="center"><strong>Total : </strong></td>
                        <td>
                            @if($kass == NULL)
                                <div align="center">
                                    0
                                </div>
                            @else
                                {{ Awa::Rupiah($kass) }} 
                            @endif
                        </td>
                        <td>
                            @if($proo == NULL)
                                <div align="center">
                                    0
                                </div>
                            @else
                                {{ Awa::Rupiah($proo) }}
                            @endif
                        </td>
                    </tr>
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