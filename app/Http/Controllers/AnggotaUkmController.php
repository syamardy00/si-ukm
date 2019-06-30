<?php

namespace App\Http\Controllers;

use App\AnggotaUkm;
use App\Ukm;
use App\ProfilUser;
use App\Jurusan;
use App\User;
use Auth;
use DB;
use Carbon\Carbon;
use Image;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\AuthTraits\OwnsRecord;
use PDF;
use Session;

class AnggotaUkmController extends Controller
{
    use OwnsRecord;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      if(Session::has('ukmDipilih')){
        $id_user = Auth::guard('anggotaUkm')->user()->id;
        $profil = ProfilUser::where('id_user', $id_user)->get();
        return view('anggotaUkm.anggotaUkm.index', compact('profil'));
      }
      $id = Auth::guard('adminUkm')->user()->id;
      $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
      $ukm = Ukm::where('id', $id_ukm)->get();
      $dAnggota = db::table('profil_user')
            ->join('jurusan', 'profil_user.id_jurusan', '=', 'jurusan.id')
            ->join('anggota', 'profil_user.id_user', '=', 'anggota.id_user')
            ->select('profil_user.nim',
            'profil_user.nama',
            'profil_user.tahun_angkatan',
            'profil_user.no_telepon',
            'profil_user.email',
            'jurusan.nama_jurusan',
            'anggota.id',
            'anggota.status')
            ->where('anggota.id_ukm', $id_ukm)->get();
      //return $dAnggota;
      return view('adminUkm.anggotaUkm.index', compact('dAnggota','ukm'));
    }

    public function data_anggota(){
      if(Session::has('ukmDipilih')){
        $id_ukm = Session::get('ukmDipilih');
      }else{
        $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
      }

      $anggota = db::table('profil_user')
            ->join('jurusan', 'profil_user.id_jurusan', '=', 'jurusan.id')
            ->join('anggota', 'profil_user.id_user', '=', 'anggota.id_user')
            ->select('profil_user.nim',
            'profil_user.nama',
            'profil_user.tahun_angkatan',
            'profil_user.no_telepon',
            'profil_user.email',
            'jurusan.nama_jurusan',
            'anggota.id',
            'anggota.status')
            ->where('anggota.id_ukm', $id_ukm)->get();
      return $anggota;
    }

    public function tambah_dari_daftar(){

      $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
      $ukm = Ukm::where('id', $id_ukm)->get();

      $dMahasiswa = db::table('profil_user')
            ->join('jurusan', 'profil_user.id_jurusan', '=', 'jurusan.id')
            ->join('anggota', 'profil_user.id_user', '=', 'anggota.id_user')
            ->select('profil_user.nim',
            'profil_user.nama',
            'profil_user.tahun_angkatan',
            'profil_user.no_telepon',
            'profil_user.email',
            'jurusan.nama_jurusan',
            'anggota.id',
            'anggota.id_user AS anggota_id_user',
            'anggota.status')
            ->where('anggota.id_ukm', '!=', $id_ukm)->get();

      return view('adminUkm.anggotaUkm.create_from_list', compact('ukm', 'dMahasiswa'));
    }

    public function data_mahasiswa(){

      $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
      $anggota_ukm = AnggotaUkm::where('id_ukm', $id_ukm)->get();
      $countAnggota_ukm = AnggotaUkm::where('id_ukm', $id_ukm)->get()->count();

      //return $countAnggota_ukm;
      // return $anggota_ukm[0]['id'];

      if($countAnggota_ukm == 0){
        $mahasiswa = db::table('profil_user')
              ->join('jurusan', 'profil_user.id_jurusan', '=', 'jurusan.id')
              ->join('anggota', 'profil_user.id_user', '=', 'anggota.id_user')
              ->select(
              'profil_user.nim',
              'profil_user.nama',
              'profil_user.tahun_angkatan',
              'profil_user.no_telepon',
              'profil_user.email',
              'jurusan.nama_jurusan',
              'anggota.id',
              'anggota.status')->groupby('anggota.id_user')->distinct()->get();
        return $mahasiswa;
      }else{
        $mahasiswa = db::table('profil_user')
              ->join('jurusan', 'profil_user.id_jurusan', '=', 'jurusan.id')
              ->join('anggota', 'profil_user.id_user', '=', 'anggota.id_user')
              ->select('profil_user.nim',
              'profil_user.nama',
              'profil_user.tahun_angkatan',
              'profil_user.no_telepon',
              'profil_user.email',
              'jurusan.nama_jurusan',
              'anggota.id',
              'anggota.id_user',
              'anggota.status')
              ->where('anggota.id_ukm', '!=', $id_ukm)->groupby('anggota.id_user')->distinct();

        for($m=0; $m<sizeOf($mahasiswa); $m++){
          for($a=0; $a<sizeOf($anggota_ukm); $a++){
            $ArrayMahasiswa = $mahasiswa->where('anggota.id_user', '!=', $anggota_ukm[$a]['id_user'])->get();
          }
        }
        return $ArrayMahasiswa;
      }

        // if($countAnggota_ukm!=0){
        //
        // }else{
        //
        // }
    }

    public function store_from_list(){
        $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
        AnggotaUkm::create([
          'id_user' => request('id_user'),
          'id_ukm'  => $id_ukm,
          'status'  => request('status')
        ]);

        return redirect()->to('/anggota-ukm/tambah-dari-daftar')->with('berhasil', 'Anggota berhasil ditambahkan.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::guard('adminUkm')->user()->id;
        $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
        $ukm = Ukm::where('id', $id_ukm)->get();
        $jurusan = Jurusan::orderBy('nama_jurusan', 'asc')->get();

        return view('adminUkm.anggotaUkm.create', compact('ukm', 'jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = $this->validate($request, [
        'username' => 'required|string|min:8|max:20|unique:user',
        'password' => 'required|min:8|max:255|confirmed',
        'password_confirmation' => 'required|same:password',
        'nim' => 'required|string|min:9|max:10|unique:profil_user,nim',
        'nama' => 'required|min:3|max:50',
        'id_jurusan' => 'required',
        'jenis_kelamin' => 'required',
        'tahun_angkatan' => 'required',
        'email' => 'required|email',
        'no_telepon' => 'required',
        'foto' => 'image|mimes:jpg,png,jpeg'
      ]);

      if($validator){

        if(!empty($request->foto)){
          //DEFINISIKAN PATH
          $this->path = storage_path('../public/foto/user/');
          //MENGAMBIL FILE IMAGE DARI FORM
          $file = $request->file('foto');
          //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
          $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
          //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
          Image::make($file)->save($this->path . $fileName);
        }

        User::create([
           'username' => request('username'),
           'password' => Hash::make(request('password')),
           'id_role' => 3,
           'id_ukm' => 0
         ]);

         $countIdUser = User::orderBy('id', 'DESC')->get();
         $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;

         AnggotaUkm::create([
           'id_user' => ($countIdUser[0]['id']),
           'id_ukm' => $id_ukm,
           'status' => request('status')
         ]);

         if(!empty($request->foto)){
           ProfilUser::create([
             'id_user' => ($countIdUser[0]['id']),
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
         }else{
           ProfilUser::create([
             'id_user' => ($countIdUser[0]['id']),
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
        return redirect()->to('/anggota-ukm')->with('berhasil', 'Data anggota berhasil disimpan.');

      }else{
        return redirect()->to('anggota-ukm/tambah')->withErrors($validator)->withInput();
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AnggotaUkm  $anggotaUkm
     * @return \Illuminate\Http\Response
     */
    public function show(AnggotaUkm $id)
    {
      if(Auth::guard('anggotaUkm')->check()){
        if (!$this->pemilikAnggotaUkm($id)){
          return redirect()->back();
        }else{
          $id_ukm = Session::get('ukmDipilih');
          $id_user = Auth::guard('anggotaUkm')->user()->id;
          $profil = ProfilUser::where('id_user', $id_user)->get();
        }
      }else if(Auth::guard('monitoring')->check()){

      }
        $ukm = Ukm::where('id', $id_ukm)->get();
        $anggota = db::table('profil_user')
              ->join('jurusan', 'profil_user.id_jurusan', '=', 'jurusan.id')
              ->join('anggota', 'profil_user.id_user', '=', 'anggota.id_user')
              ->join('user', 'profil_user.id_user', '=', 'user.id')
              ->select('profil_user.*',
              'jurusan.id AS id_jurusanAsli',
              'jurusan.nama_jurusan',
              'user.id AS id_user',
              'user.username',
              'anggota.id AS id_anggota',
              'anggota.status')
              ->where('anggota.id', $id->id)->get();

        $jurusan = Jurusan::all();
        return view('anggotaUkm.anggotaUkm.show', compact('anggota', 'jurusan','ukm', 'profil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AnggotaUkm  $anggotaUkm
     * @return \Illuminate\Http\Response
     */
    public function edit(AnggotaUkm $id)
    {
      if (!$this->pemilikAdminUkm($id)){
        return redirect()->back();
      }

      $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
      $ukm = Ukm::where('id', $id_ukm)->get();
      $anggota = db::table('profil_user')
            ->join('jurusan', 'profil_user.id_jurusan', '=', 'jurusan.id')
            ->join('anggota', 'profil_user.id_user', '=', 'anggota.id_user')
            ->join('user', 'profil_user.id_user', '=', 'user.id')
            ->select('profil_user.*',
            'jurusan.id AS id_jurusanAsli',
            'jurusan.nama_jurusan',
            'user.id AS id_user',
            'user.username',
            'anggota.id AS id_anggota',
            'anggota.status')
            ->where('anggota.id', $id->id)->get();

      $jurusan = Jurusan::all();
      return view('adminUkm.anggotaUkm.edit', compact('anggota', 'jurusan','ukm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AnggotaUkm  $anggotaUkm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnggotaUkm $anggotaUkm)
    {
      $user = User::where('id', $anggotaUkm->id_user)->get();
      $profilUser = ProfilUser::where('id_user', $anggotaUkm->id_user)->get();

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
          'email' => 'required|email',
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
          'email' => 'required|email',
          'no_telepon' => 'required',
          'foto' => 'image|mimes:jpg,png,jpeg'
        ]);
      }

      if($validator){ //jika validasi berhasil

        if(!empty($request->password)){ //input jika ganti password
          User::where('id', $anggotaUkm->id_user)
          ->update([
            'username' => request('username'),
            'password' => Hash::make(request('passwordBaru'))
          ]);
        }else{ //input jika tidak ganti password
          User::where('id', $anggotaUkm->id_user)
          ->update([
            'username' => request('username')
          ]);
        }

        $anggotaUkm->update([
          'status' => request('status')
        ]);

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

          ProfilUser::where('id_user', $anggotaUkm->id_user)
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

          ProfilUser::where('id_user', $anggotaUkm->id_user)
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
        return redirect()->to('/anggota-ukm')->with('berhasil', 'Perubahan data anggota berhasil disimpan.');

      }//jika validasi gagal
        return redirect()->to('anggota-ukm/edit/' .$anggotaUkm->id)->withErrors($validator)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AnggotaUkm  $anggotaUkm
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnggotaUkm $id)
    {
        //return $id->id_user;

        $count = AnggotaUkm::where('id_user', $id->id_user)->get()->count();
        // return "count = " .$count. " id_user = " .$id->id_user;

        if($count==1){
          $id->delete();
          ProfilUser::where('id_user', $id->id_user)->delete();
          User::where('id', $id->id_user)->delete();
        }else{
          $id->delete();
        }
        // $id->delete();
        return redirect()->to('/anggota-ukm')->with('berhasil', 'Berhasil Menghapus Anggota.');
    }

    public function cetak_pdf(AnggotaUkm $id){
      if(Auth::guard('anggotaUkm')->check()){
        if (!$this->pemilikAnggotaUkm($id)){
          return redirect()->back();
        }else{
          $id_ukm = Session::get('ukmDipilih');
        }
      }else if(Auth::guard('adminUkm')->check()){
        if (!$this->pemilikAdminUkm($id)){
          return redirect()->back();
        }else{
          $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
        }
      }
      $ukm = Ukm::where('id', $id_ukm)->get();
      $anggota = db::table('profil_user')
            ->join('jurusan', 'profil_user.id_jurusan', '=', 'jurusan.id')
            ->join('anggota', 'profil_user.id_user', '=', 'anggota.id_user')
            ->join('user', 'profil_user.id_user', '=', 'user.id')
            ->select('profil_user.*',
            'jurusan.id AS id_jurusanAsli',
            'jurusan.nama_jurusan',
            'user.id AS id_user',
            'user.username',
            'anggota.id AS id_anggota',
            'anggota.status')
            ->where('anggota.id', $id->id)->get();

      $jurusan = Jurusan::all();
      //return view('adminUkm.anggotaUkm.edit', compact('anggota', 'jurusan','ukm'));
      //return view('adminUkm.anggotaUkm.laporan_pdf', compact('anggota','ukm','jurusan'));
    	$pdf = PDF::loadview('adminUkm.anggotaUkm.laporan_pdf', compact('anggota','ukm','jurusan'));
    	return $pdf->download($anggota[0]->nama. '-' .$ukm[0]['nama_ukm']);
    }
}
