@extends('adminUkm.index')
@section('content')

<!-- bootstrap datepicker -->

  <section class="content-header">
  <h1>
    Berita UKM
    <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('beritaUkm.index')}}"><i class="fa fa-user"></i>Berita</a></li>
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
              <a href="{{route('beritaUkm.cetak_pdf', $berita[0]['id'])}}" class="btn btn-xs btn-primary pull-right">Simpan PDF &nbsp; <i class="fa fa-file-pdf-o"></i></a>
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
