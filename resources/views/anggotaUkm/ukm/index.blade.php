@extends('anggotaUkm.index')
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
  UKM
  <!-- <small>Lihat Profil UKM</small> -->
</h1>
<ol class="breadcrumb">
  <li class="active"><a href="#"><i class="fa fa-th-large"></i>UKM</a></li>
</ol>
</section>

<section class="content">

  <div class="row">

    <div class="col-xs-12">
      <div class="box box-primary">
        <!-- <div class="box-header with-border">
          <h3 class="box-title">UKM Saya</h3>
        </div> -->
        <div class="box-body">
          <blockquote>
            <p>UKM Saya</p>
            <small>Anda terdaftar sebagai anggota di UKM berikut.</small>
          </blockquote>
          @foreach($myUkm as $u)
          <div class="col-md-4">
            <div class="small-box shadow" style="background:#3A3F4B; color:#fff;">
              <div class="inner">
                @if($u[0]->logo_ukm)
                  <div class="widget-user-image img-rounded" style="text-align: right; right:20px; text-align:center; height:150px; width:100%;
                  background:url({{url($u[0]->logo_ukm)}}); background-size:cover; background-position:center; margin-bottom:5px;">
                  </div>
                @else
                  <div class="widget-user-image img-rounded" style="text-align: right; right:20px; text-align:center; height:150px; width:100%;
                  background:url({{url('/foto/default-image.png')}}); background-size:cover; background-position:center; margin-bottom:5px;">
                  </div>
                @endif

                <font style="font-size:11pt; font-weight:bold;"><center>{{substr($u[0]->nama_ukm, 0, 33)}}</center></font>
              </div>
              <!-- <div class="icon">
                <i class="fa fa-user"></i>
              </div> -->
              <form method="POST" action="{{route('anggotaUkm.ukm.dashboard')}}">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <input type="hidden" name="id_ukm" value="{{$u[0]->id}}">
                <div class="small-box-footer" style="text-align:center; padding:3px; background:#313640;">
                  <a><button type="submit" class="btn btn-xs btn-flat" style="width:100%; background:#3A3F4B; color:#fff;">Dashboard <i class="fa fa-arrow-circle-right"></i></button></a>
                </div>
              </form>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="col-xs-12">
      <div class="box box-danger">
        <div class="box-body">
          <blockquote>
            <p>UKM Lainya</p>
            <small>Berikut adalah UKM lainya yang ada di Politeknik TEDC Bandung.</small>
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
              <form method="POST" action="{{route('anggotaUkm.ukm.dashboard')}}">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <input type="hidden" name="id_ukm" value="{{$u->id}}">
                <div class="small-box-footer" style="text-align:center; padding:3px; background:#313640;">
                  <a href="{{route('anggotaUkm.ukm.profilUkm', $u->id)}}" class="btn btn-flat btn-xs" style="width:100%; background:#3A3F4B; color:#fff;">Profil UKM <i class="fa fa-arrow-circle-right"></i></a>
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
