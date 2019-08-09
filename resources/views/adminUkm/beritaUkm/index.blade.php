@extends('adminUkm.index')
@section('content')

  <section class="content-header">
  <h1>
    Kelola Berita
    <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('beritaUkm.index')}}"><i class="fa fa-user"></i>Berita Ukm</a></li>
    <li class="active">Kelola Berita</li>
  </ol>
  </section>

  <section class="content">
    <div class="row">
      @if(Session::has('berhasil'))
        <div class="col-md-12">
          <div class="alert alert-success alert-dismissible" style="border-left:10px solid #00733E;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Operasi Berhasil!</h4>
            {{Session::get('berhasil')}}
          </div>
        </div>
      @endif

      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Data Berita UKM</h3>
          </div>
          <div class="box-body">
            <table id="data_berita" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Tanggal</th>
                <th>Judul Berita</th>
                <th>Sifat Berita</th>
                <th>Aksi</th>
              </tr>
              </thead>
          </table>
        </div>

        </div>
      </div>

      @foreach($dBerita as $dB)
      <div class="modal modal-danger fade" id="modal-danger{{$dB->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
              <p>Anda yakin akan menghapus berita dengan judul  "<b>{{$dB->judul_berita}}</b>" ?</p>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
              <form action="{{ route('beritaUkm.destroy', $dB->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-outline">Ya</button>
                        <button type="button" data-dismiss="modal" class="btn btn-outline">Batal</button>
              </form>

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      @endforeach



    </div>
  </section>

@endsection

@section('js')
<script src="{{url('/assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/bower_components/datatables.net/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('/assets/bower_components/datatables.net/js/buttons.print.min.js')}}"></script>
<script src="{{url('/assets/bower_components/datatables.net/js/jszip.min.js')}}"></script>
<script src="{{url('/assets/bower_components/datatables.net/js/pdfmake.min.js')}}"></script>
<script src="{{url('/assets/bower_components/datatables.net/js/vfs_fonts.js')}}"></script>
<script src="{{url('/assets/bower_components/datatables.net/js/buttons.colVis.min.js')}}"></script>
<script src="{{url('/assets/bower_components/datatables.net/js/buttons.html5.min.js')}}"></script>
<script src="{{url('/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{url('/assets/plugins/iCheck/icheck.min.js')}}"></script>

<script>
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

$(document).ready(function() {
    var printCounter = 0;

  $('#data_berita').append('<caption style="caption-side: bottom">Sistem Informasi UKM Politeknik TEDC Bandung.</caption>');

  $('#data_berita').DataTable( {
  aaSorting : [[1, "desc"]],
  processing: true,
  ajax: {
      url: "{{route('beritaUkm.data_berita')}}",
      dataSrc: ""
  },
  columns: [
      { "data": "tanggal_berita" },
      { "data": "judul_berita" },
      { "data": "sifat_berita",
        "width" : "100px" },
      { "data": "id",
        "width": "100px",
        "sClass": "text-center",
        "orderable": false,
        "mRender": function (data) {
          return '<div class="btn-group"> \
            <button type="button" class="btn btn-info"> Aksi </button> \
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"> \
              <span class="caret"></span> \
              <span class="sr-only">Toggle Dropdown</span> \
            </button> \
            <ul class="dropdown-menu" role="menu"> \
              <li><a href="{{url('berita-ukm/baca')}}/'+data+'"><i class="fa fa-eye"></i>&nbsp Baca</a></li> \
              <li><a href="{{url('berita-ukm/edit')}}/'+data+'"><i class="fa fa-edit"></i> Edit</a></li> \
              <li><a href="#" data-toggle="modal" title="Hapus Proker" data-target="#modal-danger' + data + '"><i class="fa fa-trash"></i>&nbsp Hapus</a></li> \
            </ul> \
          </div>';
        }
      }
  ]
  } );

});


</script>
@stop
