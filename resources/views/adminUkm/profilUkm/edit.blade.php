@extends('adminUkm.index')
@section('content')

<link rel="stylesheet" href="{{url('/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
<link rel="stylesheet" href="{{url('/assets/dist/css/skins/_all-skins.min.css')}}">
<!-- bootstrap wysihtml5 - text editor -->

<section class="content-header">
<h1>
  Edit Profil UKM
  <!-- <small>Lihat Profil UKM</small> -->
</h1>
<ol class="breadcrumb">
  <li><a href="{{route('profilUkm.indexAdminUkm')}}"><i class="fa fa-user"></i>Profil UKM</a></li>
  <li class="active">Edit Profil UKM</li>
</ol>
</section>

<section class="content">
  <div class="row">

    <div class="col-md-9">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form Edit Profil UKM</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="POST" action="{{route('profilUkm.update')}}" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PATCH') }}
          <div class="box-body">

            <div class="col-md-6" style="padding: 0px;">
              @if ($errors->has('nama_ukm'))
              <div class="form-group has-error col-md-12">
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Nama UKM</label>
                  <input type="text" class="form-control" id="nama_ukm" name="nama_ukm" placeholder="Nama UKM..." style="width: 400px;" value="{{old('nama_ukm')}}" required>
                <span class="help-block">{{ $errors->first('nama_ukm') }}</span>
              </div>
              @else
              <div class="form-group col-md-12">
                <label for="namaUkm">Nama UKM</label>
                <input type="text" class="form-control" id="nama_ukm" name="nama_ukm" placeholder="Nama UKM..."  value="{{$ukm[0]['nama_ukm']}}" required>
              </div>
              @endif
            </div>

            <div class="form-group col-md-12">
              <label for="profil">Profil</label>
              <textarea class="form-control" name="profil" id="profil" rows="3" placeholder="Sekilas profil tentang UKM ..." required>{{$ukm[0]['visi']}}</textarea>
            </div>
            <div class="form-group col-md-12">
              <label for="visi">Visi</label>
              <textarea class="form-control" name="visi" id="visi" rows="3" placeholder="Visi ..." required>{{$ukm[0]['visi']}}</textarea>
            </div>
            <div class="form-group col-md-12">
              <label for="misi">Misi</label>
                <textarea name="misi" id="editor1" placeholder="Misi ..." required
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$ukm[0]['misi']}}</textarea>
            </div>

            <div class="col-md-4" style="padding: 0px;">
              @if ($errors->has('email'))
              <div class="form-group col-md-12 has-error">
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Email</label>
                <div class="input-group col-md-12">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
                  <span class="help-block">{{ $errors->first('email') }}</span>
                </div>
              </div>
              @else
              <div class="form-group col-md-12">
                <label>Email</label>
                <div class="input-group col-md-12">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="email" class="form-control" placeholder="Email" name="email" value="{{$ukm[0]['email']}}">
                </div>
              </div>
              @endif
            </div>

            <div class="col-md-4" style="padding: 0px;">
              @if ($errors->has('no_telepon'))
              <div class="form-group has-error col-md-12">
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> No Telepon</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="No Telepon..." value="{{old('no_telepon')}}" data-inputmask='"mask": "9999-9999-9999"' data-mask required>
                </div>
                <span class="help-block">{{ $errors->first('no_telepon') }}</span>
              </div>
              @else
              <div class="form-group col-md-12">
                <label for="nim">No Telepon</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="No Telepon..." value="{{$ukm[0]['no_telepon']}}" data-inputmask='"mask": "9999-9999-9999"' data-mask required>
                </div>
              </div>
              @endif
            </div>

            <div class="col-md-4" style="padding: 0px;">
              @if ($errors->has('instagram'))
              <div class="form-group col-md-12 has-error">
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Instagram</label>
                <div class="input-group col-md-12">
                  <span class="input-group-addon">@</span>
                  <input type="text" class="form-control" placeholder="Instagram" name="instagram" value="{{old('instagram')}}">
                  <span class="help-block">{{ $errors->first('instagram') }}</span>
                </div>
              </div>
              @else
              <div class="form-group col-md-12">
                <label>Instagram</label>
                <div class="input-group col-md-12">
                  <span class="input-group-addon">@</span>
                  <input type="text" class="form-control" placeholder="Instagram" name="instagram" value="{{$ukm[0]['instagram']}}">
                </div>
              </div>
              @endif
            </div>

            <div class="col-md-6" style="padding: 0px;">
              @if ($errors->has('website'))
              <div class="form-group col-md-12 has-error">
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Website</label>
                <div class="input-group col-md-12">
                  <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                  <input type="text" class="form-control" placeholder="www.example.com" name="website" value="{{old('website')}}">
                  <span class="help-block">{{ $errors->first('website') }}</span>
                </div>
              </div>
              @else
              <div class="form-group col-md-12">
                <label>Website</label>
                <div class="input-group col-md-12">
                  <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                  <input type="text" class="form-control" placeholder="www.example.com" name="website" value="{{$ukm[0]['website']}}">
                </div>
              </div>
              @endif
            </div>

          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Logo UKM</h3>
        </div>
        <div class="box-body">
        @if($ukm[0]['logo_ukm'])
          <img class="img-square" id="logoUkm" src="{{url($ukm[0]['logo_ukm'])}}" alt="Logo UKM" style="width: 100%;">
        @else
          <img class="img-square" id="logoUkm" src="{{url('/foto/default-image.png')}}" alt="Logo UKM" style="width: 100%;">
        @endif
          <hr>
          <input type="file" name="logo_ukm" id="previewLogo" class="btn btn-primary col-md-12">
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Struktur Kepengurusan</h3>
        </div>
        <div class="box-body">
        @if($ukm[0]['struktur'])
          <img class="img-square" src="{{url($ukm[0]['struktur'])}}" id="struktur" alt="struktur" style="width: 100%;">
        @else
          <img class="img-square" src="{{url('/foto/default-image.png')}}" id="struktur" alt="struktur" style="width: 100%;">
        @endif
          <hr>
          <input type="file" name="struktur" id="previewStruktur" class="btn btn-primary col-md-12">
        </div>
      </div>
    </div>

  </form>

  </div>
</section>
@endsection

@section('js')
<!-- InputMask -->
<script src="{{url('/assets/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{url('/assets/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{url('/assets/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>

<script src="{{url('/assets/bower_components/ckeditor/ckeditor.js')}}"></script>
<script src="{{url('/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })

  //Datemask dd/mm/yyyy
  $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
  //Datemask2 mm/dd/yyyy
  $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
  //Money Euro
  $('[data-mask]').inputmask()

  function bacaLogo(input){
    if(input.files && input.files[0]){
      var reader = new FileReader();

      reader.onload = function(e){
        $('#logoUkm').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);

    }
  }

  function bacaStruktur(input){
    if(input.files && input.files[0]){
      var reader = new FileReader();

      reader.onload = function(e){
        $('#struktur').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);

    }
  }

  $('#previewLogo').change(function(){
    bacaLogo(this);
  });

  $('#previewStruktur').change(function(){
    bacaStruktur(this);
  });

</script>
@stop
