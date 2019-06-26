@extends('adminUkm.index')
@section('content')

<section class="content-header">
  <h1>
  Kelola Anggota Ukm
  <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('anggotaUkm.index')}}"><i class="fa fa-user"></i>Anggota Ukm</a></li>
    <li class="active">Kelola Anggota Ukm</li>
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
          <div class="box-header">
            <h3 class="box-title">Daftar Anggota UKM</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="data_anggota" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Tahun Angkatan</th>
                <th>No Telepon</th>
                <th>Status Keanggotaan</th>
                <th>Aksi</th>
              </tr>
              </thead>
          </table>
        </div>
      </div>
  </div>

  <!-- modal konfirmasi hapus -->
  @foreach($dAnggota as $a)
  <div class="modal modal-danger fade" id="modal-danger{{$a->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Konfirmasi</h4>
        </div>
        <div class="modal-body">
          <p>Anda yakin akan menghapus {{$a->nama}} dari anggota UKM ?</p>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
          <form action="{{ route('anggotaUkm.destroy', $a->id) }}" method="post">
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

<script>

$(document).ready(function() {
    var printCounter = 0;

  $('#data_anggota').append('<caption style="caption-side: bottom">Sistem Informasi UKM Politeknik TEDC Bandung.</caption>');

  $('#data_anggota').DataTable( {
  processing: true,
  ajax: {
      url: "{{route('anggotaUkm.data_anggota')}}",
      dataSrc: ""
  },
  columns: [
      { "data": "nim" },
      { "data": "nama" },
      { "data": "nama_jurusan" },
      { "data": "tahun_angkatan" },
      { "data": "no_telepon" },
      { "data": "status"},
      { "data": "id",
        "width": "150px",
        "sClass": "text-center",
        "orderable": false,
        "mRender": function (data) {
          return '<a class="btn btn-sm btn-primary" href="{{url('anggota-ukm/edit')}}/'+data+'">Edit <i class="fa fa-edit"></i></a>  \
          <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-danger' + data + '">Hapus <i class="fa fa-trash"></i></a>';
        }
      }
  ],
  dom: 'Bfrtip',
  buttons: [
            {
                extend: 'excel',
                messageTop: 'Tabel Data Anggota UKM - Sistem Informasi UKM - Politeknik TEDC Bandung',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                messageBottom: 'Tabel Data Anggota UKM - Sistem Informasi UKM - Politeknik TEDC Bandung',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                messageTop: 'Tabel Data Anggota UKM - Sistem Informasi UKM - Politeknik TEDC Bandung',
                messageBottom: null,
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ]
  } );

});


</script>
@stop
