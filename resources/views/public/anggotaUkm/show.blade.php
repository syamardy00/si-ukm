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
    Detail Anggota Ukm
    <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    @if(Auth::guard('anggotaUkm')->check())
      <li><a href="{{route('anggotaUkm.ukm.dashboardProfilUkm')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    @elseif(Auth::guard('monitoring')->check())
      <li><a href="#"><i class="fa fa-tv"></i>Monitoring</a></li>
    @endif
    <li class="active">Detail</li>
  </ol>
  </section>

  <section class="content">
    @foreach($anggota as $a)
      <div class="row">
        <div class="col-md-9">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Anggota UKM</h3>
              <a href="{{route('public.anggotaUkm.cetak_pdf', $a->id_anggota)}}" class="btn btn-xs btn-primary pull-right">Simpan PDF &nbsp; <i class="fa fa-file-pdf-o"></i></a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="row">

                  <div class="form-group col-md-6">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM..." value="{{$a->nim}}" disabled>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="nim">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama" placeholder="Nama Lengkap..." value="{{$a->nama}}" disabled>
                  </div>

                </div>
                <div class="row">

                  <div class="form-group col-md-6">
                    <label>Jenis Kelamin</label>
                    <div class="input-group col-md-12" style="padding-top:5px; border:1px solid #D2D6DE; padding-left:10px; padding-right:5px;">
                      @if($a->jenis_kelamin == 'Laki-Laki')
                        <label>
                          <input type="radio" name="jenis_kelamin" value="Laki-Laki" class="flat-red" checked>
                          Laki-Laki
                        </label>
                        &nbsp; &nbsp; &nbsp;
                        <label>
                          <input type="radio" name="jenis_kelamin" value="Perempuan" class="flat-red" disabled>
                          Perempuan
                        </label>
                      @else
                        <label>
                          <input type="radio" name="jenis_kelamin" value="Laki-Laki" class="flat-red" disabled>
                          Laki-Laki
                        </label>
                        &nbsp; &nbsp; &nbsp;
                        <label>
                          <input type="radio" name="jenis_kelamin" value="Perempuan" class="flat-red" checked>
                          Perempuan
                        </label>
                      @endif
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label>Tanggal Lahir</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="tanggal_lahir" name="tgl_lahir" placeholder="Tanggal Lahir..." value="{{$a->tgl_lahir}}" disabled>
                    </div>
                  </div>

                </div>
                <div class="row">

                  <div class="form-group col-md-6">
                    <label for="nim">No Telepon</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                      <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="No Telepon..." value="{{$a->no_telepon}}" data-inputmask='"mask": "9999-9999-9999"' data-mask disabled>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="nim">Email</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$a->email}}" disabled>
                    </div>
                  </div>

                </div>
                <div class="row">

                  <div class="form-group col-md-6">
                    <label for="nim">Jurusan</label>
                    <div class="input-group col-md-12">
                      <select class="form-control select2" id="jurusan" name="id_jurusan" disabled="disabled">
                        <option value="{{$a->id_jurusanAsli}}">{{$a->nama_jurusan}}</option>
                        @foreach($jurusan as $j)
                          <option value="{{$j->id}}">{{$j->nama_jurusan}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label>Tahun Angkatan</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker" name="tahun_angkatan" placeholder="Tahun Angkatan..." value="{{$a->tahun_angkatan}}" disabled>
                    </div>
                  </div>

                </div>
                <div class="row">

                  <div class="form-group col-md-6">
                    <label>Status Keanggotaan</label>
                    <div class="input-group col-md-12" style="padding-top:5px; border:1px solid #D2D6DE; padding-left:10px; padding-right:5px;">
                      @if($a->status == 'Aktif')
                        <label>
                          <input type="radio" name="status" value="Aktif" class="flat-red" checked>
                          Aktif
                        </label>
                        &nbsp; &nbsp; &nbsp;
                        <label>
                          <input type="radio" name="status" value="Alumni" class="flat-red" disabled>
                          Alumni
                        </label>
                      @else
                        <label>
                          <input type="radio" name="status" value="Aktif" class="flat-red" disabled>
                          Aktif
                        </label>
                        &nbsp; &nbsp; &nbsp;
                        <label>
                          <input type="radio" name="status" value="Alumni" class="flat-red" checked>
                          Alumni
                        </label>
                      @endif
                    </div>
                  </div>

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
            <a href="#" data-toggle="modal" data-target="#modal-logo">
              @if($a->foto)
                <img class="img-square" id="foto" src="{{$a->foto}}" alt="Logo UKM" style="width: 100%;">
              @else
                <img class="img-square" id="foto" src="{{url('/foto/default-user.png')}}" alt="Logo UKM" style="width: 100%;">
              @endif
            </a>
              <hr>
            </div>
          </div>
        </div>

      </div>
    @endforeach

    <div class="modal modal-info fade" id="modal-logo">
      @if($a->foto)
        <img class="" src="{{$a->foto}}" style="margin:auto; top:0; right:0; left:0; bottom:0; position:absolute; width:500px;">
      @else
        <img class="" src="{{url('/foto/default-user.png')}}" style="margin:auto; top:0; right:0; left:0; bottom:0; position:absolute; width:500px;">
      @endif
    </div>

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
