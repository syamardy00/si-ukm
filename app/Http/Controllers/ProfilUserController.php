<?php

namespace App\Http\Controllers;

use App\ProfilUser;
use Illuminate\Http\Request;
use App\Ukm;
use App\Jurusan;
use Auth;
use App\User;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use DB;
use Image;
use File;

class ProfilUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Session::has('ukmDipilih')){
        $id_ukm = Session::get('ukmDipilih');
        $ukm = Ukm::where('id', $id_ukm)->get();
      }
      $id_user = Auth::guard('anggotaUkm')->user()->id;
      $profil = ProfilUser::where('id_user', $id_user)->get();
      $dataProfil = db::table('user')
            ->join('profil_user', 'user.id', '=', 'profil_user.id_user')
            ->join('jurusan', 'profil_user.id_jurusan', '=', 'jurusan.id')
            ->select('profil_user.*',
            'jurusan.nama_jurusan',
            'user.id AS id_user',
            'user.username')
            ->where('user.id', $id_user)->get();

      $jurusan = Jurusan::all();
      return view('anggotaUkm.profilUser.index', compact('dataProfil', 'profil', 'jurusan', 'ukm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProfilUser  $profilUser
     * @return \Illuminate\Http\Response
     */
    public function show(ProfilUser $profilUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProfilUser  $profilUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfilUser $profilUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProfilUser  $profilUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $id_user = Auth::guard('anggotaUkm')->user()->id;
      $user = User::where('id', $id_user)->get();
      $profilUser = ProfilUser::where('id_user', $id_user)->get();

      if(!empty($request->passwordBaru)){ //validasi jika mengganti password
        $validator = $this->validate($request, [
          'username' => 'required|string|min:8|max:20|unique:user,username,'  .$user[0]['id']. ',id',
          'passwordBaru' => 'required|min:8|max:255|confirmed',
          'passwordBaru_confirmation' => 'required|same:passwordBaru',
          'nim' => 'required|string|min:9|max:10|unique:profil_user,nim,'  .$profilUser[0]['id']. ',id',
          'nama' => 'required|min:3|max:50',
          'id_jurusan' => 'required',
          'jenis_kelamin' => 'required',
          'tahun_angkatan' => 'required',
          'email' => 'required|email|unique:profil_user,email,'  .$profilUser[0]['id']. ',id',
          'no_telepon' => 'required',
          'foto' => 'image|mimes:jpg,png,jpeg'
        ]);
      }else{ //validasi jika tidak mengganti password
        $validator = $this->validate($request, [
          'username' => 'required|string|min:8|max:20|unique:user,username,'  .$user[0]['id']. ',id',
          'nim' => 'required|string|min:9|max:10|unique:profil_user,nim,'  .$profilUser[0]['id']. ',id',
          'nama' => 'required|min:3|max:50',
          'id_jurusan' => 'required',
          'jenis_kelamin' => 'required',
          'tahun_angkatan' => 'required',
          'email' => 'required|email|unique:profil_user,email,'  .$profilUser[0]['id']. ',id',
          'no_telepon' => 'required',
          'foto' => 'image|mimes:jpg,png,jpeg'
        ]);
      }

      if($validator){ //jika validasi berhasil

        if(!empty($request->passwordBaru)){ //input jika ganti password
          User::where('id', $id_user)
          ->update([
            'username' => request('username'),
            'password' => Hash::make(request('passwordBaru'))
          ]);
        }else{ //input jika tidak ganti password
          User::where('id', $id_user)
          ->update([
            'username' => request('username')
          ]);
        }

        if(!empty($request->foto)){ //jika mengganti foto
          //DEFINISIKAN PATH
          $this->path = storage_path('../public/foto/user/');
          //MENGAMBIL FILE IMAGE DARI FORM
          $file = $request->file('foto');
          //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
          $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
          //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
          Image::make($file)->save($this->path . $fileName);
          //hapus file sebelumnya
          if($profilUser[0]['foto']){
              unlink('../public' .$profilUser[0]['foto']);
          }

          ProfilUser::where('id_user', $id_user)
          ->update([
            'nim' => request('nim'),
            'nama' => request('nama'),
            'id_jurusan' => request('id_jurusan'),
            'jenis_kelamin' => request('jenis_kelamin'),
            'tgl_lahir' => request('tgl_lahir'),
            'tahun_angkatan' => request('tahun_angkatan'),
            'email' => request('email'),
            'no_telepon' => request('no_telepon'),
            'foto' => '/foto/user/'.$fileName
          ]);

        }else{ //jika tidak mengganti foto

          ProfilUser::where('id_user', $id_user)
          ->update([
            'nim' => request('nim'),
            'nama' => request('nama'),
            'id_jurusan' => request('id_jurusan'),
            'jenis_kelamin' => request('jenis_kelamin'),
            'tgl_lahir' => request('tgl_lahir'),
            'tahun_angkatan' => request('tahun_angkatan'),
            'email' => request('email'),
            'no_telepon' => request('no_telepon')
          ]);

        }
        return redirect()->to('/profil-saya')->with('berhasil', 'Perubahan berhasil disimpan.');

      }//jika validasi gagal
        return redirect()->to('/profil-saya')->withErrors($validator)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProfilUser  $profilUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfilUser $profilUser)
    {
        //
    }
}
