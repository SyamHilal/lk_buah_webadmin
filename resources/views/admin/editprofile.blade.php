@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                {{-- <span class="page-title-icon bg-gradient-primary text-white mr-2"> --}}
                  {{-- <i class="mdi mdi-home"></i> --}}
                </span> Edit Profile </h3>

            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row mb-3">
                      <div class="col">
                      <h4 class="card-title">Edit Profile</h4>
                      </div>
                      <div class="col text-right">
                      <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-warning">Kembali</a>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.pengaturan.simpanuser') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                <label for="exampleInputUsername1">Username</label>
                                <input required type="text" class="form-control" name="username" value="{{Auth::user()->name}}">
                                </div>
                                <div class="form-group">
                                <label for="exampleInputUsername1">Email</label>
                                <input required type="text" class="form-control" name="email" value="{{Auth::user()->email}}">
                                </div>
                                <div class="form-group">
                                <label for="exampleInputUsername1">Nomor Hp</label>
                                <input required type="text" class="form-control" name="noHP" value="{{Auth::user()->no_hp}}">
                                </div>
                                
                                ,
                                
                                
                                
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success text-right">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
@endsection
