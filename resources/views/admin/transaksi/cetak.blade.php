<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<link rel="stylesheet" href="{{ asset('adminassets') }}/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('adminassets') }}/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('adminassets') }}/assets/css/style.css">
    <link href="{{ asset('swal/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" />
    <link href="{{ asset('table/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
	<link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
	<style type="text/css">
		body {
			font-family: Arial;
			color: black;
		}
	</style>
</head>

<body>
	<center>
		<h1>Laporan Penjualan LK Buah, Indramayu</h1>
	</center>

	<table class="mb-4">
		<tr>
			<td>Penjualan</td>
			<td>:</td>
			<td> Rp. {{ number_format($jual, 0, ',', '.') }}</td>
		</tr>
		<tr>
			<td>Pendapatan</td>
			<td>:</td>
			<td>Rp. {{ number_format($untung, 0, ',', '.') }}</td>
		</tr>
	</table>
	<table class="table table-bordered" style="border: 1px solid black, border-collapse: collapse">
		<thead>
			<tr>
				<th>No Invoice</th>
				<th>Pemesan</th>
				{{-- <th>Catatan</th> --}}
				<th>Nama Produk</th>
				<th>Total Produk</th>
				<th>Total Pesanan</th>
				{{-- <th>Total Pendapatan/Laba</th> --}}
				<th>Metode Pembayaran</th>
				<th>No Resi</th>
				<th>Tgl diterima</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($laporan as $order)
                                        <tr>
                                            <td>{{ $order->invoice }}</td>
                                            <td>{{ $order->nama_pemesan }}</td>
                                            {{-- <td>{{ $order->pesan }}</td> --}}
                                            <td>@foreach ($detail as $details) 
												{{ $details->name }}
												@endforeach
											</td>
                                            <td>
												{{ $order->qty }}
											</td>
                                            <td>Rp. {{ number_format($order->ongkir + $order->subtotal, 0, ',', '.') }}</td>
                                            {{-- <td>{{ $order->ongkir  $order->subtotal }}</td> --}}
                                            <td>{{ $order->metode_pembayaran }}</td>
                                            <td>{{ $order->no_resi ?? '-' }}</td>
                                            <td>{{ $order->updated_at }}</td>
                                        </tr>
                                    @endforeach
	</table>
	<table width="95%" class="mt-4">
		<tr>
			<td></td>
			<td width="200px">
				<p>Indramayu, <?= date("d M Y") ?> <br> Pemilik</p>
				<br>
				<br>
				<br>
				<p>Kasturi</p>
			</td>
		</tr>
	</table>
</body>

</html>

<script type="text/javascript">
	window.print();
</script>
