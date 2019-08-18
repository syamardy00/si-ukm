<?php

namespace App\Http\Controllers;

use App\Ukm;
use App\ProfilUser;
use App\AnggotaUkm;
use App\ProkerUkm;
use App\BeritaUkm;
use App\GaleriFoto;
use App\CalonAnggota;
use Auth;
use Illuminate\Http\Request;
use App\User;
use DB;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // admin UKM =========================================================================================================================
    public function index()
    {
      $ukm = Ukm::orderBy('nama_ukm', 'ASC')->get();
      $tahun = Carbon::now()->format('Y');

      if(Auth::guard('monitoring')->check()){
        if(Session::has('monitoringUkmDipilih')){
          Session::forget('monitoringUkmDipilih');
        }
        $user = Auth::guard('monitoring')->user();
        $anggota = AnggotaUkm::groupby('id_user')->distinct()->get();
        $calonAnggota = CalonAnggota::whereYear('tgl_pendaftaran', $tahun)->groupby('nim')->distinct()->get();
          return view('monitoring.ukm.index', compact('ukm', 'user', 'anggota', 'calonAnggota'));

      }else if(Auth::guard('admin')->check()){
        return view('admin.ukm.index', compact('ukm'));
      }else{
        return view('public.home.index', compact('ukm'));
      }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ukm.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $countUser = User::where('username',$request->input('username'))->count();
      $countUkm = Ukm::where('nama_ukm', $request->input('nama_ukm'))->count();

      $validator = $this->validate($request, [
        'nama_ukm' => 'required|string|min:3|max:255|unique:ukm',
        'username' => 'required|string|min:8|max:20|unique:user',
        'password' => 'required|min:8|max:255|confirmed',
        'password_confirmation' => 'required|same:password'
      ]);

      if($validator){
        Ukm::create([
           'nama_ukm' => request('nama_ukm'),
           'visi' => '',
           'misi' => '',
           'profil' => '',
           'email' => '',
           'no_telepon' => '',
           'instagram' => '',
           'website' => ''
         ]);

         $countIdUkm = Ukm::orderBy('id', 'DESC')->get();

         User::create([
           'id_role' => 2,
           'id_ukm' => ($countIdUkm[0]['id']),
           'username' => request('username'),
           'password' => Hash::make(request('password'))
         ]);

        // alert()->success('Berhasil.','Ukm Baru Berhasil Dibuat!');
        return redirect()->to('/ukm/kelola-ukm')->with('berhasil', 'UKM Baru Berhasil Ditambahkan.');

      }else{
        return redirect()->to('/ukm/tambah')->withErrors($validator)->withInput();
      }
    }

    public function destroy(Ukm $ukm)
    {
      User::where('id_ukm', $ukm->id)->delete();
      CalonAnggota::where('id_ukm', $ukm->id)->delete();
      $prokerUkmGet = ProkerUkm::where('id_ukm', $ukm->id)->get();
      if(sizeOf($prokerUkmGet) > 0){
        foreach($prokerUkmGet as $p){
          if($p->proposal != null){
            unlink('../public' .$p->proposal);
          }
          if($p->laporan != null){
            unlink('../public' .$p->laporan);
          }
        }
      ProkerUkm::where('id_ukm', $ukm->id)->delete();
      }

      AnggotaUkm::where('id_ukm', $ukm->id)->delete();
      BeritaUkm::where('id_ukm', $ukm->id)->delete();

      $geleriFotoGet = GaleriFoto::where('id_ukm', $ukm->id)->get();
      if(sizeOf($geleriFotoGet) > 0){
        foreach($geleriFotoGet as $g){
          unlink('../public' .$g->foto);
        }
        GaleriFoto::where('id_ukm', $ukm->id)->delete();
      }

      $ukm->delete();
      return redirect()->to('/ukm/kelola-ukm')->with('berhasil', 'UKM Berhasil Dihapus.');
      // return $ukm->id;
    }


    // anggota UKM =========================================================================================================================
    public function anggotaUkm_index()
    {
      if(Session::has('ukmDipilih')){
        Session::forget('ukmDipilih');
      }
      $id = Auth::guard('anggotaUkm')->user()->id;

      $profil = ProfilUser::where('id_user', $id)->get();
      $anggota = AnggotaUkm::where('id_user', $id)->get();

      $dUkm = UKM::orderBy('nama_ukm', 'ASC');
      foreach($anggota as $a){
        $myUkm[] = Ukm::where('id', $a->id_ukm)->get();
      }

      foreach($myUkm as $m){
        $ukm = $dUkm->where('id', '!=', $m[0]->id)->get();
      }

      // return $myUkm[1][0]->nama_ukm;
      //return $arrayUkm[0]->nama_ukm;
      //return $profil[0]['nama'];
      if($profil[0]->email == ''){
          return redirect(route('anggotaUkm.profilUser.index'));
      }else{
          return view('anggotaUkm.ukm.index', compact('profil', 'ukm', 'myUkm'));
      }

    }


}
