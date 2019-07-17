<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <br>
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{url('foto/si-ukm.png')}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>SI-UKM Admin</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Admin</a>
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
          <i class="fa fa-th-large"></i> <span>UKM</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('ukm.create')}}"><i class="fa fa-plus"></i> Tambah UKM Baru</a></li>
          <li><a href="{{route('admin')}}"><i class="fa fa-table"></i> Kelola UKM</a></li>
        </ul>
      </li>

      <li>
        <a href="{{route('user.index')}}">
          <i class="fa fa-users"></i> <span>Kelola Akun Admin UKM</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-tv"></i> <span>Kelola Akun Monitoring</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('userMonitoring.create')}}"><i class="fa fa-plus"></i> Tambah Akun Monitoring</a></li>
          <li><a href="{{route('userMonitoring.index')}}"><i class="fa fa-table"></i> Kelola Akun Monitoring</a></li>
        </ul>
      </li>

      <li>
        <a href="{{route('jurusan.index')}}">
          <i class="fa fa-mortar-board"></i> <span>Kelola Jurusan</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>

      <li class="header"></li>
      <li><a href="{{route('logout')}}"><i class="fa fa-circle-o text-red"></i> <span>Logout</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
