@section('content')

  <section class="content-header">
  <h1>
    Semua Berita
    <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    @if(Auth::guard('anggotaUkm')->check())
      <li><a href="{{route('anggotaUkm.ukm.dashboardProfilUkm')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    @elseif(Auth::guard('monitoring')->check())
      <li><a href="#"><i class="fa fa-tv"></i>Monitoring</a></li>
    @endif
    <li class="active">Berita</li>
  </ol>
  </section>

  <section class="content">
    <div class="row">
      <!-- berita -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <li class="active"><a href="#semua" data-toggle="tab">Berita</a></li>
            </ul>
            <div class="tab-content">

            <div class="active tab-pane" id="umum">
              @if(sizeOf($beritaU) == 0)
                <center><h4>Belum Ada Berita</h4></center>
              @endif
              @foreach($beritaU as $b)
              <!-- Post -->
              <div class="post">
                <div class="user-block">
                  <span class="username" style="margin-left: 0px;">
                  @if(Auth::guard('monitoring')->check())
                    <a href="{{url('/monitoring/berita-ukm/baca/'.$b->id)}}">{{$b->judul_berita}}</a>
                  @else
                    <a href="{{url('/ukm/profil-ukm/berita/baca/'.$b->id)}}">{{$b->judul_berita}}</a>
                  @endif
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
                @if(Auth::guard('monitoring')->check())
                  <a href="{{url('/monitoring/berita-ukm/baca/'.$b->id)}}" class="link-black text-sm"><i class="fa fa-eye margin-r-5"></i> Baca Berita
                  </a></li>
                @else
                  <a href="{{url('/ukm/profil-ukm/berita/baca/'.$b->id)}}" class="link-black text-sm"><i class="fa fa-eye margin-r-5"></i> Baca Berita
                  </a></li>
                @endif
                </ul>
                <br>
              </div>
              @endforeach

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
