<?php

namespace App\Http\Controllers;

use App\ProfilUser;
use App\Login;
use App\UserLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Session;
//
// use Illuminate\Database\Eloquent\Collection;
// use Illuminate\Contracts\Auth\Authenticatable;
// use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class LoginController extends Controller //implements Authenticatable
{

    function index(){
      return view('login');
    }
      // use AuthenticableTrait;

    function login(Request $req){

      $data_user = Login::where('username', $req->username)->get();

      if(Hash::check($req->password, $data_user[0]['password'])){
        //jika berhasil login
        // s
        $role = $data_user[0]['id_role'];
        $id = $data_user[0]['id'];
        //ambil detail profil user
        // $profil = ProfilUser::where('id_user', $id_user)->get();
        if($role == 1){ //jika role nya admin
            Auth::guard('admin')->LoginUsingId($id);
            // return redirect('/ukm/kelola-ukm');
            return redirect(route('admin'));

        }else if($role == 2){ //jika role nya adminUkm
          Auth::guard('adminUkm')->LoginUsingId($id);
          return redirect('/profil-ukm');

        }else if($role == 3){ //jike role nya AnggotaUkm
          Auth::guard('anggotaUkm')->LoginUsingId($id);
          return redirect(route('anggotaUkm.ukm.index'));

        }else if($role == 4){ //jike role nya bem
          Auth::guard('bem')->LoginUsingId($id);
          return redirect('/');
        }
        else if($role == 5){ //jike role wd1
          Auth::guard('wd1')->LoginUsingId($id);
          return redirect('/');
        }

      }else{ //jika gagal login
        return "Login Gagal";
      }
    }

    function logout(){

      if(Auth::guard('adminUkm')->check()){
        Auth::guard('adminUkm')->logout();
      }else if(Auth::guard('anggotaUkm')->check()){
        Auth::guard('anggotaUkm')->logout();
      }else if(Auth::guard('admin')->check()){
        Auth::guard('admin')->logout();
      }else if(Auth::guard('bem')->check()){
        Auth::guard('bem')->logout();
      }else if(Auth::guard('wd1')->check()){
        Auth::guard('wd1')->logout();
      }
      
      if(Session::has('ukmDipilih')){
        Session::forget('ukmDipilih');
      }
      return redirect('/login');

    }
}
