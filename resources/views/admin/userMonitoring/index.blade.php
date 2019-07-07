@extends('admin.index')
@section('content')

<section class="content-header">
  <h1>
    Kelola Akun Monitoring
    <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('admin')}}"><i class="fa fa-user"></i>Admin</a></li>
    <li class="active">Kelola akun monitoring</li>
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
              <h3 class="box-title">Daftar Akun Monitoring UKM</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="data_user" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Username</th>
                  <th>Aksi</th>
                </tr>
                </thead>

            </table>
          </div>
        </div>
    </div>

    <!-- modal konfirmasi hapus -->
    @foreach($dUser as $u)
    <div class="modal modal-danger fade" id="modal-danger{{$u->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Konfirmasi</h4>
          </div>
          <div class="modal-body">
            <p>PERHATIAN !<br>Anda akan menghapus akun monitoring dengan username "{{$u->username}}", Lanjutkan ?</p>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
            <form action="{{ route('userMonitoring.destroy', $u->id) }}" method="post">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button type="submit" class="btn btn-outline">Ya, Lanjutkan</button>
                      <button type="button" data-dismiss="modal" class="btn btn-outline">Tidak, Batalkan</button>
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
<script src="{{url('/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- page script -->
<!-- <script>
  $(function () {
    $('#data_userd').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script> -->

<!-- <script>
  $(document).ready(function() {
      var t = $('#data_user').DataTable( {
          "ajax": "{{route('user.index')}}",
          "columns": [
              {
                  "data": "username"
              },
              { "data": "password" }
          ]
      } );
  } );
</script> -->
<script>
$('#data_user').DataTable( {
    processing: true,
    ajax: {
        url: "{{route('userMonitoring.data_user_monitoring')}}",
        dataSrc: ""
    },
    columns: [
        { "data": "username" },
        { "data": "id",
          "width": "150px",
          "sClass": "text-center",
          "orderable": false,
          "mRender": function (data) {
            return '<a class="btn btn-sm btn-primary" href="{{url('kelola-akun-monitoring/edit')}}/'+data+'">Edit <i class="fa fa-edit"></i></a>  \
            <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-danger' + data + '">Hapus <i class="fa fa-trash"></i></a>';
          }
        }
    ]
} );
</script>
@stop
