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
        <div class="row" style="height:400px;">
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


  <footer class="main-footer col-md-12" style="width:100%; left:0; margin-left:0px; bottom:0; background:#1A2226; color:white;">
    <div class="col-md-3" style="border-right:2px solid #3C8DBC; text-align:center; margin-top:5px;">
        <img src="{{url('/foto/footer.png')}}" class="col-md-7" style="text-align:center; position:center;">
    </div>

    <div class="col-md-6" style="text-align:center; margin-top:5px; padding-bottom:10px;">
      <h3>Sistem Informasi Unit Kegiatan Mahasiswa</h3>
      <hr>
      Copyright &copy; 2019 Syam Ardy | Teknik Informatika | Politeknik TEDC Bandung. All rights reserved.
    </div>

    <div class="col-md-3" style="text-align:right; border-left:2px solid #3C8DBC; margin-top:5px;">
      <b style="color:#3C8DBC">Politeknik TEDC Bandung</b><br>
      Jl. Politeknik - Pasantren Km 2<br>
      Cibabat - Cimahi Utara<br>
      Kota Cimahi - Indonesia<br>
      Kode Pos 40513<br>
      Telepon +6222-6645951<br>
      Email info@poltektedc.ac.id
    </div>

  </footer>
  </div>
@include('layout.script')
