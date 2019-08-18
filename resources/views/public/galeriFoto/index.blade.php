@section('content')

<link href="{{url('/assets/galeri/css/style.css')}}" rel="stylesheet"/>

<!-- CSS Lightbox -->
<link href="{{url('/assets/galeri/css/lightbox.css')}}" rel="stylesheet"/>

<style>
.shadow:hover{
  box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.75);
  transition: ease-in-out 1;
}
</style>

  <section class="content-header">
  <h1>
    Galeri Foto
    <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    @if(Auth::guard('anggotaUkm')->check())
      <li><a href="{{route('anggotaUkm.ukm.dashboardProfilUkm')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    @elseif(Auth::guard('monitoring')->check())
      <li><a href="#"><i class="fa fa-tv"></i>Monitoring</a></li>
    @else
      <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
    @endif
    <li class="active">Galeri Foto</li>
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
            <div class="pull-left">
              <h3 class="box-title">Galeri Foto UKM</h3>
            </div>
            @if(Auth::guard('adminUkm')->check())
              <div class="pull-right">
                @if($hitung >= 10)
                  <a class="btn btn-primary" data-toggle="modal" data-target="#modal-foto-maksimal"><i class="fa fa-ban"></i> Jumlah Foto Maksimal</a>
                @else
                  <a class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-foto"><i class="fa fa-plus"></i> Tambah Foto Baru</a>
                @endif
              </div>
              <br><hr>
              <div class="col-md-12" style="padding:0px;">
                <div class="alert alert-info alert-dismissible" style="border-left:10px solid #0097BC;">
                  <h4><i class="icon fa fa-info"></i> Info</h4>
                  Galeri foto dari kegiatan-kegiatan unggulan UKM, galeri foto hanya dapat berisi maksimal 10 foto unggulan saja.
                  Untuk menambahkan foto baru silahkan klik tombol "<b>Tambah Foto Baru</b>" diatas.
                </div>
              </div>
            @endif

          </div>

          <div class="box-body">
          @if(sizeOf($foto) == 0)
            <center><h4>Belum Ada Foto</h4></center>
          @endif
          <?php $no=0; ?>
          @foreach($foto as $f)
            @if($no == 0 || $no == 3 || $no == 6 || $no == 9)
              <div class="row">
            @endif
            <div class="col-md-4" style="margin-bottom:30px;">
              <div style="">
                <div class="well shadow" style="margin:0px; height:320px; background:#3A3F4B; color:#fff; border:0px;">
                    <a class="example-image-link" href="{{url($f->foto)}}" data-lightbox="example-set" data-title="{{$f->keterangan}}">
                      <div class="widget-user-image img-rounded" style="text-align: right; right:20px; text-align:center; height:200px; width:100%;
                      background:url({{url($f->foto)}}); background-size:cover; background-position:center;">
                      </div>
                      <!-- <img class="thumbnail img-responsive" alt="Bootstrap template" src="{{$f->foto}}" /> -->
                    </a>
                    <br>
                    <div style="padding:5px; padding-bottom:1px; background:#313640; height:70px; margin-top:0px;">
                      <p>{{substr($f->keterangan, 0, 120)}}</p>
                    </div>
                </div>
              </div>
            </div>
            @if($no == 2 || $no == 5 || $no == 8 || $no == 9)
          </div>
            @endif
          <?php $no++; ?>
          @endforeach

          </div>
        </div>
      </div>
    </div>

      <div class="modal modal-info fade" id="modal-tambah-foto">
        <form action="{{ route('galeriFoto.store')}}" method="post"  enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('POST') }}
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Tambahkan Foto Baru</h4>
            </div>
            <div class="modal-body" style="min-height:330px;">
              <div class="col-md-5">
                <img class="img-square" id="foto" src="{{url('/foto/default-image.png')}}" alt="Logo UKM" style="width: 100%;">
                <hr>
                <input type="file" name="foto" value="{{old('foto')}}" id="previewFoto" class="btn btn-primary col-md-12" required>
              </div>
              <div class="col-md-7">
                <label class="control-label">Keterangan Foto :</label>
                <textarea class="form-control" name="keterangan" style="width:100%; height: 120px;" placeholder="Keterangan Foto..." required></textarea>
                <p class="text-white">Masukan keterangan singkat mengenai foto. Maksimal 250 Karakter.</p>
              </div>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
              <button type="submit" class="btn btn-outline">Upload</button>
              <button type="button" data-dismiss="modal" class="btn btn-outline">Batal</button>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      @foreach($foto as $f)
      <div class="modal modal-danger fade" id="modal-hapus-foto{{$f->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
              <p>Anda yakin akan menghapus foto?</p>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
              <form action="{{ route('galeriFoto.destroy', $f->id) }}" method="post">
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

      <div class="modal modal-warning fade" id="modal-foto-maksimal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Jumlah Foto Maksimal</h4>
            </div>
            <div class="modal-body">
              <p>Tidak bisa menambahkan foto baru, jumlah foto dalam galeri sudah
              mencapai batas maksimal, yaitu 10 foto. Hapus foto terlebih dahulu untuk
            manambahkan foto baru.</p>
            </div>
            <div class="modal-footer">
              <button type="button" data-dismiss="modal" class="btn btn-outline">Tutup</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

  </section>
@endsection

@section('js')
<!-- jQuery Lightbox -->
<script src="{{url('/assets/galeri/js/lightbox-plus-jquery.min.js')}}"></script>
<script>
  function bacaFoto(input){
    if(input.files && input.files[0]){
      var reader = new FileReader();

      reader.onload = function(e){
        $('#foto').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);

    }
  }

  $('#previewFoto').change(function(){
    bacaFoto(this);
  });
</script>
@stop
