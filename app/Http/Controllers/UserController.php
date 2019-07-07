<?php

namespace App\Http\Controllers;

use App\User;
use App\Ukm;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dUser = db::table('user')->join('ukm', 'user.id_ukm', '=', 'ukm.id')
              ->select('user.id', 'user.username', 'ukm.nama_ukm')
              ->where('user.id_role', 2)->get();
        return view('admin.user.index', compact('dUser'));
    }

    public function indexMonitoring()
    {
        $dUser = User::where('user.id_role', 4)->get();
        return view('admin.userMonitoring.index', compact('dUser'));
    }

    public function data_user()
    {
      // $user = User::all();
      $user = db::table('user')->join('ukm', 'user.id_ukm', '=', 'ukm.id')
              ->select('user.id', 'user.username', 'ukm.nama_ukm')
              ->where('user.id_role', 2)->get();
      return $user;

    }

    public function data_user_monitoring()
    {
      // $user = User::all();
      $user = User::where('user.id_role', 4)->get();
      return $user;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createMonitoring()
    {
        return view('admin.userMonitoring.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMonitoring(Request $request)
    {
      $countUser = User::where('username',$request->input('username'))->count();

      $validator = $this->validate($request, [
        'username' => 'required|string|min:8|max:20|unique:user',
        'password' => 'required|min:8|max:255|confirmed',
        'password_confirmation' => 'required|same:password'
      ]);

      if($validator){
         User::create([
           'id_role' => 4,
           'id_ukm' => 0,
           'username' => request('username'),
           'password' => Hash::make(request('password'))
         ]);

        // alert()->success('Berhasil.','Ukm Baru Berhasil Dibuat!');
        return redirect()->to('/kelola-akun-monitoring')->with('berhasil', 'Akun Monitoring Berhasil Ditambahkan.');

      }else{
        return redirect()->to('/kelola-akun-monitoring/tambah')->withErrors($validator)->withInput();
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $dUser = db::table('user')->join('ukm', 'user.id_ukm', '=', 'ukm.id')
                ->select('user.id', 'user.username', 'user.password', 'ukm.nama_ukm')
                ->where('user.id', $user->id)->get();
        // return $dUser;
        return view('admin.user.edit', compact('dUser'));
    }

    public function editMonitoring(User $id)
    {
        $dUser = User::where('id', $id->id)->get();
        // return $dUser;
        return view('admin.userMonitoring.edit', compact('dUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
      if(!empty($request->passwordBaru)){ //jika merubah password
        $validator = $this->validate($request, [
          'username' => 'required|string|min:8|max:20|unique:user,username,'  .$user->id.  '',
          'passwordBaru' => 'required|string|min:8|max:255|confirmed',
          'passwordBaru_confirmation' => 'required|same:passwordBaru'
        ]);

        if($validator){ //jika validasi berhasil
          $user->update([
            'username' => request('username'),
            'password' => Hash::make(request('passwordBaru'))
          ]);

          return redirect()->to('/kelola-akun')->with('berhasil', 'Perubahan berhasil disimpan.');

        }else{ //jika validasi gagal
          return redirect()->to('/kelola-akun/edit/$user->id')->withErrors($validator)->withInput();
        }

      }else{ //jika tidak merubah password
        $validator = $this->validate($request, [
          'username' => 'required|string|min:8|max:20|unique:user,username,'  .$user->id.  ''
        ]);

        if($validator){ //jika validasi berhasil
          $user->update([
            'username' => request('username')
          ]);

          return redirect()->to('/kelola-akun')->with('berhasil', 'Perubahan berhasil disimpan.');

        }else{ //jika validasi gagal
          return redirect()->to('/kelola-akun/edit/$user->id')->withErrors($validator)->withInput();
        }

      }
    }

    public function updateMonitoring(Request $request, User $id)
    {
      if(!empty($request->passwordBaru)){ //jika merubah password
        $validator = $this->validate($request, [
          'username' => 'required|string|min:8|max:20|unique:user,username,'  .$id->id.  '',
          'passwordBaru' => 'required|string|min:8|max:255|confirmed',
          'passwordBaru_confirmation' => 'required|same:passwordBaru'
        ]);

        if($validator){ //jika validasi berhasil
          $id->update([
            'username' => request('username'),
            'password' => Hash::make(request('passwordBaru'))
          ]);

          return redirect()->to('/kelola-akun-monitoring')->with('berhasil', 'Perubahan berhasil disimpan.');

        }else{ //jika validasi gagal
          return redirect()->to('/kelola-akun-monitoring/edit/$id->id')->withErrors($validator)->withInput();
        }

      }else{ //jika tidak merubah password
        $validator = $this->validate($request, [
          'username' => 'required|string|min:8|max:20|unique:user,username,'  .$id->id.  ''
        ]);

        if($validator){ //jika validasi berhasil
          $id->update([
            'username' => request('username')
          ]);

          return redirect()->to('/kelola-akun-monitoring')->with('berhasil', 'Perubahan berhasil disimpan.');

        }else{ //jika validasi gagal
          return redirect()->to('/kelola-akun-monitoring/edit/$user->id')->withErrors($validator)->withInput();
        }

      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
      $ukm = Ukm::where('id', $user->id_ukm)->delete();
      $user->delete();
      return redirect()->to('/kelola-akun')->with('berhasil', 'Akun beserta UKM berhasil Dihapus.');
    }

    public function destroyMonitoring(User $id)
    {
      $id->delete();
      return redirect()->to('/kelola-akun-monitoring')->with('berhasil', 'Akun beserta UKM berhasil Dihapus.');
    }

    public function editAkunAdminUkm(){
        $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
        $id_user = Auth::guard('adminUkm')->user()->id;


        $ukm = Ukm::where('id', $id_ukm)->get();
        $user = User::where('id', $id_user)->get();

        return view('adminUkm.user.edit', compact('ukm', 'user'));
    }

    public function editAkunAdmin(){
        $id_user = Auth::guard('admin')->user()->id;
        $user = User::where('id', $id_user)->get();

        return view('admin.user.editAkunAdmin', compact('user'));
    }

    public function editAkunMonitoring(){
      if(Session::has('monitoringUkmDipilih')){
        $id_ukm = Session::get('monitoringUkmDipilih');
        $ukm = Ukm::where('id', $id_ukm)->get();
      }
        $user = Auth::guard('monitoring')->user();
        return view('monitoring.user.edit', compact('user', 'ukm'));
    }

    public function updateAkun(Request $request)
    {
      if(Auth::guard('adminUkm')->check()){
        $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
        $id_user = Auth::guard('adminUkm')->user()->id;
      }else if(Auth::guard('admin')->check()){
        $id_user = Auth::guard('admin')->user()->id;
      }else if(Auth::guard('anggotaUkm')->check()){
        $id_user = Auth::guard('anggotaUkm')->user()->id;
      }else if(Auth::guard('monitoring')->check()){
        $id_user = Auth::guard('monitoring')->user()->id;
      }

      if(!empty($request->passwordBaru)){ //jika merubah password
        $validator = $this->validate($request, [
          'username' => 'required|string|min:8|max:20|unique:user,username,'  .$id_user.  '',
          'passwordBaru' => 'required|string|min:8|max:255|confirmed',
          'passwordBaru_confirmation' => 'required|same:passwordBaru'
        ]);

        if($validator){ //jika validasi berhasil
          User::where('id', $id_user)
          ->update([
            'username' => request('username'),
            'password' => Hash::make(request('passwordBaru'))
          ]);

          return redirect()->back()->with('berhasil', 'Perubahan berhasil disimpan.');

        }else{ //jika validasi gagal
          return redirect()->back()->withErrors($validator)->withInput();
        }

      }else{ //jika tidak merubah password
        $validator = $this->validate($request, [
          'username' => 'required|string|min:8|max:20|unique:user,username,'  .$id_user.  ''
        ]);

        if($validator){ //jika validasi berhasil
          User::where('id', $id_user)
          ->update([
            'username' => request('username')
          ]);

          return redirect()->back()->with('berhasil', 'Perubahan berhasil disimpan.');

        }else{ //jika validasi gagal
          return redirect()->back()->withErrors($validator)->withInput();
        }

      }
    }
}
