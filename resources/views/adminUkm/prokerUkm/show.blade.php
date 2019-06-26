@extends('adminUkm.index')
@section('content')

<link rel="stylesheet" href="{{url('/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
<link rel="stylesheet" href="{{url('/assets/dist/css/skins/_all-skins.min.css')}}">
<link rel="stylesheet" href="{{url('/assets/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
<!-- bootstrap datepicker -->

  <section class="content-header">
  <h1>
    Program Kerja
    <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('prokerUkm.index')}}"><i class="fa fa-user"></i>Program Kerja</a></li>
    <li class="active">Detail Proker</li>
  </ol>
  </section>

  <section class="content">
      <div class="row">
        <div class="col-md-9">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Deskripsi Program Kerja Ukm</h3>
              <a href="{{route('calonAnggota.cetak_pdf', $proker[0]['id'])}}" class="btn btn-xs btn-primary pull-right">Simpan PDF &nbsp; <i class="fa fa-file-pdf-o"></i></a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <dl class="dl-horizontal">

                <dt>Nama UKM &nbsp &nbsp</dt>
                <dd style="border-left:1px solid black; border-bottom:1px solid black; padding:5px;">{{$ukm[0]['nama_ukm']}}</dd>

                <dt>Nama Program Kerja &nbsp &nbsp</dt>
                <dd style="border-left:1px solid black; border-bottom:1px solid black; padding:5px;">{{$proker[0]['nama_proker']}}</dd>

                <dt>Tanggal Kegiatan &nbsp &nbsp</dt>
                <dd style="border-left:1px solid black; border-bottom:1px solid black; padding:5px;">{{$proker[0]['tgl_kegiatan']}}</dd>

                <dt>Status Pelakasanaan &nbsp &nbsp</dt>
                @if($proker[0]['pelaksanaan'] == "Terlaksana")
                  <dd style="color:green; border-left:1px solid black; border-bottom:1px solid black; padding:5px;">{{$proker[0]['pelaksanaan']}}</dd>
                @else
                  <dd style="color:red;border-left:1px solid black; border-bottom:1px solid black; padding:5px;">{{$proker[0]['pelaksanaan']}}</dd>
                @endif

                <dt>Deskripsi &nbsp &nbsp</dt>
                <dd style="border-left:1px solid black; border-bottom:1px solid black; padding:5px;">{{$proker[0]['deskripsi']}}</dd>

                </dd>
              </dl>
              <!-- <hr>
              <a class="btn btn-app pull-right" data-toggle="tooltip" title="Download PDF" href="{{route('prokerUkm.cetak_pdf', $proker[0]['id'])}}">
                <i class="fa fa-file-pdf-o"></i> Save
              </a> -->
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">File Proker</h3>
            </div>
            <div class="box-body">
              <span>Proposal Program Kerja</span>
              @if($proker[0]['proposal'] != null)
                <a data-toggle="tooltip" title="Download Proposal" href="{{url('proker-ukm/proposal/download/' .$proker[0]['id'])}}">
                  <button class="btn btn-sm btn-primary col-md-12">Download Proposal <i class="fa fa-download"></i></button>
                </a>
              @else
                <a data-toggle="tooltip" title="Proposal Belum Ada">
                  <button class="btn btn-sm btn-primary disabled col-md-12">Proposal Belum Ada </button>
                </a>
              @endif
              <br></br><hr>
              <span>Laporan Program Kerja</span>
              @if($proker[0]['laporan'] != null)
                <a data-toggle="tooltip" title="Download Laporan" href="{{url('proker-ukm/laporan/download/' .$proker[0]['id'])}}">
                  <button class="btn btn-sm btn-primary col-md-12">Download Laporan <i class="fa fa-download"></i></button>
                </a>
              @else
                <a data-toggle="tooltip" title="Download Belum Ada">
                  <button class="btn btn-sm btn-primary disabled col-md-12">Laporan Belum Ada </button>
                </a>
              @endif
            </div>
          </div>
      </div>
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
