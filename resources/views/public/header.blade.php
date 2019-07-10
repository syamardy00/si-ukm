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
          <a href="{{url('/login')}}" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa"></i> Helo, Silahkan Login Disini
            <!-- <span class="hidden-xs">Login</span> -->
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header" style="height:170px; padding:0px; padding-top:10px;">
              <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-body">
                    <br>
                    <form action="{{route('login')}}" method="post">
                    {{ csrf_field() }}
                    @if ($errors->has('username'))
                    <div class="form-group has-error col-md-12">
                      <div class="input-group">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username..." value="{{old('username')}}" required>
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      </div>
                      <span class="help-block">{{ $errors->first('username') }}</span>
                    </div>
                    @else
                    <div class="form-group col-md-12">
                      <div class="input-group">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username..." value="{{old('username')}}" required>
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      </div>
                    </div>
                    @endif

                    @if ($errors->has('password'))
                    <div class="form-group has-error col-md-12">
                      <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password..." required>
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      </div>
                      <span class="help-block">{{ $errors->first('password') }}</span>
                    </div>
                    @else
                    <div class="form-group col-md-12">
                      <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password..." required>
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                      </div>
                    </div>
                    @endif

                  </div>
                </div>
              </div>

            </li>
            <li class="user-footer">
              <div class="pull-right">
                <button type="submit" class="btn btn-default btn-flat">Masuk</button>
              </div>
            </li>
          </form>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
