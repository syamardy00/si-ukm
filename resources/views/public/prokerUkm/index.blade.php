@section('content')

  <section class="content-header">
  <h1>
    Program Kerja
    <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    @if(Auth::guard('anggotaUkm')->check())
      <li><a href="{{route('anggotaUkm.ukm.dashboardProfilUkm')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    @elseif(Auth::guard('monitoring')->check())
      <li><a href="#"><i class="fa fa-tv"></i>Monitoring</a></li>
    @endif
    <li class="active">Program Kerja</li>
  </ol>
  </section>

  <section class="content">
    <div class="row">

      <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Program Kerja UKM</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="data_proker" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Nama Program Kerja</th>
                  <th>Tanggal Kegiatan</th>
                  <th>Proposal</th>
                  <th>Laporan</th>
                  <th>Status</th>
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

    $('#data_proker').append('<caption style="caption-side: bottom">Sistem Informasi UKM Politeknik TEDC Bandung.</caption>');

    $('#data_proker').DataTable( {
    processing: true,
    ajax: {
        url: "{{route('anggotaUkm.prokerUkm.data_proker')}}",
        dataSrc: ""
    },
    columns: [
        { "data": "nama_proker" },
        { "data": "tgl_kegiatan",
          "width" : "130px",
        },
        { "data": {proposal : "proposal", id : "id"},
          "width" : "70px",
          "mRender": function (data) {
            if(data.proposal == null){
              return '<button class="btn btn-sm btn-warning col-md-12 disabled">Belum Ada</button>';
            }else{
              return '<a data-toggle="tooltip" title="Download Proposal" href="{{url('ukm/dashboard/proker-ukm/proposal/download')}}/'+data.id+'"><button class="btn btn-sm btn-primary col-md-12">Download <i class="fa fa-download"></i></button></a>';
            }
          }
        },
        { "data": {laporan : "laporan", proposal : "proposal", id : "id"},
          "width" : "70px",
          "mRender": function (data) {
            if(data.laporan == null){
              return '<button class="btn btn-sm btn-warning col-md-12 disabled">Belum Ada</button>';
            }else{
              return '<a data-toggle="tooltip" title="Download Laporan" href="{{url('ukm/dashboard/proker-ukm/laporan/download')}}/'+data.id+'"><button class="btn btn-sm btn-primary col-md-12">Download <i class="fa fa-download"></i></button></a>';
            }
          }
        },
        { "data": "pelaksanaan",
          "width" : "130px",
          "mRender": function (data) {
              if(data == "Terlaksana"){
                return '<span style="color:green">'+data+'</span>';
              }else{
                return '<span style="color:red">'+data+'</span>';
              }
          }
        },
        { "data": "id",
          "width": "100px",
          "sClass": "text-center",
          "orderable": false,
          "mRender": function (data) {
            return '<a href="{{url('ukm/dashboard/proker-ukm/detail')}}/'+data+'"><button class="btn btn-sm btn-success col-md-12">Detail <i class="fa fa-info"></i></button></a>';
          }
        }
    ],
    dom: 'Bfrtip',
    buttons: [
              {
                  extend: 'excel',
                  messageTop: 'Tabel Program Kerja UKM - Sistem Informasi UKM - Politeknik TEDC Bandung',
                  exportOptions: {
                      columns: ':visible'
                  }
              },
              {
                  extend: 'pdf',
                  messageBottom: 'Tabel Program Kerja UKM - Sistem Informasi UKM - Politeknik TEDC Bandung',
                  exportOptions: {
                      columns: ':visible'
                  }
              },
              {
                  extend: 'print',
                  messageTop: 'Tabel Program Kerja UKM - Sistem Informasi UKM - Politeknik TEDC Bandung',
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

    $('#data_proker').append('<caption style="caption-side: bottom">Sistem Informasi UKM Politeknik TEDC Bandung.</caption>');

    $('#data_proker').DataTable( {
    processing: true,
    ajax: {
        url: "{{route('monitoring.prokerUkm.data_proker')}}",
        dataSrc: ""
    },
    columns: [
        { "data": "nama_proker" },
        { "data": "tgl_kegiatan",
          "width" : "130px",
        },
        { "data": {proposal : "proposal", id : "id"},
          "width" : "70px",
          "mRender": function (data) {
            if(data.proposal == null){
              return '<button class="btn btn-sm btn-warning col-md-12 disabled">Belum Ada</button>';
            }else{
              return '<a data-toggle="tooltip" title="Download Proposal" href="{{url('monitoring/proker-ukm/proposal/download')}}/'+data.id+'"><button class="btn btn-sm btn-primary col-md-12">Download <i class="fa fa-download"></i></button></a>';
            }
          }
        },
        { "data": {laporan : "laporan", proposal : "proposal", id : "id"},
          "width" : "70px",
          "mRender": function (data) {
            if(data.laporan == null){
              return '<button class="btn btn-sm btn-warning col-md-12 disabled">Belum Ada</button>';
            }else{
              return '<a data-toggle="tooltip" title="Download Laporan" href="{{url('monitoring/proker-ukm/laporan/download')}}/'+data.id+'"><button class="btn btn-sm btn-primary col-md-12">Download <i class="fa fa-download"></i></button></a>';
            }
          }
        },
        { "data": "pelaksanaan",
          "width" : "130px",
          "mRender": function (data) {
              if(data == "Terlaksana"){
                return '<span style="color:green">'+data+'</span>';
              }else{
                return '<span style="color:red">'+data+'</span>';
              }
          }
        },
        { "data": "id",
          "width": "100px",
          "sClass": "text-center",
          "orderable": false,
          "mRender": function (data) {
            return '<a href="{{url('monitoring/proker-ukm/detail')}}/'+data+'"><button class="btn btn-sm btn-success col-md-12">Detail <i class="fa fa-info"></i></button></a>';
          }
        }
    ],
    dom: 'Bfrtip',
    buttons: [
              {
                  extend: 'excel',
                  messageTop: 'Tabel Program Kerja UKM - Sistem Informasi UKM - Politeknik TEDC Bandung',
                  exportOptions: {
                      columns: ':visible'
                  }
              },
              {
                  extend: 'pdf',
                  messageBottom: 'Tabel Program Kerja UKM - Sistem Informasi UKM - Politeknik TEDC Bandung',
                  exportOptions: {
                      columns: ':visible'
                  }
              },
              {
                  extend: 'print',
                  messageTop: 'Tabel Program Kerja UKM - Sistem Informasi UKM - Politeknik TEDC Bandung',
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
