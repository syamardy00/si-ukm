<!DOCTYPE html>
<html>
<head>
@include('layout.head')
</head>
<body class="hold-transition skin-black sidebar-mini">
  <div class="wrapper">
    @include('layout.header')
    @include('layout.sidebar')

      <div class="content-wrapper" id="scroll">
        @yield('content')
      </div>

    @include('layout.footer')
    @include('layout.control-slidebar')

    <div class="control-sidebar-bg"></div>
  </div>
  @include('layout.script')
  @section('js')

  @stop
</body>
</html>
