<?php

namespace App\Http\Controllers;

use App\ProfilUser;
use App\Ukm;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Image;
use File;
use App\GaleriFoto;
use App\BeritaUkm;

class ProfilUkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Ukm $ukm) //index admin
    {
      $id_ukm = $ukm->id;
      $ukm = Ukm::where('id', $id_ukm)->get();
      $beritaU = BeritaUkm::where('id_ukm', $id_ukm)->where('sifat_berita', 'umum')->limit(10)->get();
      $foto = GaleriFoto::where('id_ukm', $id_ukm)->orderBy('id', 'DESC')->get();
      // return $dataUkm;
      return view('admin.profilUkm.index', compact('ukm', 'berita', 'beritaU', 'beritaI', 'foto'));
    }

    public function indexAdminUkm(){
      $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
      $ukm = Ukm::where('id', $id_ukm)->get();
      $berita = BeritaUkm::where('id_ukm', $id_ukm)->limit(10)->get();
      $beritaU = BeritaUkm::where('id_ukm', $id_ukm)->where('sifat_berita', 'umum')->limit(10)->get();
      $beritaI = BeritaUkm::where('id_ukm', $id_ukm)->where('sifat_berita', 'internal')->limit(10)->get();
      $foto = GaleriFoto::where('id_ukm', $id_ukm)->orderBy('id', 'DESC')->get();
      // return $dataUkm;
      return view('adminUkm.profilUkm.index', compact('ukm', 'berita', 'beritaU', 'beritaI', 'foto'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProfilUkm  $profilUkm
     * @return \Illuminate\Http\Response
     */
    public function show(Ukm $ukm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProfilUkm  $profilUkm
     * @return \Illuminate\Http\Response
     */
    public function edit(Ukm $ukm)
    {
        // $id = Auth::guard('adminUkm')->user()->id;
        // $profil = ProfilUser::where('id_user', $id)->get();
        // return $dataUkm;
        $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
        $ukm = Ukm::where('id', $id_ukm)->get();
        return view('adminUkm.profilUkm.edit', compact('ukm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProfilUkm  $profilUkm
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProfilUkm  $profilUkm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ukm $ukm)
    {

    }
}
