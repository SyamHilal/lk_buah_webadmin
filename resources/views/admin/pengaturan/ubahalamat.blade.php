@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                {{-- <span class="page-title-icon bg-gradient-primary text-white mr-2"> --}}
                  {{-- <i class="mdi mdi-home"></i> --}}
                </span> Alamat Toko </h3>

            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.pengaturan.updatealamat',['id' => $id ]) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                      <label for="province_id">Provinsi</label>
                                      <select name="province_id" id="province_id" class="form-control" required>
                                      <option value="">Pilih Provinsi</option>
                                        @foreach ($provinces as $province)
                                        <option value="{{ $province['province_id']  }}">{{ $province['province'] }}</option>
                                        @endforeach
                                      </select>
                                      <input type="hidden" value="" id="province_name" name="province_name">
                                </div>
                                <div class="form-grup">
                                    <label for="cities_id">Kota/Kabupaten</label>
                                    <select name="cities_id" id="cities_id" class="form-control" required>
                                    <option value="">Pilih Kota</option>
                                    </select>
                                    <input type="hidden" value="" id="city_name" name="city_name">
                                </div>
                                <div class="form-group mt-3">
                                <label>Detail Alamat</label>
                                <input type="text" class="form-control" name="detail" required>
                                </div>
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
@section('js')
<script type="text/javascript">
var toHtml = (tag, value) => {
	$(tag).html(value);
	}
 $(document).ready(function() {
     $('#province_id, #cities_id').select2({
            theme:'material',
     });
     //  $('#cities_id').select2();
     $('#province_id').on('change',function(){
     var id_prov = $('#province_id').val();
     var text_prov = $('#province_id option:selected').text();
     $('#province_name').val(text_prov);
     var url = window.location.href;
     var urlNya = url.substring(0, url.lastIndexOf('/ubahalamat/'));
     $.ajax({
         type:'GET',
         url:urlNya + '/alamat/getcity/' + id_prov,
         dataType:'json',
         success:function(data){
            var op = '<option value="">Pilih Kota</option>';
            if(data.length > 0) {
              var i = 0;
              for(i = 0; i < data.length; i++) {
                op += `<option value="${data[i].city_id}">${data[i].type + ' ' + data[i].city_name}</option>`
              }
		        }
            toHtml('[name="cities_id"]', op);
         }
     })
     });
     $('#cities_id').on('change', function(){
      var text_city = $('#cities_id option:selected').text();
      $('#city_name').val(text_city);
     });
 });
</script>
@endsection