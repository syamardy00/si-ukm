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
    @include('adminUkm.header')
    @include('adminUkm.sidebar')

      <div class="content-wrapper">
        @yield('content')
      </div>

    @include('layout.footer')
    @include('layout.control-slidebar')

    <div class="control-sidebar-bg"></div>
  </div>
  @include('layout.script')
</body>
</html>
