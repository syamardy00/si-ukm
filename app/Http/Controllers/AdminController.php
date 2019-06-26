<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\ProfilUser;
use App\Ukm;

class AdminController extends Controller
{
  public function index()
  {
    if(Auth::guard('adminUkm')->check()){
      $id = Auth::guard('adminUkm')->user()->id;
    }else if(Auth::guard('anggotaUkm')->check()){
      $id = Auth::guard('anggotaUkm')->user()->id;
    }else if(Auth::guard('admin')->check()){
      $id = Auth::guard('admin')->user()->id;
    }else if(Auth::guard('bem')->check()){
      $id = Auth::guard('bem')->user()->id;
    }else if(Auth::guard('wd1')->check()){
      $id = Auth::guard('wd1')->user()->id;
    }

    $profil = ProfilUser::where('id_user', $id)->get();
    $ukm = Ukm::All();

    return view('admin.ukm.index', compact('profil', 'ukm'));
  }
}
