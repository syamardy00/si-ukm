@extends('anggotaUkm.index')
@section('content')

  <section class="content-header">
  <h1>
    Semua Berita
    <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard UKM</a></li>
    <li class="active">Berita</li>
  </ol>
  </section>

  <section class="content">
    <div class="row">
      <!-- berita -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <li class="active"><a href="#semua" data-toggle="tab">Semua Berita</a></li>
            <li><a href="#internal" data-toggle="tab">Berita Internal</a></li>
            <li><a href="#umum" data-toggle="tab">Berita Umum</a></li>
            </ul>
            <div class="tab-content">

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
                {{ $berita->links() }}
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
              {{ $beritaI->links() }}
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
              {{ $beritaU->links() }}
            </div>
            </div>
            <!-- /.tab-content -->
            </div>
        </div>

    </div>
  </section>

@endsection

@section('js')

@stop
