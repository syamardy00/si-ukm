@extends('adminUkm.index')
@section('content')

  <section class="content-header">
  <h1>
    Program Kerja
    <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('prokerUkm.index')}}"><i class="fa fa-user"></i>Program Kerja</a></li>
    <li class="active">Kelola Proker</li>
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
      @if($errors->has('proposal'))
        <div class="col-md-12">
          <div class="alert alert-danger alert-dismissible" style="border-left:10px solid #C23321;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-remove"></i> Operasi Gagal!</h4>
            {{ $errors->first('proposal') }}
          </div>
        </div>
      @endif
      @if($errors->has('laporan'))
        <div class="col-md-12">
          <div class="alert alert-danger alert-dismissible" style="border-left:10px solid #C23321;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-remove"></i> Operasi Gagal!</h4>
            {{ $errors->first('laporan') }}
          </div>
        </div>
      @endif

      <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Daftar Program Kerja UKM</h3><hr>
              <div class="col-md-12" style="padding:0px;">
                <div class="alert alert-info alert-dismissible" style="border-left:10px solid #0097BC;">
                  <h4><i class="icon fa fa-info"></i> Info</h4>
                  Untuk merubah <b>Status</b> dari "Belum Terlaksana" menjadi "Terlaksana" silahkan upload terlebih dahulu <b>Proposal</b> kemudian Upload
                  <b>Laporan</b> dalam bentuk .PDF
                </div>
              </div>
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

      <!-- modal konfirmasi hapus -->
      @foreach($dProker as $dP)
      <div class="modal modal-danger fade" id="modal-danger{{$dP->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
              <p>Anda yakin akan menghapus program kerja <b>{{$dP->nama_proker}}</b> ?</p>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
              <form action="{{ route('prokerUkm.destroy', $dP->id) }}" method="post">
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


      <div class="modal modal-info fade" id="modal-upload-proposal{{$dP->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Upload Proposal</h4>
            </div>
            <form action="{{ route('prokerUkm.upload.proposal', $dP->id) }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('POST') }}
            <div class="modal-body">
              <p>Upload proposal untuk program kerja <b>{{$dP->nama_proker}} .</b></p>
              <input type="file" name="proposal" class="btn btn-primary col-md-12" required>
              <sub>Upload dalam format <b>.pdf</b></sub>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->

                        <button type="submit" class="btn btn-outline">Simpan</button>
                        <button type="button" data-dismiss="modal" class="btn btn-outline">Batal</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


      <div class="modal modal-info fade" id="modal-upload-laporan{{$dP->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Upload Laporan</h4>
            </div>
            <form action="{{ route('prokerUkm.upload.laporan', $dP->id) }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('POST') }}
            <div class="modal-body">
              <p>Upload laporan untuk program kerja <b>{{$dP->nama_proker}} .</b></p>
              <input type="file" name="laporan" class="btn btn-primary col-md-12" required>
              <sub>Upload dalam format <b>.pdf</b></sub>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->

                        <button type="submit" class="btn btn-outline">Simpan</button>
                        <button type="button" data-dismiss="modal" class="btn btn-outline">Batal</button>
            </div>
            </form>
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

  $('#data_proker').append('<caption style="caption-side: bottom">Sistem Informasi UKM Politeknik TEDC Bandung.</caption>');

  $('#data_proker').DataTable( {
  processing: true,
  ajax: {
      url: "{{route('prokerUkm.data_proker')}}",
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
            return '<a title="Proposal belum ada, Upload Proposal" data-toggle="modal" data-target="#modal-upload-proposal' + data.id + '"><button class="btn btn-sm btn-warning col-md-12">Upload <i class="fa fa-upload"></i></button></a>';
          }else{
            return '<a data-toggle="tooltip" title="Download Proposal" href="{{url('proker-ukm/proposal/download')}}/'+data.id+'"><button class="btn btn-sm btn-primary col-md-12">Download <i class="fa fa-download"></i></button></a>';
          }
        }
      },
      { "data": {laporan : "laporan", proposal : "proposal", id : "id"},
        "width" : "70px",
        "mRender": function (data) {
          if(data.laporan == null){
            if(data.proposal == null){
              return '<button class="btn disabled btn-sm btn-warning col-md-12" data-toggle="tooltip" title="Upload Laporan tidak tersedia, Upload Proposal terlebih dahulu" href="#">Upload <i class="fa fa-upload"></i></button>';
            }else{
              return '<a title="Laporan belum ada, Upload Laporan" data-toggle="modal" data-target="#modal-upload-laporan' + data.id + '"><button class="btn btn-sm btn-warning col-md-12">Upload <i class="fa fa-upload"></i></button></a>';
            }
          }else{
            return '<a data-toggle="tooltip" title="Download Laporan" href="{{url('proker-ukm/laporan/download')}}/'+data.id+'"><button class="btn btn-sm btn-primary col-md-12">Download <i class="fa fa-download"></i></button></a>';
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
          return '<div class="btn-group"> \
            <button type="button" class="btn btn-info"> Aksi </button> \
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"> \
              <span class="caret"></span> \
              <span class="sr-only">Toggle Dropdown</span> \
            </button> \
            <ul class="dropdown-menu" role="menu"> \
              <li><a href="{{url('proker-ukm/lihat')}}/'+data+'"><i class="fa fa-info"></i>&nbsp&nbsp Detail</a></li> \
              <li><a href="{{url('proker-ukm/edit')}}/'+data+'"><i class="fa fa-edit"></i> Edit</a></li> \
              <li><a href="#" data-toggle="modal" title="Hapus Proker" data-target="#modal-danger' + data + '"><i class="fa fa-trash"></i>&nbsp Hapus</a></li> \
            </ul> \
          </div>';
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
@stop
