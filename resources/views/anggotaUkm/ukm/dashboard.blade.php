@extends('anggotaUkm.index')
@section('content')

<section class="content-header">
<h1>
  Dashboard UKM
  <!-- <small>Lihat Profil UKM</small> -->
</h1>
<ol class="breadcrumb">
  <li class="active"><a href="#"><i class="fa fa-dashboard"></i>Dashboard UKM</a></li>
</ol>
</section>

<section class="content">

  <div class="row">

    <div class="col-md-12">
      <!-- Widget: user widget style 1 -->
      <div class="box box-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header" style="background: #2C3B41; color:white;">
          <p class="nama-ukm">{{$ukm[0]['nama_ukm']}}</p>
          <p class="nama-poltek">Politeknik TEDC Bandung</p>
          <a href="#" data-toggle="modal" data-target="#modal-logo">
            <div class="col-md-2 pull-right logo-ukm" style="padding:0px;">
            @if($ukm[0]['logo_ukm'])
              <img class="img-square logo_ukm" src="{{url($ukm[0]['logo_ukm'])}}">
            @else
              <img class="img-square logo_ukm" src="{{url('/foto/default-image.png')}}">
            @endif
            </div>
          </a>
        </div>
        <div class="box-footer">
          <div class="row">
            <div class="col-sm-10">
              <div class="description-block" style="text-align: left; min-height: 70px;">
                <h5 class="description-header" style="margin-top: -25px;">Profil</h5>
                <span>
                  {{$ukm[0]['profil']}}
                </span>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-sm-3 border-right">
              <div class="description-block">
                <!-- <h5 class="description-header">3,200</h5> -->
                <span class="">
                  <i class="fa fa-phone"></i>&nbsp;
                  @if($ukm[0]['no_telepon'])
                    {{$ukm[0]['no_telepon']}}
                  @else
                    &nbsp; -
                  @endif
                </span>
              </div>
              <!-- /.description-block -->
            </div>

            <div class="col-sm-3 border-right">
              <div class="description-block">
                <!-- <h5 class="description-header">3,200</h5> -->
                <span class="">
                  <i class="fa fa-envelope"></i>&nbsp;
                  @if($ukm[0]['email'])
                    {{$ukm[0]['email']}}
                  @else
                    &nbsp; -
                  @endif
                </span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 border-right">
              <div class="description-block">
                <!-- <h5 class="description-header">13,000</h5> -->
                <span class="">
                  <i class="fa fa-instagram"></i>&nbsp;
                  @if($ukm[0]['instagram'])
                    <a href="https://www.instagram.com/{{$ukm[0]['instagram']}}" target="_blank">{{$ukm[0]['instagram']}}</a>
                  @else
                    &nbsp; -
                  @endif
                </span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3">
              <div class="description-block">
                <!-- <h5 class="description-header">35</h5> -->
                <span class="">
                  <i class="fa fa-globe"></i>&nbsp;
                  @if($ukm[0]['website'])
                    <a href="https://{{$ukm[0]['website']}}" target="_blank">{{$ukm[0]['website']}}</a>
                  @else
                    &nbsp; -
                  @endif
                </span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
      </div>
      <!-- /.widget-user -->
    </div>
  </div>

  <div class="row">

    <div class="col-lg-4 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{$jAnggota}} Orang</h3>
          <span>Anggota Aktif UKM</span>
        </div>
        <div class="icon">
          <i class="fa fa-user"></i>
        </div>
        <a href="{{route('anggotaUkm.anggotaUkm.index')}}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-4 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$jProker}} Proker</h3>
          <span>Belum Terlaksana</span>
        </div>
        <div class="icon">
          <i class="fa fa-calendar"></i>
        </div>
        <a href="{{route('anggotaUkm.prokerUkm.index')}}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-4 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{$jCalonAnggota}} Orang</h3>
          <span>Calon Anggota Baru Tahun Ini</span>
        </div>
        <div class="icon">
          <i class="fa fa-child"></i>
        </div>
        <a href="{{route('anggotaUkm.calonAnggota.index')}}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

  </div>

  <div class="row">

    <!-- kolom kiri -->
    <div class="col-md-6" style="padding:0px;">
      <div class="col-md-12">
        <div class="box box-primary" style="min-height: 125px;">
          <div class="box-header with-border">
            <h3 class="box-title">Visi</h3>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            {{$ukm[0]['visi']}}
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>

      <div class="col-md-12">
        <div class="box box-primary" style="min-height: 203px;">
          <div class="box-header with-border">
            <h3 class="box-title">Misi</h3>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            {!! $ukm[0]['misi'] !!}
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>

      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Galeri Kegiatan</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <?php $no = 1 ?>
                @if(sizeOf($foto) == 0)
                  <div class="item active">
                    <img src="{{url('/foto/default-image.png')}}" alt="First slide">
                    <div class="carousel-caption" style="background:rgba(0.16, 0.17, 0.20, 0.5); margin:0px; left:0; bottom:0; width:100%;">
                      Belum Ada Foto
                    </div>
                  </div>
                @endif
                @foreach($foto as $f)
                  @if($no == 1)
                    <div class="item active">
                  @else
                    <div class="item">
                  @endif
                      <img src="{{url($f->foto)}}" alt="First slide">
                    <div class="carousel-caption" style="background:rgba(0.16, 0.17, 0.20, 0.5); margin:0px; left:0; bottom:0; width:100%;">
                      {{substr($f->keterangan, 0, 100)}}
                    </div>
                  </div>
                  <?php $no++ ?>
                @endforeach

              </div>
              <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="fa fa-angle-left"></span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="fa fa-angle-right"></span>
              </a>
            </div>
            @if(sizeOf($foto) > 0)
            <hr>
            <center><h5><a href="{{route('anggotaUkm.galeriFoto.index')}}"><b>Selengkapnya</b></a></h5></center>
            @endif
          </div>
          <!-- /.box-body -->
        </div>
      </div>

    </div>
    <!-- end kolom kiri -->

    <div class="col-md-6" style="padding:0px;">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Struktur Kepengurusan</h3>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <a href="#" data-toggle="modal" data-target="#modal-struktur">
              <div class="widget-user-image">
              @if($ukm[0]['struktur'])
                <img class="img-square" src="{{url($ukm[0]['struktur'])}}" alt="User Avatar" style="width: 100%;">
              @else
                <img class="img-square" src="{{url('/foto/default-image.png')}}" alt="User Avatar" style="width: 100%;">
              @endif
              </div>
            </a>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>

    <!-- berita -->
      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
          <li class="active"><a href="#semua" data-toggle="tab">Semua Berita</a></li>
          <li><a href="#internal" data-toggle="tab">Berita Internal</a></li>
          <li><a href="#umum" data-toggle="tab">Berita Umum</a></li>
          </ul>
          <div class="tab-content" id="berita" style="min-height:80px; max-height:580px; overflow: scroll; overflow-x: hidden;">

          <div class="active tab-pane" id="semua">
            @if(sizeOf($berita) == 0)
              <center><h4>Belum Ada Berita</h4></center>
            @endif
            @foreach($berita as $b)
            <!-- Post -->
            <div class="post">
              <div class="user-block">
                <span class="username" style="margin-left: 0px;">
                  <a href="{{route('anggotaUkm.beritaUkm.show', $b->id)}}">{{$b->judul_berita}}</a>
                </span>
                <span class="description" style="margin-left: 0px;">
                  <i class="fa fa-calendar"></i> &nbsp;{{$b->tanggal_berita}} | &nbsp;
                  <i class="fa fa-lock"></i> &nbsp;{{$b->sifat_berita}}
                </span>
              </div>
              <!-- /.user-block -->
              <p>
                {{ strip_tags(str_replace("&nbsp;", '', substr($b->isi_berita, 0, 300))) }}
              </p>
              <ul class="list-inline">
              <li class="pull-right">
                <a href="{{route('anggotaUkm.beritaUkm.show', $b->id)}}" class="link-black text-sm"><i class="fa fa-eye margin-r-5"></i> Baca Berita
                  </a></li>
              </ul>
              <br>
            </div>
            @endforeach

          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="internal">
            @if(sizeOf($berita) == 0)
              <center><h4>Belum Ada Berita</h4></center>
            @endif
            @foreach($beritaI as $b)
            <!-- Post -->
            <div class="post">
              <div class="user-block">
                <span class="username" style="margin-left: 0px;">
                  <a href="{{route('anggotaUkm.beritaUkm.show', $b->id)}}">{{$b->judul_berita}}</a>
                </span>
                <span class="description" style="margin-left: 0px;">
                  <i class="fa fa-calendar"></i> &nbsp;{{$b->tanggal_berita}} | &nbsp;
                  <i class="fa fa-lock"></i> &nbsp;{{$b->sifat_berita}}
                </span>
              </div>
              <!-- /.user-block -->
              <p>
                {{ strip_tags(str_replace("&nbsp;", '', substr($b->isi_berita, 0, 300))) }}
              </p>
              <ul class="list-inline">
              <li class="pull-right">
                <a href="{{route('anggotaUkm.beritaUkm.show', $b->id)}}" class="link-black text-sm"><i class="fa fa-eye margin-r-5"></i> Baca Berita
                  </a></li>
              </ul>
              <br>
            </div>
            @endforeach

          </div>

          <div class="tab-pane" id="umum">
            @if(sizeOf($berita) == 0)
              <center><h4>Belum Ada Berita</h4></center>
            @endif
            @foreach($beritaU as $b)
            <!-- Post -->
            <div class="post">
              <div class="user-block">
                <span class="username" style="margin-left: 0px;">
                  <a href="{{route('anggotaUkm.beritaUkm.show', $b->id)}}">{{$b->judul_berita}}</a>
                </span>
                <span class="description" style="margin-left: 0px;">
                  <i class="fa fa-calendar"></i> &nbsp;{{$b->tanggal_berita}} | &nbsp;
                  <i class="fa fa-lock"></i> &nbsp;{{$b->sifat_berita}}
                </span>
              </div>
              <!-- /.user-block -->
              <p>
                {{ strip_tags(str_replace("&nbsp;", '', substr($b->isi_berita, 0, 300))) }}
              </p>
              <ul class="list-inline">
              <li class="pull-right">
                <a href="{{route('anggotaUkm.beritaUkm.show', $b->id)}}" class="link-black text-sm"><i class="fa fa-eye margin-r-5"></i> Baca Berita
                  </a></li>
              </ul>
              <br>
            </div>
            @endforeach

          </div>
          @if(sizeOf($berita) > 0)
          <hr>
          <center><h5><a href="{{route('anggotaUkm.beritaUkm.index')}}"><b>Selengkapnya</b></a></h5></center>
          @endif
          </div>
          <!-- /.tab-content -->
          </div>
      </div>

    </div>
  </div>


  <!-- modal  -->
  <div class="modal modal-info fade" id="modal-struktur">
    @if($ukm[0]['struktur'])
      <img class="" src="{{url($ukm[0]['struktur'])}}" style="margin:auto; top:0; right:0; left:0; bottom:0; position:absolute; width:800px;">
    @else
      <img class="" src="{{url('/foto/default-image.png')}}" style="margin:auto; top:0; right:0; left:0; bottom:0; position:absolute; width:800px;">
    @endif
  </div>

  <div class="modal modal-info fade" id="modal-logo">
    @if($ukm[0]['logo_ukm'])
      <img class="" src="{{url($ukm[0]['logo_ukm'])}}" style="margin:auto; top:0; right:0; left:0; bottom:0; position:absolute; width:500px;">
    @else
      <img class="" src="{{url('/foto/default-image.png')}}" style="margin:auto; top:0; right:0; left:0; bottom:0; position:absolute; width:500px;">
    @endif
  </div>

</section>

@endsection
