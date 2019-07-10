@extends('monitoring.index')
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
  Daftar UKM Di Politeknik TEDC Bandung.
  <!-- <small>Lihat Profil UKM</small> -->
</h1>
<ol class="breadcrumb">
  <li class="active"><a href="#"><i class="fa fa-th-large"></i>UKM</a></li>
</ol>
</section>

<section class="content">
  <div class="row">

      <div class="col-lg-4 col-xs-6">
        <div class="small-box bg-aqua">
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

      <div class="col-lg-4 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{sizeOf($anggota)}} Orang</h3>
            <span>Mahasiswa aktif di UKM.</span>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <span class="small-box-footer">&nbsp;</span>
        </div>
      </div>

      <div class="col-lg-4 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{sizeOf($calonAnggota)}} Orang</h3>
            <span>Calon anggota yg mendaftar UKM tahun ini.</span>
          </div>
          <div class="icon">
            <i class="fa fa-child"></i>
          </div>
          <span class="small-box-footer">&nbsp;</span>
        </div>
      </div>

  </div>

  <div class="row">

    <div class="col-xs-12">
      <div class="box box-primary">
        <!-- <div class="box-header with-border">
          <h3 class="box-title">UKM Lainya</h3>
        </div> -->
        <div class="box-body">
          <blockquote>
            <p>UKM</p>
            <small>Berikut adalah UKM yang ada di Politeknik TEDC Bandung.</small>
          </blockquote>
          @foreach($ukm as $u)
          <div class="col-md-4">
            <div class="small-box shadow" style="background:#3A3F4B; color:#fff;">
              <div class="inner">
                @if($u->logo_ukm)
                  <div class="widget-user-image img-rounded" style="text-align: right; right:20px; text-align:center; height:150px; width:100%;
                  background:url({{url($u->logo_ukm)}}); background-size:cover; background-position:center; margin-bottom:5px;">
                  </div>
                @else
                  <div class="widget-user-image img-rounded" style="text-align: right; right:20px; text-align:center; height:150px; width:100%;
                  background:url({{url('/foto/default-image.png')}}); background-size:cover; background-position:center; margin-bottom:5px;">
                  </div>
                @endif

                <font style="font-size:11pt; font-weight:bold;"><center>{{substr($u->nama_ukm, 0, 33)}}</center></font>
              </div>
              <!-- <div class="icon">
                <i class="fa fa-user"></i>
              </div> -->
              <form method="POST" action="{{route('monitoring.profilUkm.index')}}">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <input type="hidden" name="id_ukm" value="{{$u->id}}">
                <div class="small-box-footer" style="text-align:center; padding:3px; background:#313640;">
                  <a><button type="submit" class="btn btn-xs btn-flat" style="width:100%; background:#3A3F4B; color:#fff;">Selengkapnya <i class="fa fa-arrow-circle-right"></i></button></a>
                </div>
              </form>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>




  </div>
</section>
@endsection

@section('js')
@stop
