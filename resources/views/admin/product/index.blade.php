@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                {{-- <span class="page-title-icon bg-gradient-primary text-white mr-2"> --}}
                  {{-- <i class="mdi mdi-home"></i> --}}
                </span> Produk </h3>

            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row mb-3">
                      <div class="col">
                      <h4 class="card-title">Data Produk</h4>
                      </div>
                      <div class="col text-right">
                      <a href="{{ route('admin.product.tambah') }}" class="btn btn-success">Tambah</a>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-bordered table-hovered" id="tableProduk">
                        <thead>
                          <tr>
                            <th width="5%">No</th>
                            <th>Nama Produk</th>
                            <th>Harga Awal</th>
                            <th>Harga Jual</th>
                            <th>Berat</th>
                            <th>Stok</th>
                            <th>Unit</th>
                            <th>Gambar</th>
                            <th width="15%">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php
                              $i=0;
                          @endphp
                          @foreach($products  as $key => $product)
                          @php
                              $i++;
                          @endphp
                            <tr>
                                <td align="center">{{ ++$key}}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price_awal }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->weigth }}gr</td>
                                <td>{{ $product->stok }}</td>
                                <td>{{ $product->unit }}</td>
                                <td><img src="{{ asset('storage/'.$product->image) }}" alt="" ></td>
                                <td align="center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                  <a href="{{ route('admin.product.edit',['id'=>$product->id]) }}" class="btn btn-warning btn-sm">
                                    <i class="mdi mdi-tooltip-edit"></i>
                                  </a>
                                  {{-- <a href="{{ route('admin.product.delete',['id'=>$product->id]) }}" onclick="return confirm('Yakin Hapus data')" class="btn btn-danger btn-sm">
                                    <i class="mdi mdi-delete-forever"></i>
                                  </a> --}}
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
  var t = $('#tableProduk').DataTable({
              dom: 'Bfrtip',
              buttons: [
              {
                        extend: 'print',
                       
                        exportOptions: {
                            columns: [  1, 2, 3, 4, 5 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                       
                       
                        exportOptions: {
                          columns: ':visible',
                          columns: [  1, 2, 3, 4, 5]
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

