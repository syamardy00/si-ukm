@if(Auth::guard('adminUkm')->check())
  @include('adminUkm.sidebar')
@elseif(Auth::guard('admin')->check())
  @include('admin.sidebar')
@elseif(Auth::guard('anggotaUkm')->check())
  @include('anggotaUkm.sidebar')
@elseif(Auth::guard('bem')->check())
  @include('pengawas.sidebar')
@elseif(Auth::guard('wd1')->check())
  @include('pengawas.sidebar')
@else

@endif
