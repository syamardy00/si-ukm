@extends('adminUkm.index')
@section('content')

<link rel="stylesheet" href="{{url('/assets/bower_components/Ionicons/css/ionicons.min.css')}}">
<!-- daterange picker -->
<link rel="stylesheet" href="{{url('/assets/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{url('/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{url('/assets/plugins/iCheck/all.css')}}">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="{{url('/assets/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{url('/assets/plugins/timepicker/bootstrap-timepicker.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{url('/assets/bower_components/select2/dist/css/select2.min.css')}}">

  <section class="content-header">
  <h1>
    Tambah Anggota Ukm
    <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('anggotaUkm.index')}}"><i class="fa fa-user"></i>Anggota Ukm</a></li>
    <li class="active">Tambah Anggota Ukm</li>
  </ol>
  </section>

  <section class="content">
    <form method="POST" action="{{route('anggotaUkm.store')}}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-md-9">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Tambah Anggota Ukm</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">

                @if ($errors->has('username'))
                <div class="form-group has-error col-md-6">
                  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Username</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="username" name="username" pattern="[a-zA-Z0-9._]+"  placeholder="Username..." value="{{old('username')}}" required>
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  </div>
                  <span class="help-block">{{ $errors->first('username') }}</span>
                </div>
                @else
                <div class="form-group col-md-6">
                  <label for="username">Username</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="username" name="username" pattern="[a-zA-Z0-9._]+"  placeholder="Username..." value="{{old('username')}}" required>
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  </div>
                </div>
                @endif

                @if ($errors->has('password'))
                <div class="form-group has-error col-md-6">
                  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password..." required>
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  </div>
                  <span class="help-block">{{ $errors->first('password') }}</span>
                </div>
                @else
                <div class="form-group col-md-6">
                  <label for="password">Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password..." required>
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  </div>
                </div>
                @endif

                <div class="form-group has-error col-md-6">
                  &nbsp;
                </div>

                @if ($errors->has('password_confirmation'))
                <div class="form-group has-error col-md-6">
                  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Konfirmasi Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" rows="3" placeholder="Ketik Ulang Password...">
                    <span class="input-group-addon"><i class="fa fa-keyboard-o"></i></span>
                  </div>
                  <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                </div>
                @else
                <div class="form-group col-md-6">
                <label for="password">Konfirmasi Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" rows="3" placeholder="Konfirmasi Password...">
                    <span class="input-group-addon"><i class="fa fa-keyboard-o"></i></span>
                  </div>
                </div>
                @endif


                <div style="clear: both";></div>
                <hr>

                <div class="row">

                  @if ($errors->has('nim'))
                  <div class="form-group has-error col-md-6">
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> NIM</label>
                      <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM..." value="{{old('nim')}}" required>
                    <span class="help-block">{{ $errors->first('nim') }}</span>
                  </div>
                  @else
                  <div class="form-group col-md-6">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM..." value="{{old('nim')}}" required>
                  </div>
                  @endif

                  @if ($errors->has('nama'))
                  <div class="form-group has-error col-md-6">
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Nama Lengkap</label>
                      <input type="text" class="form-control" id="nama_lengkap" name="nama" placeholder="Nama Lengkap..." value="{{old('nama')}}" required>
                    <span class="help-block">{{ $errors->first('nama') }}</span>
                  </div>
                  @else
                  <div class="form-group col-md-6">
                    <label for="nim">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama" placeholder="Nama Lengkap..." value="{{old('nama')}}" required>
                  </div>
                  @endif

                </div>
                <div class="row">

                  <div class="form-group col-md-6">
                    <label>Jenis Kelamin</label>
                    <div class="input-group col-md-12" style="padding-top:5px; border:1px solid #D2D6DE; padding-left:10px; padding-right:5px;">
                      <label>
                        <input type="radio" name="jenis_kelamin" value="Laki-Laki" class="flat-red" checked>
                        Laki-Laki
                      </label>
                      &nbsp; &nbsp; &nbsp;
                      <label>
                        <input type="radio" name="jenis_kelamin" value="Perempuan" class="flat-red">
                        Perempuan
                      </label>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label>Tanggal Lahir</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="tanggal_lahir" name="tgl_lahir" placeholder="Tanggal Lahir..." value="{{old('tgl_lahir')}}" required>
                    </div>
                  </div>

                </div>
                <div class="row">

                  @if ($errors->has('no_telepon'))
                  <div class="form-group has-error col-md-6">
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> No Telepon</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                      <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="No Telepon..." value="{{old('no_telepon')}}" data-inputmask='"mask": "9999-9999-9999"' data-mask required>
                    </div>
                    <span class="help-block">{{ $errors->first('no_telepon') }}</span>
                  </div>
                  @else
                  <div class="form-group col-md-6">
                    <label for="nim">No Telepon</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                      <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="No Telepon..." value="{{old('no_telepon')}}" data-inputmask='"mask": "9999-9999-9999"' data-mask required>
                    </div>
                  </div>
                  @endif

                  @if ($errors->has('id_jurusan'))
                  <div class="form-group has-error col-md-6">
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Jurusan</label>
                    <div class="input-group col-md-12">
                      <select class="form-control select2" id="jurusan" name="id_jurusan">
                        @foreach($jurusan as $j)
                          <option value="{{$j->id}}">{{$j->nama_jurusan}}</option>
                        @endforeach
                      </select>
                    </div>
                    <span class="help-block">{{ $errors->first('id_jurusan') }}</span>
                  </div>
                  @else
                  <div class="form-group col-md-6">
                    <label for="nim">Jurusan</label>
                    <div class="input-group col-md-12">
                      <select class="form-control select2" id="jurusan" name="id_jurusan">
                        @foreach($jurusan as $j)
                          <option value="{{$j->id}}">{{$j->nama_jurusan}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  @endif

                </div>
                <div class="row">

                  <div class="form-group col-md-6">
                    <label>Tahun Angkatan</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker" name="tahun_angkatan" placeholder="Tahun Angkatan..." value="{{old('tahun_angkatan')}}" required>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label>Status Keanggotaan</label>
                    <div class="input-group col-md-12" style="padding-top:5px; border:1px solid #D2D6DE; padding-left:10px; padding-right:5px;">
                      <label>
                        <input type="radio" name="status" value="Aktif" class="flat-red" checked>
                        Aktif
                      </label>
                      &nbsp; &nbsp; &nbsp;
                      <label>
                        <input type="radio" name="status" value="Alumni" class="flat-red">
                        Alumni
                      </label>
                    </div>
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

        <div class="col-md-3">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Foto</h3>
            </div>
            <div class="box-body">
              <img class="img-square" id="foto" src="{{url('/foto/default-user.png')}}" alt="Logo UKM" style="width: 100%;">
              <hr>
              <input type="file" name="foto" value="{{old('foto')}}" id="previewFoto" class="btn btn-primary col-md-12">
            </div>
          </div>
        </div>

      </div>
    </form>
  </section>
@endsection

@section('js')
<!-- InputMask -->
<script src="{{url('/assets/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{url('/assets/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{url('/assets/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<!-- date-range-picker -->
<script src="{{url('/assets/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{url('/assets/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{url('/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('/assets/bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{url('/assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{url('/assets/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{url('/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{url('/assets/plugins/iCheck/icheck.min.js')}}"></script>
<!-- FastClick -->
<script src="{{url('/assets/bower_components/fastclick/lib/fastclick.js')}}"></script>

<script src="{{url('assets/bower_components/select2/dist/js/select2.full.min.js')}}"></script>


<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      locale:"id",
      autoclose: true,
      format: "yyyy",
      viewMode : "years",
      minViewMode: "years"
    })

    $('#tanggal_lahir').datepicker({
      locale:"id",
      autoclose: true,
      format: "yyyy-m-d"
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

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })

  function bacaFoto(input){
    if(input.files && input.files[0]){
      var reader = new FileReader();

      reader.onload = function(e){
        $('#foto').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);

    }
  }

  $('#previewFoto').change(function(){
    bacaFoto(this);
  });
</script>
@stop
