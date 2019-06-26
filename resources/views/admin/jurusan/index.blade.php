@extends('admin.index')
@section('content')

<section class="content-header">
  <h1>
    Kelola Jurusan
    <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('admin')}}"><i class="fa fa-user"></i>Admin</a></li>
    <li class="active">Kelola Jurusan</li>
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
      @if($errors->has('nama_jurusan'))
        <div class="col-md-12">
          <div class="alert alert-danger alert-dismissible" style="border-left:10px solid #C23321;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-remove"></i> Operasi Gagal!</h4>
            {{ $errors->first('nama_jurusan') }}
          </div>
        </div>
      @endif

    <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Daftar Jurusan</h3>
              <div class="pull-right">
                <a class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-jurusan"><i class="fa fa-plus"></i> Tambah Jurusan Baru</a>
              </div>
              <br><hr>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="data_jurusan" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th style="text-align:center;">Nama Jurusan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>

            </table>
          </div>
        </div>
    </div>

    <!-- modal konfirmasi hapus -->
    @foreach($dJurusan as $u)
    <div class="modal modal-danger fade" id="modal-danger{{$u->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Konfirmasi</h4>
          </div>
          <div class="modal-body">
            <p>PERHATIAN !<br>Anda yakin akan menghapus jurusan "<b>{{$u->nama_jurusan}}</b>" ?</p>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
            <form action="{{ route('jurusan.destroy', $u->id) }}" method="post">
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

    <div class="modal modal-info fade" id="modal-tambah-jurusan">
      <form action="{{ route('jurusan.store')}}" method="post"  enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('POST') }}
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Tambahkan Jurusan Baru</h4>
          </div>
          <div class="modal-body" style="height:100px;">
            <div class="col-md-12">
              <label>Nama Jurusan</label>
              <input type="text" name="nama_jurusan" value="{{old('jurusan')}}" class="form-control" placeholder="Jurusan..." required>
            </div>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
            <button type="submit" class="btn btn-outline">Simpan</button>
            <button type="button" data-dismiss="modal" class="btn btn-outline">Batal</button>
            </form>
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
<script src="{{url('/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script>
$('#data_jurusan').DataTable( {
    processing: true,
    ajax: {
        url: "{{route('jurusan.data_jurusan')}}",
        dataSrc: ""
    },
    columns: [
        { "data": "nama_jurusan" },
        { "data": "id",
          "width": "150px",
          "sClass": "text-center",
          "orderable": false,
          "mRender": function (data) {
            return '<a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-danger' + data + '">Hapus <i class="fa fa-trash"></i></a>';
          }
        }
    ]
} );
</script>
@stop
