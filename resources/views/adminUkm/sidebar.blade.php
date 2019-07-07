<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <br>
    <div class="user-panel">
      <div class="pull-left image">
      @if($ukm[0]['logo_ukm'])
        <img src="{{url($ukm[0]['logo_ukm'])}}" class="img-circle" alt="User Image" style="width:40px; height:40px;">
      @else
        <img src="{{url('/foto/default-image.png')}}" class="img-circle" alt="User Image" style="width:40px; height:40px;">
      @endif
      </div>
      <div class="pull-left info">
        <p style="font-size:9pt;">{{substr($ukm[0]['nama_ukm'], 0, 22)}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Admin-UKM</a>
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
        <a href="#">
          <i class="fa fa-th-large"></i> <span>Profil UKM</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('profilUkm.indexAdminUkm')}}"><i class="fa fa-circle-o"></i> Lihat Profil UKM</a></li>
          <li><a href="{{route('profilUkm.edit')}}"><i class="fa fa-edit"></i> Ubah Profil UKM</a></li>
        </ul>
      </li>

      <li class="treeview">
          <li><a href="{{route('galeriFoto.index')}}"><i class="fa fa-photo"></i> <span>Galeri Foto</span></a></li>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i> <span>Anggota UKM</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('anggotaUkm.tambah_dari_daftar')}}"><i class="fa fa-user-plus"></i> Tambah Anggota Baru</a></li>
          <li><a href="{{route('anggotaUkm.index')}}"><i class="fa fa-table"></i> Kelola Anggota</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-calendar"></i> <span>Program Kerja</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('prokerUkm.create')}}"><i class="fa fa-plus"></i> Tambah Proker</a></li>
          <li><a href="{{route('prokerUkm.index')}}"><i class="fa fa-table"></i> Kelola Proker</a></li>
        </ul>
      </li>

      <li class="treeview">
          <li><a href="{{route('calonAnggota.index')}}"><i class="fa fa-child"></i> <span>Calon Anggota</span></a></li>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-newspaper-o"></i> <span>Berita UKM</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('beritaUkm.create')}}"><i class="fa fa-plus"></i> Tambah Berita</a></li>
          <li><a href="{{route('beritaUkm.semuaBerita')}}"><i class="fa fa-list-alt"></i> Semua Berita</a></li>
          <li><a href="{{route('beritaUkm.index')}}"><i class="fa fa-table"></i> Kelola Berita</a></li>
        </ul>
      </li>
      <li class="header"></li>
      <li><a href="{{route('logout')}}"><i class="fa fa-circle-o text-red"></i> <span>Logout</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
