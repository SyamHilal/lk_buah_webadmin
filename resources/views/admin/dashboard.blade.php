@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                {{-- <span class="page-title-icon bg-gradient-primary text-white mr-2"> --}}
                  {{-- <i class="mdi mdi-home"></i> --}}
                </span> Dashboard </h3>

            </div>
            <div class="row">
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{ asset('adminassets') }}/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Penjualan <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h3 class="mb-5">Rp. {{ number_format($penjualan,2,',','.') }}</h3>
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-primary card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{ asset('adminassets') }}/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Pendapatan <i class="mdi mdi-square-inc-cash mdi-24px float-right"></i>
                    </h4>
                    <h3 class="mb-5">Rp. {{ number_format($pendapatan,2,',','.') }}</h3>
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{ asset('adminassets') }}/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Transaksi <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">{{ $transaksi->total_order }}</h2>
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{ asset('adminassets') }}/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Pelanggan <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">{{ $pelanggan->total_user }}</h2>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">{{ count($order_baru) }} Transaksi Terbaru</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Invoice </th>
                            <th> Pemesan </th>
                            <th> Subtotal </th>
                            <th> Ongkir </th>
                            <th> Status Pesanan </th>
                            <th> Aksi </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($order_baru as $order)
                            <tr>
                              <td>{{ $order->invoice }}</td>
                              <td>{{ $order->nama_pemesan }}</td>
                              <td>{{ $order->subtotal }}</td>
                              <td>{{ $order->ongkir }}</td>
                              <td>{{ $order->name }}</td>
                              <td> <a href="{{ route('admin.transaksi.detail',['id'=>$order->id]) }}" class="btn btn-warning btn-sm">Detail</a></td>
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