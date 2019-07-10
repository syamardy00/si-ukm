<!DOCTYPE html>
<html>
<head>
@include('layout.head')

<style>

  .box-header-back{
    width:100%;
    min-height:600px;
    background:url('/foto/background.jpg');
    background-size:cover;
    background-attachment:fixed;
    text-align:center;
    color:white;
  }

  .box-judul{
    color:white;
    font-size:40pt;
    text-align:center;
  }

  .box-sub-judul{
    color:white;
    font-size:25pt;
    text-align:center;
  }

  .box-logo{
    width:150px;
    height:150px;
    margin-top:100px;
    margin-right:10px;
    margin-bottom:20px;
  }

  .box-link{
    margin-top:150px;
    color:white;
    text-decoration:none;
    text-align:center;
    bottom:50px;
  }

  .box-link a{
    color:white;
    text-decoration:none;
  }

  .example-modal .modal {
    position: relative;
    top: auto;
    bottom: auto;
    right: auto;
    left: auto;
    display: block;
    z-index: 1;
  }

  .example-modal .modal {
    background: transparent !important;
  }
  .tambah {
    color:white;
    transition: ease-in-out 1;
  }

  .tambah a{
    color:white;
    transition: ease-in-out 1;
  }

  .tambah a:hover{
    color:#3C8DBC;
    transition: ease-in-out 1;
  }

  .shadow:hover{
    box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.75);
    transition: ease-in-out 1;
  }



</style>


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

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b></b>UKM</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SI - </b>UKM</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <!-- <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a> -->

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="{{url('/login')}}" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa"></i> Helo, Silahkan Login Disini
              <!-- <span class="hidden-xs">Login</span> -->
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header" style="height:170px; padding:0px; padding-top:10px;">
                <div class="col-md-12">
                  <div class="box box-primary">
                    <div class="box-body">
                      <br>
                      <form action="{{route('login')}}" method="post">
                      {{ csrf_field() }}
                      @if ($errors->has('username'))
                      <div class="form-group has-error col-md-12">
                        <div class="input-group">
                          <input type="text" class="form-control" id="username" name="username" placeholder="Username..." value="{{old('username')}}" required>
                          <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        </div>
                        <span class="help-block">{{ $errors->first('username') }}</span>
                      </div>
                      @else
                      <div class="form-group col-md-12">
                        <div class="input-group">
                          <input type="text" class="form-control" id="username" name="username" placeholder="Username..." value="{{old('username')}}" required>
                          <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        </div>
                      </div>
                      @endif

                      @if ($errors->has('password'))
                      <div class="form-group has-error col-md-12">
                        <div class="input-group">
                          <input type="password" class="form-control" id="password" name="password" placeholder="Password..." required>
                          <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        </div>
                        <span class="help-block">{{ $errors->first('password') }}</span>
                      </div>
                      @else
                      <div class="form-group col-md-12">
                        <div class="input-group">
                          <input type="password" class="form-control" id="password" name="password" placeholder="Password..." required>
                          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        </div>
                      </div>
                      @endif

                    </div>
                  </div>
                </div>

              </li>
              <li class="user-footer">
                <div class="pull-right">
                  <button type="submit" class="btn btn-default btn-flat">Masuk</button>
                </div>
              </li>
            </form>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <div class="wrapper" style="background:#ECF0F5;">

    @if(Session::has('error'))
      <div class="row" style="margin:0px; background:red; left:0; right:0; margin-bottom:-20px; text-align:center;">
        <div class="alert alert-danger alert-dismissible" style="border-left:10px solid #DD4B39;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-ban"></i>Login Gagal !</h4>
          {{Session::get('error')}}
        </div>
      </div>
    @endif

    <div class="box-header-back">
      <div class="col-md-12">
        <img src="{{url('/foto/si-ukm-full.png')}}" class="box-logo">
        <img src="{{url('/foto/logo-tedc.png')}}" class="box-logo">
      </div>
      <div class="col-md-12 box-judul">
        Sistem Informasi Unit Kegiatan Mahasiswa<br>
        <span class="box-sub-judul" style="margin-top:0px;">Politeknik TEDC Bandung</span>
      </div>
      <div class="col-md-12 box-link">
        <span><a href="https://instagram.com/syam.ardy_">Syam Ardy Bangun Putra</a> &nbsp; . &nbsp; Sistem Informasi UKM &nbsp; . &nbsp; Version 1.0</span>
      </div>
    </div>

    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-primary">
            <div class="box-body">
              <blockquote>
                <p>Login</p>
                <small>Silahkan masuk bagi pemilik akun Anggota UKM, Admin UKM dan Monitoring terdaftar.</small>
              </blockquote>
              <form action="{{route('login')}}" method="post">
              {{ csrf_field() }}

              @if ($errors->has('username'))
              <div class="form-group has-error col-md-12">
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Username</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username..." value="{{old('username')}}" required>
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                </div>
                <span class="help-block">{{ $errors->first('username') }}</span>
              </div>
              @else
              <div class="form-group col-md-12">
                <label for="username">Username</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username..." value="{{old('username')}}" required>
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                </div>
              </div>
              @endif

              @if ($errors->has('password'))
              <div class="form-group has-error col-md-12">
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password..." required>
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                </div>
                <span class="help-block">{{ $errors->first('password') }}</span>
              </div>
              @else
              <div class="form-group col-md-12">
                <label for="password">Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password..." required>
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                </div>
              </div>
              @endif

            </div>
            <div class="box-footer">
              <div class="pull-right">
                <button type="submit" class="btn btn-primary">Masuk</button>
              </div>
            </div>
          </form>
          </div>
        </div>

        <div class="col-md-9">
          <div class="box box-primary">
            <!-- <div class="box-header with-border">
              <h3 class="box-title">UKM Lainya</h3>
            </div> -->
            <div class="box-body">
              <blockquote>
                <p>UKM</p>
                <small>Berikut adalah UKM yang ada di Politeknik TEDC Bandung.</small>
              </blockquote>

              @foreach($ukm as $u)

              <div class="col-md-4">
                <div class="small-box shadow" style="background:#3A3F4B; color:#fff;">
                  <div class="inner">
                    @if($u->logo_ukm)
                      <div class="widget-user-image img-rounded" style="text-align: right; right:20px; text-align:center; height:150px; width:100%;
                      background:url({{url($u->logo_ukm)}}); background-size:cover; background-position:center; margin-bottom:5px;">
                      </div>
                    @else
                      <div class="widget-user-image img-rounded" style="text-align: right; right:20px; text-align:center; height:150px; width:100%;
                      background:url({{url('/foto/default-image.png')}}); background-size:cover; background-position:center; margin-bottom:5px;">
                      </div>
                    @endif
                    <font style="font-size:11pt; font-weight:bold;"><center>{{substr($u->nama_ukm, 0, 33)}}</center></font>
                  </div>
                  <!-- <div class="icon">
                    <i class="fa fa-user"></i>
                  </div> -->
                  <div class="small-box-footer" style="padding:4px;">
                    <a href="{{route('guest.profilUkm.index', $u->id)}}" class="btn btn-flat btn-xs" style="width:100%; background:#3A3F4B; color:#fff;">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>


      </div>
    </section>



  </div>
  <!-- tutup wraper -->

  <footer class="main-footer" style="width:100%; left:0; margin-left:0px; bottom:0;">
    <div class="pull-right hidden-xs">
      Sistem Informasi UKM - <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2019 Syam Ardy | Teknik Informatika | Politeknik TEDC Bandung.</strong> All rights
    reserved.
  </footer>

  @include('layout.script')
</body>
</html>
