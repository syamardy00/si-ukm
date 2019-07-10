<?php

namespace App\Http\Controllers;

use App\ProfilUser;
use App\AnggotaUkm;
use App\CalonAnggota;
use App\ProkerUkm;
use App\Ukm;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Image;
use Session;
use File;
use App\GaleriFoto;
use App\BeritaUkm;
use DB;

class ProfilUkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // ADMIN ==========================================================================================================================
    public function index(Ukm $ukm) //index admin
    {
      $id_ukm = $ukm->id;
      $ukm = Ukm::where('id', $id_ukm)->get();
      $beritaU = BeritaUkm::where('id_ukm', $id_ukm)->where('sifat_berita', 'umum')->limit(10)->get();
      $foto = GaleriFoto::where('id_ukm', $id_ukm)->orderBy('id', 'DESC')->get();
      // return $dataUkm;
      return view('admin.profilUkm.index', compact('ukm', 'berita', 'beritaU', 'foto'));
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


    // ADMIN UKM ===========================================================================================================================================
    public function indexAdminUkm(Request $request){ //adminUKM dan anggotaUKMa(DASHBOARD) dan Monitoring berdasarkan request
      // dd($request);
      if(Auth::guard('anggotaUkm')->check()){
        if($request->id_ukm){
          if(Session::has('ukmDipilih')){
            Session::forget('ukmDipilih');
          }
          $id_ukm = request('id_ukm');
          $request->session()->put('ukmDipilih', $id_ukm);
        }
        $id_ukm = Session::get('ukmDipilih');
        $id = Auth::guard('anggotaUkm')->user()->id;
        $profil = ProfilUser::where('id_user', $id)->get();

      }else if(Auth::guard('adminUkm')->check()){
        $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;

      }else if(Auth::guard('monitoring')->check()){
        if($request->id_ukm){
          if(Session::has('monitoringUkmDipilih')){
            Session::forget('monitoringUkmDipilih');
          }
          $id_ukm = request('id_ukm');
          Session::put('monitoringUkmDipilih', $id_ukm);
        }
        $id_ukm = Session::get('monitoringUkmDipilih');
        $user = Auth::guard('monitoring')->user();
      }

      $jAnggota = AnggotaUkm::where('id_ukm', $id_ukm)->where('status', '=', 'Aktif')->count();
      $jProker = ProkerUkm::where('id_ukm', $id_ukm)->where('pelaksanaan', 'Belum Terlaksana')->count();
      $tahun = Carbon::now()->format('Y');
      //$jCalonAnggota = DB::table('penerimaan')->where('id_ukm', $id_ukm)->where(YEAR('tgl_pendaftaran'), '=', $tahun)->count();
      $jCalonAnggota = CalonAnggota::where('id_ukm', $id_ukm)->whereYear('tgl_pendaftaran', $tahun)->count();

      $ukm = Ukm::where('id', $id_ukm)->get();
      $berita = BeritaUkm::where('id_ukm', $id_ukm)->limit(10)->get();
      $beritaU = BeritaUkm::where('id_ukm', $id_ukm)->where('sifat_berita', 'umum')->limit(10)->get();
      $beritaI = BeritaUkm::where('id_ukm', $id_ukm)->where('sifat_berita', 'internal')->limit(10)->get();
      $foto = GaleriFoto::where('id_ukm', $id_ukm)->orderBy('id', 'DESC')->get();
      // return $dataUkm;
      if(Auth::guard('adminUkm')->check()){
        return view('adminUkm.profilUkm.index', compact('ukm', 'berita', 'beritaU', 'beritaI', 'foto', 'jAnggota', 'jProker', 'jCalonAnggota'));
      }else if(Auth::guard('anggotaUkm')->check()){
        return view('anggotaUkm.ukm.dashboard', compact('ukm', 'berita', 'beritaU', 'beritaI', 'foto', 'profil', 'jAnggota', 'jProker', 'jCalonAnggota'));
      }else if(Auth::guard('monitoring')->check()){
        return view('monitoring.profilUkm.index', compact('ukm', 'berita', 'beritaU', 'foto', 'user', 'jAnggota', 'jProker', 'jCalonAnggota'));
      }
    }


    public function edit(Ukm $ukm)
    {
        // $id = Auth::guard('adminUkm')->user()->id;
        // $profil = ProfilUser::where('id_user', $id)->get();
        // return $dataUkm;
        $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
        $ukm = Ukm::where('id', $id_ukm)->get();
        return view('adminUkm.profilUkm.edit', compact('ukm'));
    }


    public function update(Request $request)
    {
        $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
        $data_ukm = Ukm::where('id', $id_ukm)->get();
        //return $data_ukm[0]['nama_ukm'];

        $validator = $this->validate($request, [
          'nama_ukm' => 'required|string|max:255|unique:ukm,nama_ukm,'  .$data_ukm[0]['id']. ',id',
          'profil' => 'required',
          'visi' => 'required',
          'misi' => 'required',
          'email' => 'email',
          'logo_ukm' => 'image|mimes:jpg,png,jpeg',
          'struktur' => 'image|mimes:jpg,png,jpeg'
        ]);

        if(!empty($request->logo_ukm)){
          //DEFINISIKAN PATH
          $this->pathLogo = storage_path('../public/foto/ukm/');
          //MENGAMBIL FILE IMAGE DARI FORM
          $fileLogo = $request->file('logo_ukm');
          //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
          $fileNameLogo = Carbon::now()->timestamp . '_' . uniqid() . '.' . $fileLogo->getClientOriginalExtension();
          //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
          Image::make($fileLogo)->save($this->pathLogo . $fileNameLogo);
          //hapus file sebelumnya
          if($data_ukm[0]['logo_ukm']){
              unlink('../public' .$data_ukm[0]['logo_ukm']);
          }
        }

        if(!empty($request->struktur)){
          //DEFINISIKAN PATH
          $this->pathStruktur = storage_path('../public/foto/struktur/');
          //MENGAMBIL FILE IMAGE DARI FORM
          $fileStruktur = $request->file('struktur');
          //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
          $fileNameStruktur = Carbon::now()->timestamp . '_' . uniqid() . '.' . $fileStruktur->getClientOriginalExtension();
          //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
          Image::make($fileStruktur)->save($this->pathStruktur . $fileNameStruktur);
          //hapus file sebelumnya
          if($data_ukm[0]['struktur']){
            unlink('../public' .$data_ukm[0]['struktur']);
          }
        }

        if($validator){ //jika validasi berhasil

          if(!empty($request->logo_ukm) && !empty($request->struktur)){ //jika logo dan struktur diubah

            Ukm::where('id', $id_ukm)
            ->update([
              'nama_ukm' => request('nama_ukm'),
              'logo_ukm' => '/foto/ukm/'.$fileNameLogo,
              'visi' => request('visi'),
              'misi' => request('misi'),
              'profil' => request('profil'),
              'struktur' => '/foto/struktur/'.$fileNameStruktur,
              'email' => request('email'),
              'no_telepon' => request('no_telepon'),
              'instagram' => request('instagram'),
              'website' => request('website')
            ]);

          }else if(!empty($request->logo_ukm) && empty($request->struktur)){ //jika logo diubah dan struktur tidak

            Ukm::where('id', $id_ukm)
            ->update([
              'nama_ukm' => request('nama_ukm'),
              'logo_ukm' => '/foto/ukm/'.$fileNameLogo,
              'visi' => request('visi'),
              'misi' => request('misi'),
              'profil' => request('profil'),
              'email' => request('email'),
              'no_telepon' => request('no_telepon'),
              'instagram' => request('instagram'),
              'website' => request('website')
            ]);

          }else if(empty($request->logo_ukm) && !empty($request->struktur)){ //jika logo tidak dan struktur diubah

            Ukm::where('id', $id_ukm)
            ->update([
              'nama_ukm' => request('nama_ukm'),
              'visi' => request('visi'),
              'misi' => request('misi'),
              'profil' => request('profil'),
              'struktur' => '/foto/struktur/'.$fileNameStruktur,
              'email' => request('email'),
              'no_telepon' => request('no_telepon'),
              'instagram' => request('instagram'),
              'website' => request('website')
            ]);

          }else if(empty($request->logo_ukm) && empty($request->struktur)){ //jika logo dan struktur tidak diubah

            Ukm::where('id', $id_ukm)
            ->update([
              'nama_ukm' => request('nama_ukm'),
              'visi' => request('visi'),
              'misi' => request('misi'),
              'profil' => request('profil'),
              'email' => request('email'),
              'no_telepon' => request('no_telepon'),
              'instagram' => request('instagram'),
              'website' => request('website')
            ]);

          }
        return redirect()->to('/profil-ukm')->with('berhasil', 'Profil UKM berhasil disimpan.');

        }else{ //jika validasi gagal
          return redirect()->to('/profil-ukm/edit')->withErrors($validator)->withInput();
        }
    }


    // ANGGOTA UKM ===========================================================================================================================================

    public function profilUkm($id){  //anggotaUkm dan guest GET dari link
      if(Auth::guard('anggotaUkm')->check()){
        if(Session::has('ukmDipilih')){
          Session::forget('ukmDipilih');
        }
        $id_user = Auth::guard('anggotaUkm')->user()->id;
        $profil = ProfilUser::where('id_user', $id_user)->get();
      }

      $ukm = Ukm::where('id', $id)->get();
      $berita = BeritaUkm::where('id_ukm', $id)->limit(10)->get();
      $beritaU = BeritaUkm::where('id_ukm', $id)->where('sifat_berita', 'umum')->limit(10)->get();
      $foto = GaleriFoto::where('id_ukm', $id)->orderBy('id', 'DESC')->get();
      // return $dataUkm;

      if(Auth::guard('anggotaUkm')->check()){
        return view('anggotaUkm.ukm.profilUkm', compact('ukm', 'berita', 'beritaU', 'foto', 'profil'));
      }else{
        return view('public.home.profilUkm', compact('ukm', 'berita', 'beritaU', 'foto'));
      }

    }
}
