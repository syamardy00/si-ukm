@extends('adminUkm.index')
@section('content')

  <section class="content-header">
  <h1>
    Data Calon Anggota
    <!-- <small>Lihat Profil UKM</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('calonAnggota.index')}}"><i class="fa fa-user"></i>Calon Anggota</a></li>
    <li class="active">Detail Calon Anggota</li>
  </ol>
  </section>

  <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Detail Calon Anggota</h3>
              <a href="{{route('calonAnggota.cetak_pdf', $calonAnggota[0]->id)}}" class="btn btn-xs btn-primary pull-right">Simpan PDF &nbsp; <i class="fa fa-file-pdf-o"></i></a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <dl class="dl-horizontal">
                <dt style="">Nama UKM &nbsp &nbsp</dt>
                <dd style="border-left:1px solid black; border-bottom:1px solid black; padding:5px;">{{$ukm[0]['nama_ukm']}}</dd>

                <dt>Tanggal Pendaftaran &nbsp &nbsp</dt>
                <dd style="border-left:1px solid black; border-bottom:1px solid black; padding:5px;">{{$calonAnggota[0]->tgl_pendaftaran}}</dd>

                <dt>NIM &nbsp &nbsp</dt>
                <dd style="border-left:1px solid black; border-bottom:1px solid black; padding:5px;">{{$calonAnggota[0]->nim}}</dd>

                <dt>Nama Lengkap &nbsp &nbsp</dt>
                <dd style="border-left:1px solid black; border-bottom:1px solid black; padding:5px;">{{$calonAnggota[0]->nama}}</dd>

                <dt>Jenis Kelamin &nbsp &nbsp</dt>
                <dd style="border-left:1px solid black; border-bottom:1px solid black; padding:5px;">{{$calonAnggota[0]->jenis_kelamin}}</dd>

                <dt>Tanggal Lahir &nbsp &nbsp</dt>
                <dd style="border-left:1px solid black; border-bottom:1px solid black; padding:5px;">{{$calonAnggota[0]->tgl_lahir}}</dd>

                <dt>Jurusan &nbsp &nbsp</dt>
                <dd style="border-left:1px solid black; border-bottom:1px solid black; padding:5px;">{{$calonAnggota[0]->nama_jurusan}}</dd>

                <dt>Tahun Angkatan &nbsp &nbsp</dt>
                <dd style="border-left:1px solid black; border-bottom:1px solid black; padding:5px;">{{$calonAnggota[0]->tahun_angkatan}}</dd>

                <dt>Email &nbsp &nbsp</dt>
                <dd style="border-left:1px solid black; border-bottom:1px solid black; padding:5px;">{{$calonAnggota[0]->email}}</dd>

                <dt>No Telepon &nbsp &nbsp</dt>
                <dd style="border-left:1px solid black; border-bottom:1px solid black; padding:5px;">{{$calonAnggota[0]->no_telepon}}</dd>


                </dd>
              </dl>
            </div>
          </div>
        </div>

  </section>

@endsection
