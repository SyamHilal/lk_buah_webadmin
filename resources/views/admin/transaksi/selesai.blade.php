@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                {{-- <span class="page-title-icon bg-primary text-white mr-2"> --}}
                  {{-- <i class="mdi mdi-home"></i> --}}
                </span> Pesanan </h3>

            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row mb-3">
                      <div class="col">
                      <h4 class="card-title">Data Pesanan Telah Selesai</h4>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-bordered table-hovered" id="tableSelesai">
                        <thead>
                          <tr>
                            <th width="5%">No</th>
                            <th>No Invoice</th>
                            <th>Tgl Pesan</th>
                            <th>Kurir</th>
                            <th>Pemesan</th>
                            <th>Catatan</th>
                            <th>Subtotal</th>
                            <th>Ongkir</th>
                            <th>Total Pesanan</th>
                            <th>Metode Pembayaran</th>
                            <th>No Resi</th>
                            <th>Status Pesanan</th>
                            <th>Tgl diterima</th>
                            <th width="15%">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($orderbaru as $order)
                            <tr>
                                <td align="center"></td>
                                <td>{{ $order->invoice }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>JNE</td>
                                <td>{{ $order->nama_pemesan }}</td>
                                <td>{{ $order->pesan }}</td>
                                <td>{{ $order->subtotal  }}</td>
                                <td>{{ $order->ongkir  }}</td>
                                <td>{{ $order->ongkir + $order->subtotal }}</td>
                                <td>{{ $order->metode_pembayaran }}</td>
                                <td>{{ $order->no_resi ?? '-' }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->updated_at }}</td>
                                <td align="center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                  <a href="{{ route('admin.transaksi.detail',['id'=>$order->id]) }}" class="btn btn-warning btn-sm">
                                    Detail
                                  </a>
                                </div>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>    
         
            
                
@endsection

@section('js')
<script type="text/javascript">

 $(document).ready(function() {
  var t = $('#tableSelesai').DataTable({
              dom: 'Bfrtip',
              buttons: [
              {
                        extend: 'print',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: {
                            columns: [  1, 2, 3, 4, 5,6,7,8,9,10,11 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: {
                          columns: [  1, 2, 3, 4, 5,6,7,8,9,10,11 ]
                        }
                    },
                    'colvis'
                ],
                  "columnDefs": [ {
                      "searchable": false,
                      "orderable": false,
                      "targets": 0
                  } ],
                  "order": [[ 1, 'asc' ]],
                  "language" : {
                      "sProcessing" : "Sedang memproses ...",
                      "lengthMenu" : "Tampilkan _MENU_ data per halaman",
                      "zeroRecord" : "Maaf data tidak tersedia",
                      "info" : "Menampilkan _PAGE_ halaman dari _PAGES_ halaman",
                      "infoEmpty" : "Tidak ada data yang tersedia",
                      "infoFiltered" : "(difilter dari _MAX_ total data)",
                      "sSearch" : "Cari",
                      "oPaginate" : {
                          "sFirst" : "Pertama",
                          "sPrevious" : "Sebelumnya",
                          "sNext" : "Selanjutnya",
                          "sLast" : "Terakhir"
                      }
                  }
              });
              t.on( 'order.dt search.dt', function () {
                  t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                      cell.innerHTML = i+1;
                  } );
              } ).draw();
 });
</script>
@endsection

