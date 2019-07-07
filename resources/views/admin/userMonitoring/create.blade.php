@extends('admin.index')
@section('content')

<section class="content-header">
  <h1>
    Tambah Akun Monitoring
    <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('admin')}}"><i class="fa fa-user"></i>Admin</a></li>
    <li><a href="{{route('userMonitoring.index')}}">Kelola akun monitoring</a></li>
    <li class="active">Tambah akun monitoring</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form Tambah Akun Monitoring</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="POST" action="{{route('userMonitoring.store')}}">
          {{ csrf_field() }}
          {{ method_field('POST') }}
          <div class="box-body">

            <div class="col-md-6">
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
              <div class="col-md-12">
                &nbsp;
              </div>
            </div>

            <div class="col-md-6">
              @if ($errors->has('password'))
              <div class="form-group has-error col-md-12">
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" name="password" id="password" rows="3" placeholder="Password..." required>
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                </div>
                <span class="help-block">{{ $errors->first('password') }}</span>
              </div>
              @else
              <div class="form-group col-md-12">
              <label for="password">Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" name="password" id="password" rows="3" placeholder="Password..." required>
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                </div>
              </div>
              @endif

              @if ($errors->has('password_confirmation'))
              <div class="form-group has-error col-md-12">
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Konfirmasi Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" rows="3" placeholder="Ketik Ulang Password..." required>
                  <span class="input-group-addon"><i class="fa fa-keyboard-o"></i></span>
                </div>
                <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
              </div>
              @else
              <div class="form-group col-md-12">
              <label for="password">Konfirmasi Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" rows="3" placeholder="Konfirmasi Password...">
                  <span class="input-group-addon"><i class="fa fa-keyboard-o"></i></span>
                </div>
              </div>
              @endif
          </div>

          </div>

          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
      </div>

  </div>
</section>

@endsection
