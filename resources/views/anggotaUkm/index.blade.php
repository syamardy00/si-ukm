<!DOCTYPE html>
<html>
<head>
@include('layout.head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <!-- loading -->
  <div class="preloader">
    <div class="loading">
      <img src="{{url('/foto/loading.gif')}}" width="400">
      <p><b>Harap Tunggu</b></p>
    </div>
  </div>
  <!-- end loading -->
  <div class="wrapper">

    <!-- sesuaikan -->
    @include('anggotaUkm.header')
    @include('anggotaUkm.sidebar')

      <div class="content-wrapper">

        @if($profil[0]->email == '')
        <br>
          <div class="col-md-12">
            <div class="alert alert-warning alert-dismissible" style="border-left:10px solid #C87F0A;"> 
              <h4><i class="icon fa fa-info"></i> Penting !</h4>
              Lengkapi profil anda, segera ganti <b>Password</b> yang diberikan oleh Admin UKM,
              Tambahkan <b>Email Aktif</b> untuk mempermudah proses jika terjadi lupa password. Klik menu <b>Profil Saya</b>.
            </div>
          </div>
        <div style="clear:both; margin-bottom:-20px;"></div>
        @endif
        @yield('content')
      </div>

    @include('layout.footer')
    @include('layout.control-slidebar')

    <div class="control-sidebar-bg"></div>
  </div>
  @include('layout.script')
</body>
</html>
