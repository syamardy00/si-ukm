@extends('admin.index')
@section('content')

<style>
  .example-modal .modal {
    position: relative;
    top: auto;
    bottom: auto;
    right: auto;
    left: auto;
    display: block;
    z-index: 1;
  }

  .example-modal .modal {
    background: transparent !important;
  }
  .tambah {
    color:white;
    transition: ease-in-out 1;
  }

  .tambah a{
    color:white;
    transition: ease-in-out 1;
  }

  .tambah a:hover{
    color:#3C8DBC;
    transition: ease-in-out 1;
  }

  .shadow:hover{
    box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.75);
    transition: ease-in-out 1;
  }

</style>

  <section class="content-header">
    <h1>
      Daftar UKM Di Politeknik TEDC Bandung
      <!-- <small>Lihat Profil UKM</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('admin')}}"><i class="fa fa-user"></i>Admin</a></li>
      <li class="active">Kelola UKM</li>
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
    </div>

    <div class="row">

      <div class="col-lg-6 col-xs-6">
          <a href="{{route('ukm.create')}}" style="color:white;">
          <div class="small-box bg-aqua" style="padding:10px;">
            <div class="inner">
              <h3>Tambah UKM</h3>
              <span>Daftarkan UKM Baru</span>
            </div>
            <div class="icon">
              <i class="fa fa-plus"></i>
            </div>
            <a href="{{route('ukm.create')}}" class="small-box-footer" style="margin:-10px; margin-top:10px;">Tambah UKM <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </a>
      </div>

      <div class="col-lg-6 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{sizeOf($ukm)}} UKM</h3>
            <span>Terdaftar Di Sistem Informasi Ini</span>
          </div>
          <div class="icon">
            <i class="fa fa-th-large"></i>
          </div>
          <span class="small-box-footer">&nbsp;</span>
        </div>
      </div>

      <!-- <div class="col-md-4 tambah">
        <a href="{{route('ukm.create')}}">
          <div class="box box-widget widget-user shadow" style=" border-bottom:4px solid #3C8DBC; padding-left:-20px;">
            <div class="widget-user-header" style="background:#222D32; padding-left:-20px; text-align: center;">
                <i class="fa fa-plus-square-o" style="font-size:100px; top:5px; position: absolute; margin-left: -40px;"></i>
              <div class="col-md-12" style="bottom:5px; margin-bottom:5px; position: absolute; text-align: center; margin-left: -20px;">
                Tambah UKM Baru
              </div>
            </div>
          </div>
        </a>
      </div> -->

    </div>

    <div class="row">

      <div class="col-xs-12">
        <div class="box box-primary">
          <!-- <div class="box-header with-border">
            <h3 class="box-title">UKM Saya</h3>
          </div> -->
          <div class="box-body">
            <blockquote>
              <p>UKM Terdaftar</p>
              <small>Berikut adalah UKM di Politeknik TEDC Bandung yang terdaftar di sistem informasi ini.</small>
            </blockquote>

              @foreach($ukm as $u)
              <div class="col-md-4">
                <div class="box box-widget widget-user shadow" style=" border-bottom:4px solid #3C8DBC;">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header" style="background:#222D32; color:white; padding-left: 0px;">
                    <p class="widget-user-username col-md-8" style="font-size: 12pt;">{{$u->nama_ukm}}</p>
                    <!-- <h6 class=col-md-8>{{ substr($u->profil, 0, 70)}} . . .</h6> -->
                    <div class="" style="bottom:5px; margin-bottom:5px; position: absolute; margin-left: 15px;">
                      <a class="btn btn-sm btn-danger col-md-6" data-toggle="modal" data-target="#modal-danger{{$u->id}}" style="margin-right: 2px;">
                        Hapus <i class="fa fa-trash"></i>
                      </a>
                      &nbsp;
                      <a href="{{route('infoUkm.index', $u->id)}}" class="btn btn-sm btn-primary col-md-5">
                        Info <i class="fa fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  <div class="widget-user-image" style="margin-top: -55px; text-align: right; right:20px;">
                    @if($u->logo_ukm)
                      <img class="img-square" src="{{url($u->logo_ukm)}}" alt="User Avatar" style="width: 100px; height: 100px;">
                    @else
                    <img class="img-square" src="{{url('/foto/default-image.png')}}" alt="User Avatar" style="width: 100px; height: 100px;">
                    @endif
                  </div>
                  <!-- <div class="box-footer" style="margin:0px;">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="description-block" style="text-align: right;">
                            <h5 class="description-header" style="margin-top: -25px;">
                              <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-danger{{$u->id}}">
                                Hapus Ukm <i class="fa fa-trash"></i>
                              </a>
                              <a href="{{route('infoUkm.index', $u->id)}}" class="btn btn-sm btn-success">
                                Info Lengkap  <i class="fa fa-arrow-circle-right"></i>
                              </a>
                            </h5>
                        </div>
                      </div>
                    </div>
                  </div> -->
                </div>
              </div>

              <!-- modal konfirmasi hapus -->
              <div class="modal modal-danger fade" id="modal-danger{{$u->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Konfirmasi</h4>
                    </div>
                    <div class="modal-body">
                      <p>Anda yakin akan menghapus Ukm {{$u->nama_ukm}} ?</p>
                    </div>
                    <div class="modal-footer">
                      <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
                      <form action="{{ route('ukm.destroy', $u->id) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-outline">Ya</button>
                                <button type="button" data-dismiss="modal" class="btn btn-outline">Tidak</button>
                      </form>

                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              @endforeach
            </div>
          
        </div>
      </div>

    </div>
  </section>

@endsection
