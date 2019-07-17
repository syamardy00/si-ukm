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
    @include('public.header')
    @include('public.sidebar')

      <div class="content-wrapper">
        @yield('content')

        <div class="modal modal-danger fade" id="modal-pendaftaran-ditutup">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Form Pendaftaran Tidak Aktif</h4>
              </div>
              <div class="modal-body">
                <p>Form pendaftaran UKM ini sedang tidak aktif atau ditutup, hubungi
                  kontak UKM untuk informasi lebih lanjut mengenai pendaftaran.</p>
              </div>
              <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-outline">Tutup</button>
              </div>
            </div>
          </div>
        </div>

      </div>

    @include('layout.footer')
    @include('layout.control-slidebar')

    <div class="control-sidebar-bg"></div>
  </div>
  @include('layout.script')
  <script>
    $(document).ready(function() {
      var nice = $("html").niceScroll({cursorcolor:"#3C8DBC", cursorwidth: '7.5px', autohidemode: true, bouncescroll:true});
    });
  </script>
</body>
</html>
