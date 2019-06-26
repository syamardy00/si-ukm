@extends('adminUkm.index')
@section('content')

<link rel="stylesheet" href="{{url('/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
<link rel="stylesheet" href="{{url('/assets/dist/css/skins/_all-skins.min.css')}}">
<link rel="stylesheet" href="{{url('/assets/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
<!-- bootstrap datepicker -->

  <section class="content-header">
  <h1>
    Edit Program Kerja
    <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('prokerUkm.index')}}"><i class="fa fa-user"></i>Program Kerja</a></li>
    <li class="active">Edit Proker</li>
  </ol>
  </section>

  <section class="content">
    <form method="POST" action="{{route('prokerUkm.update', $proker[0]['id'])}}" enctype="multipart/form-data">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
      <div class="row">
        <div class="col-md-9">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Edit Program Kerja Ukm</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">

                @if ($errors->has('nama_proker'))
                <div class="form-group has-error col-md-9">
                  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Username</label>
                  <div class="input-group col-md-12">
                    <input type="text" class="form-control" id="nama_proker" name="nama_proker" placeholder="Nama Program Kerja..." value="{{old('nama_proker')}}" required>
                  </div>
                  <span class="help-block">{{ $errors->first('nama_proker') }}</span>
                </div>
                @else
                <div class="form-group col-md-9">
                  <label for="nama_proker">Nama Program Kerja</label>
                  <div class="input-group col-md-12">
                    <input type="text" class="form-control" id="nama_proker" name="nama_proker" placeholder="Nama Program Kerja..." value="{{$proker[0]['nama_proker']}}" required>
                  </div>
                </div>
                @endif

                <div class="form-group col-md-3">
                  <label>Tanggal Kegitan</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="tgl_kegiatan" name="tgl_kegiatan" placeholder="Tanggal Kegiatan..." value="{{$proker[0]['tgl_kegiatan']}}" required>
                  </div>
                </div>

                <div class="form-group col-md-12">
                  <label>Sekilas Deskrpisi Program Kerja</label>
                  <div class="input-group col-md-12">
                    <textarea name="deskripsi" id="" placeholder="Sekilas Deskripsi Program Kerja ..." required
                              style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$proker[0]['deskripsi']}}</textarea>
                  </div>
                </div>


              </div>
              <div class="box-footer">
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </div>
          </div>
        </div>

        @if($proker[0]['proposal'] == null)
        <div class="col-md-3">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Upload Proposal</h3>
            </div>
            <div class="box-body">
              <span>Silahkan upload file proposal program kerja dalam format <b>.PDF</b>, Upload proposal bisa dilakukan nanti atau menyusul.</span><br></br>
              <input type="file" name="proposal" value="{{old('proposal')}}" id="" class="btn btn-primary col-md-12">
            </div>
          </div>
        </div>
        @else
          <div class="col-md-3">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Ubah Proposal</h3>
              </div>
              <div class="box-body">
                <span>Silahkan upload file proposal terbaru berbentuk <b>.PDF</b> jika ingin merubah proposal, abaikan form ini jika tidak ingin merubah proposal</span><br></br>
                <input type="file" name="proposal" value="{{old('proposal')}}" id="" class="btn btn-primary col-md-12">
              </div>
            </div>
          </div>

            @if($proker[0]['laporan'] == null)
            <div class="col-md-3">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Upload Laporan</h3>
                </div>
                <div class="box-body">
                  <span>Silahkan upload file laporan dalam format <b>.PDF</b>, Upload laporan bisa dilakukan nanti atau menyusul.</span><br></br>
                  <input type="file" name="laporan" value="{{old('laporan')}}" id="" class="btn btn-primary col-md-12">
                </div>
              </div>
            </div>
            @else
              <div class="col-md-3">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Ubah Laporan</h3>
                  </div>
                  <div class="box-body">
                    <span>Silahkan upload file laporan terbaru berbentuk <b>.PDF</b> jika ingin merubah laporan, abaikan form ini jika tidak ingin merubah laporan</span><br></br>
                    <input type="file" name="laporan" value="{{old('laporan')}}" id="" class="btn btn-primary col-md-12">
                  </div>
                </div>
              </div>
            @endif
        @endif


      </div>
    </form>
  </section>

@endsection

@section('js')
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
<script>
  $(function (){
    $('#tgl_kegiatan').datepicker({
      locale:"id",
      autoclose: true,
      format: "yyyy-m-d"
    })
  })
</script>
@stop
