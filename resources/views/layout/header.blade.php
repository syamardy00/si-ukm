@if(Auth::guard('adminUkm')->check())
  @include('adminUkm.header')
@elseif(Auth::guard('admin')->check())
  @include('admin.header')
@elseif(Auth::guard('anggotaUkm')->check())
  @include('anggotaUkm.header')
@elseif(Auth::guard('bem')->check())
  @include('pengawas.header')
@elseif(Auth::guard('wd1')->check())
  @include('pengawas.header')
@else

@endif
