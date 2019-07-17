@extends('admin.index')
@section('content')

<link rel="stylesheet" href="{{url('/assets/dist/css/skins/_all-skins.min.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{url('/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

<section class="content-header">
<h1>
  Tambah Ukm Baru
  <!-- <small>Lihat Profil UKM</small> -->
</h1>
<ol class="breadcrumb">
  <li><a href="{{route('admin')}}"><i class="fa fa-user"></i>Admin</a></li>
  <li class="active">Tambah UKM Baru</li>
</ol>
</section>

<section class="content">
  <div class="row">

    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form Tambah UKM</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="POST" action="{{route('ukm.store')}}">
          {{ csrf_field() }}
          <div class="box-body">

            <div class="col-md-6">
              @if ($errors->has('nama_ukm'))
              <div class="form-group has-error col-md-12">
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Nama UKM</label>
                  <input type="text" class="form-control" id="nama_ukm" name="nama_ukm" placeholder="Nama UKM..." style="width: 400px;" value="{{old('nama_ukm')}}" required>
                <span class="help-block">{{ $errors->first('nama_ukm') }}</span>
              </div>
              @else
              <div class="form-group col-md-12">
                <label for="namaUkm">Nama UKM</label>
                <input type="text" class="form-control" id="nama_ukm" name="nama_ukm" placeholder="Nama UKM..." style="width: 400px;" value="{{old('nama_ukm')}}" required>
              </div>
              @endif
            </div>

            <div style="clear:both;"></div>
            <hr>
            <div class="box-header">
              <h3 class="box-title">Akun Admin UKM</h3>
              <h6>Buat akun admin untuk mengelola data UKM</h6>
            </div>

            <div class="col-md-6">
              @if ($errors->has('username'))
              <div class="form-group has-error col-md-12">
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Username</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username..." pattern="[a-zA-Z0-9._]+" value="{{old('username')}}" required>
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                </div>
                <span class="help-block">{{ $errors->first('username') }}</span>
              </div>
              @else
              <div class="form-group col-md-12">
                <label for="username">Username</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username..." pattern="[a-zA-Z0-9._]+" value="{{old('username')}}" required>
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                </div>
              </div>
              @endif
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
                  <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" rows="3" placeholder="Password..." required>
                  <span class="input-group-addon"><i class="fa fa-keyboard-o"></i></span>
                </div>
                <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
              </div>
              @else
              <div class="form-group col-md-12">
              <label for="password">Konfirmasi Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" rows="3" placeholder="Konfirmasi Password..." required>
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
  </form>

  </div>
</section>


<script src="{{url('/assets/bower_components/ckeditor/ckeditor.js')}}"></script>
<script src="{{url('/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
@endsection
