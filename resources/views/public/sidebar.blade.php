<aside class="main-sidebar" style="overflow-y: auto; height:90%;" id="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar" id="main-sidebar">
    <!-- Sidebar user panel -->
    <br>
    <div class="user-panel">
      <div class="pull-left image">
        @if($ukm[0]->logo_ukm)
          <img src="{{url($ukm[0]->logo_ukm)}}" class="img-circle" alt="User Image" style="width:40px; height:40px;">
        @else
          <img src="{{url('/foto/default-image.png')}}" class="img-circle" alt="User Image" style="width:40px; height:40px;">
        @endif
      </div>
      <div class="pull-left info">
        <p style="font-size:9pt;">{{substr($ukm[0]->nama_ukm, 0, 22)}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Guest</a>
      </div>
    </div>
    <br>
    <!-- search form -->
    <!-- <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form> -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">

      <li class="header">MENU</li>

      <li class="treeview">
          <li><a href="{{route('home')}}"><i class="fa fa-home"></i> <span>Home</span></a></li>
      </li>

      <li class="treeview">
          <li><a href="{{route('guest.profilUkm.index', $ukm[0]->id)}}"><i class="fa fa-user"></i> <span>Profil UKM</span></a></li>
      </li>

      <li class="treeview">
          <li><a href="{{route('guest.galeriFoto.index', $ukm[0]->id)}}"><i class="fa fa-photo"></i> <span>Galeri Foto</span></a></li>
      </li>

      <li class="treeview">
          <li><a href="{{route('guest.beritaUkm.index', $ukm[0]->id)}}"><i class="fa fa-newspaper-o"></i> <span>Berita UKM</span></a></li>
      </li>

      <li class="header"></li>

      @if($ukm[0]->pendaftaran == 1)
        <li class="treeview">
            <li><a href="{{route('guest.pendaftaran.create', $ukm[0]->id)}}"><i class="fa fa fa-circle-o text-green"></i> <span>Form Pendaftaran</span></a></li>
        </li>
      @else
        <li class="treeview">
            <li><a href="#" data-toggle="modal" data-target="#modal-pendaftaran-ditutup"><i class="fa fa fa-circle-o text-red"></i> <span>Form Pendaftaran</span></a></li>
        </li>
      @endif

    </ul>

  </section>
  <!-- /.sidebar -->
</aside>
