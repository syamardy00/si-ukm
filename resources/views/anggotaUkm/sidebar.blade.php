<aside class="main-sidebar" style="overflow-y: auto; height:90%;" id="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <br>
    <div class="user-panel">
      <div class="pull-left image">
      @if($profil[0]['foto'])
        <img src="{{$profil[0]['foto']}}" class="img-circle" alt="User Image" style="width:40px; height:40px;">
      @else
        <img src="{{url('/foto/default-image.png')}}" class="img-circle" alt="User Image" style="width:40px; height:40px;">
      @endif
      </div>
      <div class="pull-left info">
        <p style="font-size:9pt;">{{substr($profil[0]['nama'], 0, 22)}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Anggota-UKM</a>
      </div>
    </div>
    <br>

    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENU ANGGOTA</li>

      <li class="treeview">
          <li><a href="{{route('anggotaUkm.ukm.index')}}"><i class="fa fa-th-large"></i> <span>UKM</span></a></li>
      </li>

      <li class="treeview">
          <li><a href="{{route('anggotaUkm.profilUser.index')}}"><i class="fa fa-user"></i> <span>Profil Saya</span></a></li>
      </li>

    </ul>

      @if(Session::has('ukmDipilih'))
      <div class="user-panel" style="border-top:3px solid #1A2226;">
        <div class="pull-left image">
          @if($ukm[0]->logo_ukm)
            <img src="{{url($ukm[0]->logo_ukm)}}" class="img-circle" alt="User Image" style="width:40px; height:40px;">
          @else
            <img src="{{url('/foto/default-image.png')}}" class="img-circle" alt="User Image" style="width:40px; height:40px;">
          @endif
        </div>
        <div class="pull-left info" style="padding-top:14px; font-size:9pt;">
          <p>{{substr($ukm[0]->nama_ukm, 0, 22)}}</p>
        </div>
      </div>

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU UKM</li>

        <li class="treeview">
            <li><a href="{{route('anggotaUkm.ukm.dashboardProfilUkm')}}"><i class="fa fa-dashboard"></i> <span>Dashboard UKM</span></a></li>
        </li>

        <li class="treeview">
            <li><a href="{{route('anggotaUkm.galeriFoto.index')}}"><i class="fa fa-photo"></i> <span>Galeri Foto</span></a></li>
        </li>

        <li class="treeview">
            <li><a href="{{route('anggotaUkm.anggotaUkm.index')}}"><i class="fa fa-users"></i> <span>Anggota UKM</span></a></li>
        </li>

        <li class="treeview">
            <li><a href="{{route('anggotaUkm.prokerUkm.index')}}"><i class="fa fa-calendar"></i> <span>Program Kerja</span></a></li>
        </li>

        <li class="treeview">
            <li><a href="{{route('anggotaUkm.calonAnggota.index')}}"><i class="fa fa-child"></i> <span>Calon Anggota</span></a></li>
        </li>

        <li class="treeview">
            <li><a href="{{route('anggotaUkm.beritaUkm.index')}}"><i class="fa fa-newspaper-o"></i> <span>Berita UKM</span></a></li>
        </li>

      @endif
    </ul>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header"></li>
      <li><a href="{{route('logout')}}"><i class="fa fa-circle-o text-red"></i> <span>Logout</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
