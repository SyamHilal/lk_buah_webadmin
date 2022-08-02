<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LK Buah</title>
    <!-- plugins:css -->
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

    <style>
      .select2-container--material {
  width: 100% !important; }
  .select2-container--material .select2-selection--single {
    background-color: transparent;
    border: none;
    border-bottom: 1px solid #ced4da;
    border-radius: 0;
    box-shadow: none;
    box-sizing: content-box;
    height: auto;
    margin: 0;
    outline: none;
    padding: 8px 0 5px 0;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; }
    .select2-container--material .select2-selection--single .select2-selection__rendered {
      color: #444;
      line-height: 28px;
      padding-left: 0; }
    .select2-container--material .select2-selection--single .select2-selection__clear {
      cursor: pointer;
      float: right;
      font-weight: bold; }
    .select2-container--material .select2-selection--single .select2-selection__placeholder {
      color: #999; }
    .select2-container--material .select2-selection--single .select2-selection__arrow {
      height: 26px;
      margin: 0.6rem 0 0.4rem 0;
      position: absolute;
      top: 1px;
      right: 1px;
      width: 20px; }
      .select2-container--material .select2-selection--single .select2-selection__arrow b {
        border-color: #888 transparent transparent transparent;
        border-style: solid;
        border-width: 5px 4px 0 4px;
        height: 0;
        left: 50%;
        margin-left: -4px;
        margin-top: -2px;
        position: absolute;
        top: 50%;
        width: 0; }
  .select2-container--material[dir="rtl"] .select2-selection--single .select2-selection__clear {
    float: left; }
  .select2-container--material[dir="rtl"] .select2-selection--single .select2-selection__arrow {
    left: 1px;
    right: auto; }
  .select2-container--material.select2-container--disabled .select2-selection--single {
    background-color: #eee;
    cursor: default; }
    .select2-container--material.select2-container--disabled .select2-selection--single .select2-selection__clear {
      display: none; }
  .select2-container--material.select2-container--open .select2-selection--single .select2-selection__arrow b {
    border-color: transparent transparent #888 transparent;
    border-width: 0 4px 5px 4px; }
  .select2-container--material .select2-selection--multiple {
    background-color: transparent;
    border: none;
    border-bottom: 1px solid #ced4da;
    border-radius: 0;
    box-shadow: none;
    box-sizing: content-box;
    cursor: text;
    height: auto;
    margin: 0;
    outline: none;
    padding: 5px 0 0 0;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; }
    .select2-container--material .select2-selection--multiple .select2-selection__rendered {
      box-sizing: border-box;
      list-style: none;
      margin: 0;
      padding: 0 5px;
      width: 100%; }
      .select2-container--material .select2-selection--multiple .select2-selection__rendered li {
        list-style: none; }
    .select2-container--material .select2-selection--multiple .select2-selection__placeholder {
      color: #999;
      margin-top: 5px;
      float: left; }
    .select2-container--material .select2-selection--multiple .select2-selection__clear {
      cursor: pointer;
      float: right;
      font-weight: bold;
      margin-top: 5px;
      margin-right: 10px; }
    .select2-container--material .select2-selection--multiple .select2-selection__choice {
      background-color: #ffca28;
      border-radius: 16px;
      color: rgba(0, 0, 0, 0.6);
      cursor: default;
      float: left;
      margin-right: 5px;
      margin-top: 6px;
      padding: 0 12px; }
    .select2-container--material .select2-selection--multiple .select2-selection__choice__remove {
      cursor: pointer;
      display: inline-block;
      font-weight: bold;
      float: right;
      margin-left: 5px; }
      .select2-container--material .select2-selection--multiple .select2-selection__choice__remove:hover {
        color: #333; }
  .select2-container--material[dir="rtl"] .select2-selection--multiple .select2-selection__choice, .select2-container--material[dir="rtl"] .select2-selection--multiple .select2-selection__placeholder, .select2-container--material[dir="rtl"] .select2-selection--multiple .select2-search--inline {
    float: right; }
  .select2-container--material[dir="rtl"] .select2-selection--multiple .select2-selection__choice {
    margin-left: 5px;
    margin-right: auto; }
  .select2-container--material[dir="rtl"] .select2-selection--multiple .select2-selection__choice__remove {
    margin-left: 2px;
    margin-right: auto; }
  .select2-container--material.select2-container--disabled .select2-selection--multiple {
    background-color: #eee;
    cursor: default; }
  .select2-container--material.select2-container--disabled .select2-selection__choice__remove {
    display: none; }
  .select2-container--material.select2-container--open.select2-container--above .select2-selection--single, .select2-container--material.select2-container--open.select2-container--above .select2-selection--multiple {
    border-top-left-radius: 0;
    border-top-right-radius: 0; }
  .select2-container--material.select2-container--open.select2-container--below .select2-selection--single, .select2-container--material.select2-container--open.select2-container--below .select2-selection--multiple {
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0; }
  .select2-container--material.select2-container--focus .select2-selection--single {
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    outline: 0; }
  .select2-container--material.select2-container--focus .select2-selection--multiple {
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    outline: 0; }
  .select2-container--material .select2-search--dropdown .select2-search__field {
    border: none;
    border-bottom: 1px solid #ced4da;
    border-radius: 0;
    outline: none; }
    .select2-container--material .select2-search--dropdown .select2-search__field:focus:not([readonly]) {
      box-shadow: 0 1px 0 0 #ced4da;
      border-bottom: 1px solid #ced4da; }
  .select2-container--material .select2-search--inline .select2-search__field {
    background: transparent;
    border: none !important;
    outline: 0;
    box-shadow: none !important;
    -webkit-appearance: textfield; }
  .select2-container--material .select2-results > .select2-results__options {
    max-height: 200px;
    overflow-y: auto; }
  .select2-container--material .select2-results__option[role=group] {
    padding: 0; }
  .select2-container--material .select2-results__option[aria-disabled=true] {
    color: #999; }
  .select2-container--material .select2-results__option[aria-selected=true] {
    background-color: #ddd; }
  .select2-container--material .select2-results__option .select2-results__option {
    padding-left: 1em; }
    .select2-container--material .select2-results__option .select2-results__option .select2-results__group {
      padding-left: 0; }
    .select2-container--material .select2-results__option .select2-results__option .select2-results__option {
      margin-left: -1em;
      padding-left: 2em; }
      .select2-container--material .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
        margin-left: -2em;
        padding-left: 3em; }
        .select2-container--material .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
          margin-left: -3em;
          padding-left: 4em; }
          .select2-container--material .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
            margin-left: -4em;
            padding-left: 5em; }
            .select2-container--material .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
              margin-left: -5em;
              padding-left: 6em; }
  .select2-container--material .select2-results__option--highlighted[aria-selected] {
    background-color: #3f729b;
    color: white; }
  .select2-container--material .select2-results__group {
    cursor: default;
    display: block;
    padding: 6px; }

.select2-dropdown {
  background-color: white;
  border: 1px solid #ced4da;
  border-radius: 4px;
  box-sizing: border-box;
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  display: block;
  position: absolute;
  left: -100000px;
  width: 100%;
  z-index: 1051;
  -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12); }

.select2-results {
  display: block; }

.select2-results__options {
  list-style: none;
  margin: 0;
  padding: 0; }

.select2-results__option {
  padding: 6px;
  user-select: none;
  -webkit-user-select: none; }
  .select2-results__option[aria-selected] {
    cursor: pointer; }

.select2-container--open .select2-dropdown {
  left: 0; }

.select2-container--open .select2-dropdown--above {
  border-bottom: none;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0; }

.select2-container--open .select2-dropdown--below {
  border-top: none;
  border-top-left-radius: 0;
  border-top-right-radius: 0; }

.select2-search--dropdown {
  display: block;
  padding: 4px; }
  .select2-search--dropdown .select2-search__field {
    padding: 4px;
    width: 100%;
    box-sizing: border-box; }
    .select2-search--dropdown .select2-search__field::-webkit-search-cancel-button {
      -webkit-appearance: none; }
  .select2-search--dropdown.select2-search--hide {
    display: none; }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          {{-- <a class="navbar-brand brand-logo" href="index.html"><img src="{{ asset('adminassets') }}/assets/images/logo.svg" alt="logo" /></a> --}}
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('adminassets') }}/assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="{{ asset('adminassets') }}/assets/images/faces/face1.jpg" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">Admin</p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="#">

                  <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                    <i class="mdi mdi-logout mr-2 text-primary"></i> Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="{{ asset('adminassets') }}/assets/images/faces/face1.jpg" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">Syamsul Hilal</span>
                  <span class="text-secondary text-small">Admin</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item {{ Request::path() === 'admin' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.pelanggan') }}">
                <span class="menu-title">Pelanggan</span>
                <i class="mdi mdi mdi-account-multiple menu-icon"></i>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
                <span class="menu-title">Data Master</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi mdi-table-large menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic1">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ route('admin.product') }}">Produk</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item ">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Transaksi</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-shopping menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.transaksi') }}">Pesanan Baru</a></li>
{{--                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.transaksi.perludicek') }}">Perlu Di Cek</a></li>--}}
                  <li class="nav-item"> <a class="nav-link" href="{{ route('admin.transaksi.perludikirim') }}">Perlu Di Kirim</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('admin.transaksi.dikirim') }}">Barang Di Kirim</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('admin.transaksi.selesai') }}">Selesai</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('admin.transaksi.dibatalkan') }}">Dibatalkan</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item ">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
                <span class="menu-title">Pengaturan</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-shopping menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic2">
                <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.pengaturan.alamat') }}"> Alamat</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.pengaturan.updateuser') }}"> Edit Profile</a></li>
{{--                  <li class="nav-item"> <a class="nav-link" href="{{ route('admin.rekening') }}">No Rekening</a></li>--}}
                </ul>
              </div>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
         @yield('content')
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
         
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('adminassets') }}/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('adminassets') }}/assets/vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('adminassets') }}/assets/js/off-canvas.js"></script>
    <script src="{{ asset('adminassets') }}/assets/js/hoverable-collapse.js"></script>
    <script src="{{ asset('adminassets') }}/assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('adminassets') }}/assets/js/dashboard.js"></script>
    <script src="{{ asset('adminassets') }}/assets/js/todolist.js"></script>
    <!-- <script src="{{ asset('table/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('table/bootstrap/js/bootstrap.bundle.min.js') }}"></script> -->

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('table/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('table/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('table/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('swal/dist/sweetalert2.min.js') }}"></script>
    <!-- End custom js for this page -->
	
	<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @if(session('status'))
    <script type="text/javascript">
      Swal.fire({
        title: 'Horee ...',
        icon: 'success',
        text: '{{ session("status") }}',
        showClass: {
          popup: 'animated bounceInDown slow'
        },
        hideClass: {
          popup: 'animated bounceOutDown slow'
        }
      })
    </script>
    @endif
    <script>

      var t = $('#table').DataTable({
		  dom: 'Bfrtip',
		  buttons: [
			
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
    </script>
    @yield('js')
  </body>
</html>
