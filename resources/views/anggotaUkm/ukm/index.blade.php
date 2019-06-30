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
            <div class="box box-widget widget-user shadow" style=" border-bottom:4px solid #3C8DBC;">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header" style="background:#222D32; color:white; padding-left: 0px;">
                <p class="widget-user-username col-md-8" style="font-size: 12pt;">{{$u[0]->nama_ukm}}</p>
                <div class="" style="bottom:5px; margin-bottom:5px; position: absolute; margin-left: 15px;">
                  <form method="POST" action="{{route('anggotaUkm.ukm.dashboard')}}">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <input type="hidden" name="id_ukm" value="{{$u[0]->id}}">
                    <button type="submit" href="" class="btn btn-sm btn-primary col-md-12">
                      Dashboard <i class="fa fa-arrow-circle-right"></i>
                    </button>
                  </form>
                </div>
              </div>
              <div class="widget-user-image" style="margin-top: -55px; text-align: right; right:20px;">
                @if($u[0]->logo_ukm)
                  <img class="img-square" src="{{url($u[0]->logo_ukm)}}" alt="User Avatar" style="width: 100px; height: 100px;">
                @else
                <img class="img-square" src="{{url('/foto/default-image.png')}}" alt="User Avatar" style="width: 100px; height: 100px;">
                @endif
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="col-xs-12">
      <div class="box box-danger">
        <!-- <div class="box-header with-border">
          <h3 class="box-title">UKM Lainya</h3>
        </div> -->
        <div class="box-body">
          <blockquote>
            <p>UKM Lainya</p>
            <small>Berikut adalah UKM lainya yang ada di Politeknik TEDC Bandung.</small>
          </blockquote>
          @foreach($ukm as $u)
          <div class="col-md-4">
            <div class="box box-widget widget-user shadow" style=" border-bottom:4px solid #DD4B39;">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header" style="background:#222D32; color:white; padding-left: 0px;">
                <p class="widget-user-username col-md-8" style="font-size: 12pt;">{{$u->nama_ukm}}</p>
                <div class="" style="bottom:5px; margin-bottom:5px; position: absolute; margin-left: 15px;">
                  <a href="{{route('anggotaUkm.ukm.profilUkm', $u->id)}}" class="btn btn-sm btn-primary col-md-12">
                    Profil UKM <i class="fa fa-arrow-circle-right"></i>
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
