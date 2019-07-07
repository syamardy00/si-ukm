<?php

namespace App\Http\Controllers;

use App\GaleriFoto;
use Illuminate\Http\Request;
use Image;
use File;
use App\Ukm;
use App\ProfilUser;
use Carbon\Carbon;
use Auth;
use Session;
use App\Http\AuthTraits\OwnsRecord;

class GaleriFotoController extends Controller
{
    use OwnsRecord;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ukm $id)
    {
      if(Auth::guard('adminUkm')->check()){
        $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
      }else if(Auth::guard('anggotaUkm')->check()){
        if(Session::has('ukmDipilih')){
          $id_ukm = Session::get('ukmDipilih');
        }else{
          $id_ukm = $id->id;
        }
        $id_user = Auth::guard('anggotaUkm')->user()->id;
        $profil = ProfilUser::where('id_user', $id_user)->get();

      }else if(Auth::guard('monitoring')->check()){
        $id_ukm = Session::get('monitoringUkmDipilih');
        $user = Auth::guard('monitoring')->user();
      }

        $ukm = Ukm::where('id', $id_ukm)->get();

        $foto = GaleriFoto::where('id_ukm', $id_ukm)->orderBy('id', 'DESC')->get();
        $hitung = GaleriFoto::where('id_ukm', $id_ukm)->count();

      if(Auth::guard('adminUkm')->check()){
        return view('adminUkm.galeriFoto.index', compact('ukm', 'foto', 'hitung'));
      }else if(Auth::guard('anggotaUkm')->check()){
        return view('anggotaUkm.galeriFoto.index', compact('ukm', 'foto', 'hitung', 'profil'));
      }else if(Auth::guard('monitoring')->check()){
        return view('monitoring.galeriFoto.index', compact('ukm', 'foto', 'hitung', 'user'));
      }

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
        $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
        $validator = $this->validate($request, [
          'keterangan' => 'required|min:3|max:250',
          'foto' => 'image|mimes:jpg,png,jpeg'
        ]);

        if($validator){
          //DEFINISIKAN PATH
          $this->path = storage_path('../public/foto/galeri/');
          //MENGAMBIL FILE IMAGE DARI FORM
          $file = $request->file('foto');
          //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
          $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
          //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
          Image::make($file)->save($this->path . $fileName);

          GaleriFoto::create([
             'id_ukm' => $id_ukm,
             'keterangan' => request('keterangan'),
             'foto' => '/foto/galeri/'.$fileName
           ]);

          return redirect()->to('/galeri-foto')->with('berhasil', 'Foto berhasil disimpan.');
        }else{
          return redirect()->to('/galeri-foto')->withErrors($validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GaleriFoto  $galeriFoto
     * @return \Illuminate\Http\Response
     */
    public function show(GaleriFoto $galeriFoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GaleriFoto  $galeriFoto
     * @return \Illuminate\Http\Response
     */
    public function edit(GaleriFoto $galeriFoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GaleriFoto  $galeriFoto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GaleriFoto $galeriFoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GaleriFoto  $galeriFoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(GaleriFoto $id)
    {
      if (!$this->pemilikAdminUkm($id)){
        return redirect()->back();
      }
      $id->delete();
      unlink('../public' .$id->foto);

      return redirect()->to('/galeri-foto')->with('berhasil', 'Foto berhasil dihapus.');
    }
}
