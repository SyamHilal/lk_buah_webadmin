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
                        {{-- <div class="row mb-3">
                            <div class="col">
                                <h4 class="card-title">Total Pendapatan/Laba : Rp
                                    {{ number_format($total_pendapatan, 2, ',', '.') }}</h4>
                            </div>
                        </div> --}}
                        <div class="card mx-auto border border-info mb-3" style="width: 100%">
                        <div class="header bg-info text-white text-center">Laporan Bulanan</div>
                        <form class="mt-2 ml-3" action="{{ route('admin.transaksi.cetak') }}" method="GET" class="form-group" id="formFilter">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="mr-3">Tahun</label>
                                    <select style="cursor:pointer;" class="form-control" id="tag_select" name="year">
                                        <option value="0" selected disabled> Pilih Tahun</option>
                                            <?php 
                                            $year = date('Y');
                                            $min = $year - 60;
                                            $max = $year;
                                            for( $i=$max; $i>=$min; $i-- ) {
                                            echo '<option value='.$i.'>'.$i.'</option>';
                                            }?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="">Bulan</label>
                                    <select class="form-control" id="tag_select" name="month">
                                        <option value="0" selected disabled> Pilih Bulan</option>
                                        <option value="01"> Januari</option>
                                        <option value="02"> Februari</option>
                                        <option value="03"> Maret</option>
                                        <option value="04"> April</option>
                                        <option value="05"> Mei</option>
                                        <option value="06"> Juni</option>
                                        <option value="07"> Juli</option>
                                        <option value="08"> Agustus</option>
                                        <option value="09"> September</option>
                                        <option value="10"> Oktober</option>
                                        <option value="11"> November</option>
                                        <option value="12"> Desember</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info float-right mt-4 ml-4" form="formFilter" value="Submit" style="height:50%;"> <i class="fas fa-print "></i> Cetak Laporan</button>
                              </div>
                          </form>
                        </div>
                        <div class="table-responsive">
                            <a href="{{ route('admin.transaksi.cetakAll') }}" class="btn btn-info btn-sm">
                                <i class="mdi mdi-printer">Print</i>
                              </a>
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
                                        {{-- <th>Total Pendapatan/Laba</th> --}}
                                        <th>Metode Pembayaran</th>
                                        <th>No Resi</th>
                                        <th>Status Pesanan</th>
                                        <th>Tgl diterima</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderbaru as $order)
                                        <tr>
                                            <td align="center"></td>
                                            <td>{{ $order->invoice }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>JNE</td>
                                            <td>{{ $order->nama_pemesan }}</td>
                                            <td>{{ $order->pesan }}</td>
                                            <td>{{ $order->subtotal }}</td>
                                            <td>{{ $order->ongkir }}</td>
                                            <td>{{ $order->ongkir + $order->subtotal }}</td>
                                            {{-- <td>{{ $order->ongkir  $order->subtotal }}</td> --}}
                                            <td>{{ $order->metode_pembayaran }}</td>
                                            <td>{{ $order->no_resi ?? '-' }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->updated_at }}</td>
                                            <td align="center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{ route('admin.transaksi.detail', ['id' => $order->id]) }}"
                                                        class="btn btn-warning btn-sm">
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
                ],
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'asc']
                ],
                "language": {
                    "sProcessing": "Sedang memproses ...",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecord": "Maaf data tidak tersedia",
                    "info": "Menampilkan _PAGE_ halaman dari _PAGES_ halaman",
                    "infoEmpty": "Tidak ada data yang tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "sSearch": "Cari",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sPrevious": "Sebelumnya",
                        "sNext": "Selanjutnya",
                        "sLast": "Terakhir"
                    }
                }
            });
            t.on('order.dt search.dt', function() {
                t.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        });
    </script>
@endsection
