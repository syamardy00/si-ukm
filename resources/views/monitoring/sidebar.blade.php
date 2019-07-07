<aside class="main-sidebar" style="overflow-y: auto; height:90%;" id="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar" id="main-sidebar">
    <!-- Sidebar user panel -->
    <br>
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{url('foto/si-ukm.png')}}" class="img-circle" alt="User Image" style="width:40px; height:40px;">
      </div>
      <div class="pull-left info">
        <p style="font-size:9pt;">{{substr($user->username, 0, 19)}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Monitoring</a>
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
          <li><a href="{{route('monitoring.ukm.index')}}"><i class="fa fa-th-large"></i> <span>UKM</span></a></li>
      </li>

      <li class="treeview">
          <li><a href="{{route('monitoring.user.edit')}}"><i class="fa fa-lock"></i> <span>Ganti Password</span></a></li>
      </li>

    </ul>


      @if(Session::has('monitoringUkmDipilih'))

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
            <li><a href="{{route('monitoring.profilUkm')}}"><i class="fa fa-dashboard"></i> <span>Dashboard UKM</span></a></li>
        </li>

        <li class="treeview">
            <li><a href="{{route('monitoring.galeriFoto.index')}}"><i class="fa fa-photo"></i> <span>Galeri Foto</span></a></li>
        </li>

        <li class="treeview">
            <li><a href="{{route('monitoring.anggotaUkm.index')}}"><i class="fa fa-users"></i> <span>Anggota UKM</span></a></li>
        </li>

        <li class="treeview">
            <li><a href="{{route('monitoring.prokerUkm.index')}}"><i class="fa fa-calendar"></i> <span>Program Kerja</span></a></li>
        </li>

        <li class="treeview">
            <li><a href="{{route('monitoring.calonAnggota.index')}}"><i class="fa fa-child"></i> <span>Calon Anggota</span></a></li>
        </li>

        <li class="treeview">
            <li><a href="{{route('monitoring.beritaUkm.index')}}"><i class="fa fa-newspaper-o"></i> <span>Berita UKM</span></a></li>
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
