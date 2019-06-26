@extends('adminUkm.index')
@section('content')

  <section class="content-header">
  <h1>
    Data Calon Anggota
    <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('calonAnggota.index')}}"><i class="fa fa-user"></i>Calon Anggota</a></li>
    <li class="active">Data Calon Anggota</li>
  </ol>
  </section>

  <section class="content">
    <div class="row">
      @if(Session::has('berhasil'))
        <div class="col-md-12">
          <div class="alert alert-success alert-dismissible" style="border-left:10px solid #00733E;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Operasi Berhasil !</h4>
            {{Session::get('berhasil')}}
          </div>
        </div>
      @endif

      <div class="col-xs-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Daftar Calon Anggota UKM</h3>

                @if($ukm[0]['pendaftaran'] == 0)
                <div class="pull-right">
                  <a class="btn btn-primary" data-toggle="modal" data-target="#aktifkan-form"><i class="fa fa-check"></i> Aktifkan Form Pendaftaran</a>
                </div>
                <br><hr>
                <div class="col-md-12" style="padding:0px;">
                  <div class="alert alert-warning alert-dismissible" style="border-left:10px solid #C87F0A;">
                    <h4><i class="icon fa fa-warning"></i> Status Pendaftaran Tidak Aktif</h4>
                    Form pendaftaran calon anggota baru UKM dalam status <b style="color:">Tidak Aktif</b>,
                    Untuk mengaktifkan form pendaftaran klik tombol <b>Aktifkan Form Pendaftaran</b>.
                  </div>
                </div>
                @else
                <div class="pull-right">
                  <a class="btn btn-primary" data-toggle="modal" data-target="#nonaktifkan-form"><i class="fa fa-ban"></i> Non-Aktifkan Form Pendaftaran</a>
                </div>
                <br><hr>
                <div class="col-md-12" style="padding:0px;">
                  <div class="alert alert-info alert-dismissible" style="border-left:10px solid #0097BC;">
                    <h4><i class="icon fa fa-check"></i> Status Pendaftaran Aktif</h4>
                    Form pendaftaran calon anggota baru UKM dalam status <b style="color:">Aktif</b>,
                    Untuk menonaktifkan form pendaftaran klik tombol <b>Non-Aktifkan Form Pendaftaran</b>.
                  </div>
                </div>
                @endif

              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="data_calon_anggota" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Tahun Angkatan</th>
                    <th>Tanggal Pendaftaran</th>
                    <th>No Telepon</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
              </table>
            </div>
          </div>
      </div>


      <!-- modal konfirmasi hapus -->
      @foreach($dCalonAnggota as $a)
      <div class="modal modal-danger fade" id="modal-danger{{$a->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
              <p>Anda yakin akan menghapus {{$a->nama}} dari daftar ?</p>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
              <form action="{{ route('calonAnggota.destroy', $a->id) }}" method="post">
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

      <div class="modal modal-info fade" id="aktifkan-form">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
              <p><b>Anda akan yakin akan mengaktifkan Form Pendaftaran Calon Anggota baru?</b><br>
              Setelah form pendaftaran calon anggota baru aktif maka calon anggota dapat mendaftarkan diri melalui sistem informasi ini.</p>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
                        <a href="{{route('calonAnggota.ubah.status')}}"><button type="submit" class="btn btn-outline">Ya, Aktifkan</button></a>
                        <button type="button" data-dismiss="modal" class="btn btn-outline">Batal</button>

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


      <div class="modal modal-danger fade" id="nonaktifkan-form">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
              <p><b>Anda akan yakin akan menonaktifkan Form Pendaftaran Calon Anggota baru?</b><br>
              Setelah form pendaftaran calon anggota baru tidak aktif maka calon anggota tidak dapat mendaftarkan diri melalui sistem informasi ini.</p>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
                        <a href="{{route('calonAnggota.ubah.status')}}"><button type="submit" class="btn btn-outline">Ya, Non-Aktifkan</button></a>
                        <button type="button" data-dismiss="modal" class="btn btn-outline">Batal</button>

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


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

  $('#data_calon_anggota').append('<caption style="caption-side: bottom">Sistem Informasi UKM Politeknik TEDC Bandung.</caption>');

  $('#data_calon_anggota').DataTable( {
  aaSorting : [[5, "desc"]],
  processing: true,
  ajax: {
      url: "{{route('calonAnggota.data_calon_anggota')}}",
      dataSrc: ""
  },
  columns: [
      { "data": "nim" },
      { "data": "nama" },
      { "data": "nama_jurusan" },
      { "data": "tahun_angkatan",
        "searchable" : false
      },
      { "data": "tgl_pendaftaran" },
      { "data": "no_telepon"},
      { "data": "id",
        "width": "150px",
        "sClass": "text-center",
        "orderable": false,
        "mRender": function (data) {
          return '<a class="btn btn-sm btn-primary" href="{{url('calon-anggota/lihat')}}/'+data+'">Detail <i class="fa fa-info"></i></a>  \
          <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-danger' + data + '">Hapus <i class="fa fa-trash"></i></a>';
        }
      }
  ],
  dom: 'Bfrtip',
  buttons: [
            {
                extend: 'excel',
                messageTop: 'Tabel Data Calon Anggota UKM - Sistem Informasi UKM - Politeknik TEDC Bandung',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                messageBottom: 'Tabel Data Calon Anggota UKM - Sistem Informasi UKM - Politeknik TEDC Bandung',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                messageTop: 'Tabel Data Calon Anggota UKM - Sistem Informasi UKM - Politeknik TEDC Bandung',
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
