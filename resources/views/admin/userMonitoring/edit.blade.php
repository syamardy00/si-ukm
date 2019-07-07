@extends('admin.index')
@section('content')

@foreach($dUser as $u)
<section class="content-header">
  <h1>
    Edit Akun Monitoring
    <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('admin')}}"><i class="fa fa-user"></i>Admin</a></li>
    <li><a href="{{route('userMonitoring.index')}}">Kelola akun monitoring</a></li>
    <li class="active">Edit akun monitoring</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form Edit Akun Monitoring</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="POST" action="{{route('userMonitoring.update', $u->id)}}">
          {{ csrf_field() }}
          {{ method_field('PATCH') }}
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
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username..." value="{{$u->username}}" required>
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                </div>
              </div>
              @endif
              <div class="col-md-12">
                <p class="text-yellow">Kosongkan inputan "Password Baru" dan "Ketik Ulang Password Baru" jika tidak ingin merubah ubah password.</p>
              </div>
            </div>

            <div class="col-md-6">
              @if ($errors->has('passwordBaru'))
              <div class="form-group has-error col-md-12">
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Password Baru</label>
                <div class="input-group">
                  <input type="password" class="form-control" name="passwordBaru" id="passwordBaru" rows="3" placeholder="Password...">
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                </div>
                <span class="help-block">{{ $errors->first('passwordBaru') }}</span>
              </div>
              @else
              <div class="form-group col-md-12">
              <label for="password">Password Baru</label>
                <div class="input-group">
                  <input type="password" class="form-control" name="passwordBaru" id="passwordBaru" rows="3" placeholder="Password...">
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                </div>
              </div>
              @endif

              @if ($errors->has('passwordBaru_confirmation'))
              <div class="form-group has-error col-md-12">
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Konfirmasi Password Baru</label>
                <div class="input-group">
                  <input type="password" class="form-control" name="passwordBaru_confirmation" id="passwordBaru_confirmation" rows="3" placeholder="Ketik Ulang Password Baru...">
                  <span class="input-group-addon"><i class="fa fa-keyboard-o"></i></span>
                </div>
                <span class="help-block">{{ $errors->first('passwordBaru_confirmation') }}</span>
              </div>
              @else
              <div class="form-group col-md-12">
              <label for="password">Konfirmasi Password Baru</label>
                <div class="input-group">
                  <input type="password" class="form-control" name="passwordBaru_confirmation" id="passwordBaru_confirmation" rows="3" placeholder="Konfirmasi Password...">
                  <span class="input-group-addon"><i class="fa fa-keyboard-o"></i></span>
                </div>
              </div>
              @endif
          </div>

          </div>

          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
      </div>

  </div>
</section>

@endforeach
@endsection
