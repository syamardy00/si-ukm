<!DOCTYPE html>
<html>
<head>
@include('layout.head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- sesuaikan -->
    @include('admin.header')
    @include('admin.sidebar')

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
