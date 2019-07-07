@section('content')

<section class="content-header">
  <h1>
  Anggota Ukm
  <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    @if(Auth::guard('anggotaUkm')->check())
      <li><a href="{{route('anggotaUkm.ukm.dashboardProfilUkm')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    @elseif(Auth::guard('monitoring')->check())
      <li><a href="#"><i class="fa fa-tv"></i>Monitoring</a></li>
    @endif
    <li class="active">Anggota UKM</li>
  </ol>
</section>

<section class="content">
  <div class="row">

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

@if(Auth::guard('anggotaUkm')->check())

<script>

$(document).ready(function() {
    var printCounter = 0;

  $('#data_anggota').append('<caption style="caption-side: bottom">Sistem Informasi UKM Politeknik TEDC Bandung.</caption>');

  $('#data_anggota').DataTable( {
  processing: true,
  ajax: {
      url: "{{route('anggotaUkm.anggotaUkm.data_anggota')}}",
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
        "width": "75px",
        "sClass": "text-center",
        "orderable": false,
        "mRender": function (data) {
          return '<a class="btn btn-sm btn-primary" href="{{url('ukm/dashboard/anggota-ukm/detail')}}/'+data+'">Detail <i class="fa fa-edit"></i></a>';
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

@elseif(Auth::guard('monitoring')->check())
<script>

$(document).ready(function() {
    var printCounter = 0;

  $('#data_anggota').append('<caption style="caption-side: bottom">Sistem Informasi UKM Politeknik TEDC Bandung.</caption>');

  $('#data_anggota').DataTable( {
  processing: true,
  ajax: {
      url: "{{route('monitoring.anggotaUkm.data_anggota')}}",
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
        "width": "75px",
        "sClass": "text-center",
        "orderable": false,
        "mRender": function (data) {
          return '<a class="btn btn-sm btn-primary" href="{{url('monitoring/anggota-ukm/detail')}}/'+data+'">Detail <i class="fa fa-edit"></i></a>';
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
@endif

@stop
