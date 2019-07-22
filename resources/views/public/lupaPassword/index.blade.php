<!DOCTYPE html>
<html>
<head>
@include('layout.head')
</head>
<body class="hold-transition skin-blue sidebar-mini" style="background:#ECF0F5;">
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
    <div class="wrapper" style="background:#ECF0F5;">
      <section class="content-header">
      <h1>
        &nbsp;
      </h1>
      <ol class="breadcrumb">
          <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
        <li class="active">Lupa Password</li>
      </ol>
      </section>

      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Lupa Password</h3>
              </div>
              <div class="box-body">
                @if(Session::has('gagal'))
                  <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" style="border-left:10px solid #C23321;">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fa fa-ban"></i> Operasi Gagal!</h4>
                      {{Session::get('gagal')}}
                    </div>
                  </div>
                @endif
                <div class="col-md-12">
                  <div class="col-md-5" style="float:right;">
                    <blockquote>
                      <p>Info</p>
                      <small>Fitur lupa password berikut hanya tersedia bagi pemilik akun <b>Anggota UKM</b> saja.
                      Bagi pemilik akun Admin UKM dan Monitoring silahkan hubungi langsung pihak Admin.</small>
                      <br>
                      <small>Silahkan masukan <b>Username</b> dan <b>Email</b> yang terdaftar. Password baru akan dikirimkan melalui Email.</small>
                    </blockquote>
                  </div>
                  <div class="col-md-7" style="float:right;">
                    <form action="{{route('guest.kirimEmailPassword')}}" method="post">
                      {{ csrf_field() }}
                      <div class="form-group col-md-12">
                        <label for="username">Username</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="username" name="username" placeholder="Username..." pattern="[a-zA-Z0-9._]+" required>
                          <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <label for="nim">Email</label>
                        <div class="input-group">
                          <input type="email" class="form-control" id="email" name="email" placeholder="Email..." required>
                          <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div class="pull-right">
                          <button type="submit" class="btn btn-primary">Reset Password</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
  </div>

  <footer class="main-footer" style="width:100%; left:0; margin-left:0px; bottom:0; position: fixed;">
    <div class="pull-right hidden-xs">
      Sistem Informasi UKM - <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2019 Syam Ardy | Teknik Informatika | Politeknik TEDC Bandung.</strong> All rights
    reserved.
  </footer>
@include('layout.script')
