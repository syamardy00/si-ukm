@extends('adminUkm.index')
@section('content')

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{url('/assets/plugins/iCheck/all.css')}}">

<section class="content-header">
  <h1>
  Tambah Anggota UKM
  <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('anggotaUkm.index')}}"><i class="fa fa-user"></i>Anggota Ukm</a></li>
    <li class="active">Tambah Anggota UKM</li>
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



  <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header" style="margin-bottom:-30px;">
            <div class="pull-left">
              <h3 class="box-title">Tambah Anggota UKM Dari List Mahasiswa</h3>
            </div>
            <div class="pull-right">
              <a class="btn btn-primary" href="{{route('anggotaUkm.create')}}"><i class="fa fa-plus"></i> Tambah Baru</a>
            </div>
            <br><hr>
            <div class="col-md-12" style="padding:0px;">
              <div class="alert alert-info alert-dismissible" style="border-left:10px solid #0097BC;">
                <h4><i class="icon fa fa-info"></i> Info</h4>
                Pilih mahasiswa yang ada pada tabel dibawah untuk ditambahkan sebagai
                anggota UKM <b>{{$ukm[0]['nama_ukm']}}</b>, jika data mahasiswa belum ada pada tabel silahkan
                klik tombol "Tambah Baru" untuk membuat data mahasiswa baru.
              </div>
            </div>
          </div>
          <hr>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="data_anggota" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Tahun Angkatan</th>
                <th>Aksi</th>
              </tr>
              </thead>
          </table>
        </div>
      </div>
  </div>

  <!-- modal konfirmasi hapus -->
  @foreach($dMahasiswa as $dM)
  <div class="modal modal-info fade" id="modal-danger{{$dM->id}}">
    <form action="{{ route('anggotaUkm.store_from_list')}}" method="post">
              {{ csrf_field() }}
              {{ method_field('POST') }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambahkan Sebagai Anggota</h4>
        </div>
        <div class="modal-body" style="min-height:100px;">
          <input type="hidden" name="id_user" value="{{$dM->anggota_id_user}}">
          <p>Tambahkan <b>{{$dM->nama}}</b> sebagai anggota UKM <b>{{$ukm[0]['nama_ukm']}}</b> ?</p>
          <div class="form-group col-md-12" style="padding:0px;">
            <div class="input-group col-md-12" style="padding-top:5px; border:1px solid #D2D6DE; padding-left:10px; padding-right:5px; background:white; color:black; margin:0px;">
              <label>Status Keanggotaan &nbsp; : &nbsp; </label>
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
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
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
</script>

<script>

$(document).ready(function() {
    var printCounter = 0;

  $('#data_anggota').append('<caption style="caption-side: bottom">Sistem Informasi UKM Politeknik TEDC Bandung.</caption>');

  $('#data_anggota').DataTable( {
  processing: true,
  ajax: {
      url: "{{route('anggotaUkm.data_mahasiswa')}}",
      dataSrc: ""
  },
  columns: [
      { "data": "nim" },
      { "data": "nama" },
      { "data": "nama_jurusan" },
      { "data": "tahun_angkatan" },
      { "data": "id",
        "width": "150px",
        "sClass": "text-center",
        "orderable": false,
        "mRender": function (data) {
          return '<a class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-danger' + data + '">Tambahkan Sebagai Anggota</a>';
        }
      }
  ]
  } );

});


</script>
@stop
