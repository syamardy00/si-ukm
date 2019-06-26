<!DOCTYPE html>
<html>
<head>
@include('adminlte.head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
@include('adminlte.header')
  <!-- Left side column. contains the logo and sidebar -->
@include('adminlte.sidebar')

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  @yield('content')
</div>
  <!-- /.content-wrapper -->
@include('adminlte.footer')

  <!-- Control Sidebar -->
@include('adminlte.control-slidebar')
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
@include('adminlte.script')

</body>
</html>
