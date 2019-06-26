<header class="main-header">
  <!-- Logo -->
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b></b>UKM</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>SI - </b>UKM</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          @if($ukm[0]['logo_ukm'])
            <img src="{{url($ukm[0]['logo_ukm'])}}" class="user-image" alt="User Image">
          @else
            <img src="{{url('/foto/default-image.png')}}" class="user-image" alt="User Image">
          @endif
            <span class="hidden-xs">{{$ukm[0]['nama_ukm']}}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
            @if($ukm[0]['logo_ukm'])
              <img src="{{url($ukm[0]['logo_ukm'])}}" class="img-circle" alt="User Image">
            @else
              <img src="{{url('/foto/default-image.png')}}" class="img-circle" alt="User Image">
            @endif
              <p>
                {{$ukm[0]['nama_ukm']}}
                <!-- <small>Member since Nov. 2018</small> -->
              </p>
            </li>
            <!-- Menu Body -->
            <!-- <li class="user-body">
              <div class="row">
                <div class="col-xs-4 text-center">
                  <a href="#">Followers</a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#">Sales</a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#">Friends</a>
                </div>
              </div>
            </li> -->
            <!-- Menu Footer-->
            <li class="user-footer">
              <!-- <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div> -->
              <div class="pull-right">
                <a href="{{route('logout')}}" class="btn btn-default btn-flat">Logout</a>
              </div>
              <div class="pull-right">
                <a href="{{route('userAdminUkm.edit')}}" class="btn btn-default btn-flat">Edit Akun</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
