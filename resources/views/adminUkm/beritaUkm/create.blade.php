@extends('adminUkm.index')
@section('content')


<link rel="stylesheet" href="{{url('/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
<link rel="stylesheet" href="{{url('/assets/dist/css/skins/_all-skins.min.css')}}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{url('/assets/plugins/iCheck/all.css')}}">
<!-- bootstrap wysihtml5 - text editor -->

  <section class="content-header">
  <h1>
    Tambah Berita Ukm
    <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('beritaUkm.index')}}"><i class="fa fa-user"></i>Berita Ukm</a></li>
    <li class="active">Tambah Berita Ukm</li>
  </ol>
  </section>

  <section class="content">
    <div class="row">

      <div class="col-md-12">
        <!-- general form elements -->
        <form method="POST" action="{{route('beritaUkm.store')}}" enctype="multipart/form-data">
          {{ csrf_field() }}
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Form Tambah Berita</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
            <div class="box-body">

              @if ($errors->has('judul_berita'))
              <div class="form-group has-error col-md-9">
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Judul Berita</label>
                  <input type="text" class="form-control" id="judul_berita" name="judul_berita" placeholder="Judul Berita..." value="{{old('judul_berita')}}" required>
                <span class="help-block">{{ $errors->first('judul_berita') }}</span>
              </div>
              @else
              <div class="form-group col-md-9">
                <label for="username">Judul Berita</label>
                  <input type="text" class="form-control" id="judul_berita" name="judul_berita" placeholder="Judul Berita..." value="{{old('judul_berita')}}" required>
              </div>
              @endif

              <div class="form-group col-md-3">
                <label>Sifat Berita</label>
                <div class="input-group col-md-12" style="padding-top:5px; padding-left:10px; padding-right:5px;">
                  <label>
                    <input type="radio" name="sifat_berita" value="internal" class="flat-red" checked>
                    Internal
                  </label>
                  &nbsp; &nbsp; &nbsp;
                  <label>
                    <input type="radio" name="sifat_berita" value="umum" class="flat-red">
                    Umum
                  </label>
                </div>
              </div>

              <div class="form-group col-md-12">
                <label for="isi_berita">Isi Berita</label>
                  <textarea name="isi_berita" id="editor1" placeholder="Isi Berita ..." required
                            style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('isi_berita')}}</textarea>
              </div>

            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Simpan Berita</button>
            </div>
        </div>
      </form>
      </div>

    </div>
  </section>

@endsection

@section('js')
<script src="{{url('/assets/bower_components/ckeditor/ckeditor.js')}}"></script>
<script src="{{url('/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{url('/assets/plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })

  //iCheck for checkbox and radio inputs
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass   : 'iradio_minimal-blue'
  })
  //Red color scheme for iCheck
  $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
    checkboxClass: 'icheckbox_minimal-red',
    radioClass   : 'iradio_minimal-red'
  })
  //Flat red color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass   : 'iradio_flat-green'
  })


</script>
@stop
