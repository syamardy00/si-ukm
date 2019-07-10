@section('content')

<!-- bootstrap datepicker -->

  <section class="content-header">
  <h1>
    Berita UKM
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
    <li><a href="#"></a>Berita</li>
    <li class="active">Baca Berita</li>
  </ol>
  </section>

  <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Baca Berita</h3>
              @if(!Auth::guard('')->check())

              @else
                <a href="{{route('public.beritaUkm.cetak_pdf', $berita[0]['id'])}}" class="btn btn-xs btn-primary pull-right">Simpan PDF &nbsp; <i class="fa fa-file-pdf-o"></i></a>
              @endif
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">

                <div class="post">
                  <div class="user-block">
                    <span class="username" style="margin-left: 0px; margin-botom:5px;">
                      <a href="#">{{$berita[0]['judul_berita']}}</a>
                    </span>
                    <span class="description" style="margin-left: 0px; padding-top:5px;">
                      <i class="fa fa-tag"></i> &nbsp;{{$ukm[0]['nama_ukm']}} | &nbsp;
                      <i class="fa fa-calendar"></i> &nbsp;{{$berita[0]['tanggal_berita']}} | &nbsp;
                      <i class="fa fa-lock"></i> &nbsp;{{$berita[0]['sifat_berita']}}
                    </span>
                  </div>
                  <hr>
                  <!-- /.user-block -->
                  <p>
                    {!! $berita[0]['isi_berita'] !!}
                  </p>
                  <br>
                </div>

            </div>
          </div>
        </div>
  </section>

@endsection
