@section('content')

  <section class="content-header">
  <h1>
    Calon Anggota
    <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    @if(Auth::guard('anggotaUkm')->check())
      <li><a href="{{route('anggotaUkm.ukm.dashboardProfilUkm')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    @elseif(Auth::guard('monitoring')->check())
      <li><a href="#"><i class="fa fa-tv"></i>Monitoring</a></li>
    @endif
    <li class="active">Calon Anggota</li>
  </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Daftar Calon Anggota UKM</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                @if($ukm[0]['pendaftaran'] == 0)
                <div class="col-md-12" style="padding:0px;">
                  <div class="alert alert-warning alert-dismissible" style="border-left:10px solid #C87F0A;">
                    <h4><i class="icon fa fa-warning"></i> Status Pendaftaran Tidak Aktif</h4>
                    Form pendaftaran calon anggota baru UKM dalam status <b style="color:">Tidak Aktif</b>.
                  </div>
                </div>
                @else
                <div class="col-md-12" style="padding:0px;">
                  <div class="alert alert-info alert-dismissible" style="border-left:10px solid #0097BC;">
                    <h4><i class="icon fa fa-check"></i> Status Pendaftaran Aktif</h4>
                    Form pendaftaran calon anggota baru UKM dalam status <b style="color:">Aktif</b>.
                  </div>
                </div>
                @endif

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

    $('#data_calon_anggota').append('<caption style="caption-side: bottom">Sistem Informasi UKM Politeknik TEDC Bandung.</caption>');

    $('#data_calon_anggota').DataTable( {
    aaSorting : [[5, "desc"]],
    processing: true,
    ajax: {
        url: "{{route('anggotaUkm.calonAnggota.data_calon_anggota')}}",
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
          "width": "75px",
          "sClass": "text-center",
          "orderable": false,
          "mRender": function (data) {
            return '<a class="btn btn-sm btn-primary" href="{{url('ukm/dashboard/calon-anggota/detail')}}/'+data+'">Detail <i class="fa fa-info"></i></a>';
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

@elseif(Auth::guard('monitoring'))
<script>
$(document).ready(function() {
    var printCounter = 0;

  $('#data_calon_anggota').append('<caption style="caption-side: bottom">Sistem Informasi UKM Politeknik TEDC Bandung.</caption>');

  $('#data_calon_anggota').DataTable( {
  aaSorting : [[5, "desc"]],
  processing: true,
  ajax: {
      url: "{{route('monitoring.calonAnggota.data_calon_anggota')}}",
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
        "width": "75px",
        "sClass": "text-center",
        "orderable": false,
        "mRender": function (data) {
          return '<a class="btn btn-sm btn-primary" href="{{url('monitoring/calon-anggota/detail')}}/'+data+'">Detail <i class="fa fa-info"></i></a>';
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

@endif
@stop
