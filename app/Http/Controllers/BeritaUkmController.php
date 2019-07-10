<?php

namespace App\Http\Controllers;

use App\BeritaUkm;
use App\Ukm;
use App\ProfilUser;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\AuthTraits\OwnsRecord;
use PDF;
use Session;

class BeritaUkmController extends Controller
{
    use OwnsRecord;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
      $ukm = Ukm::where('id', $id_ukm)->get();

      $dBerita = BeritaUkm::where('id_ukm', $id_ukm)->get();

      return view('adminUkm.beritaUkm.index', compact('ukm', 'dBerita'));
    }

    public function data_berita(){
      $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
      $ukm = Ukm::where('id', $id_ukm)->get();

      $berita = BeritaUkm::where('id_ukm', $id_ukm)->get();

      return $berita;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
      $ukm = Ukm::where('id', $id_ukm)->get();
      return view('adminUkm.beritaUkm.create', compact('ukm'));
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
          'judul_berita' => 'required|string|min:3|max:255',
          'isi_berita' => 'required',
          'sifat_berita' => 'required'
        ]);

        if($validator){
          BeritaUkm::create([
            'judul_berita' => request('judul_berita'),
            'isi_berita' => request('isi_berita'),
            'tanggal_berita' => Carbon::now(),
            'id_ukm' => $id_ukm,
            'sifat_berita' => request('sifat_berita')
          ]);

          return redirect()->to('/berita-ukm')->with('berhasil', 'Berita berhasil disimpan.');
        }else{
            return redirect()->to('/berita-ukm/tambah')->withErrors($validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BeritaUkm  $beritaUkm
     * @return \Illuminate\Http\Response
     */
    public function show(BeritaUkm $id)
    {
      if(Auth::guard('adminUkm')->check()){ // -----------------------------------------------------------jika admin UKM

          if (!$this->pemilikAdminUkm($id)){
            return redirect()->back();
          }
          $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
          $ukm = Ukm::where('id', $id_ukm)->get();

          $berita = BeritaUkm::where('id', $id->id)->get();

          return view('adminUkm.beritaUkm.show', compact('ukm', 'berita'));

      }else if(Auth::guard('anggotaUkm')->check()){ //----------------------------------------------------jika anggota UKM
          if(Session::has('ukmDipilih')){
            $berita = BeritaUkm::where('id', $id->id)->get();
          }else{
            $berita = BeritaUkm::where('id', $id->id)->where('sifat_berita', 'umum')->get();
          }
          $id_user = Auth::guard('anggotaUkm')->user()->id;
          $profil = ProfilUser::where('id_user', $id_user)->get();
          $ukm = UKM::where('id', $berita[0]['id_ukm'])->get();
          if(Session::has('ukmDipilih')){
            return view('anggotaUkm.beritaUkm.show', compact('berita', 'ukm', 'profil'));
          }else{
            return view('anggotaUkm.beritaUkm.show', compact('berita', 'ukm', 'profil'));
          }

      }else if(Auth::guard('admin')->check()){ // --------------------------------------------------------jika admin

          $berita = BeritaUkm::where('id', $id->id)->where('sifat_berita', 'umum')->get();
          $ukm = UKM::where('id', $berita[0]['id_ukm'])->get();
          return view('admin.beritaUkm.show', compact('berita', 'ukm'));

      }else if(Auth::guard('monitoring')->check()){ // --------------------------------------------------------jika Monitoring
          $user = Auth::guard('monitoring')->user();
          $berita = BeritaUkm::where('id', $id->id)->where('sifat_berita', 'umum')->get();
          $ukm = UKM::where('id', $berita[0]['id_ukm'])->get();
          return view('monitoring.beritaUkm.show', compact('berita', 'ukm', 'user'));
      }else{
          $berita = BeritaUkm::where('id', $id->id)->where('sifat_berita', 'umum')->get();
          $ukm = UKM::where('id', $berita[0]['id_ukm'])->get();
          return view('public.home.bacaBeritaUkm', compact('berita', 'ukm'));
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BeritaUkm  $beritaUkm
     * @return \Illuminate\Http\Response
     */
    public function edit(BeritaUkm $id)
    {
      if (!$this->pemilikAdminUkm($id)){
        return redirect()->back();
      }
      $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
      $ukm = Ukm::where('id', $id_ukm)->get();

      $berita = BeritaUkm::where('id', $id->id)->get();

      return view('adminUkm.beritaUkm.edit', compact('ukm', 'berita'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BeritaUkm  $beritaUkm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BeritaUkm $id)
    {
        $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
        $validator = $this->validate($request, [
          'judul_berita' => 'required|string|min:3|max:255',
          'isi_berita' => 'required',
          'sifat_berita' => 'required'
        ]);

        if($validator){
          BeritaUkm::where('id', $id->id)
          ->update([
            'judul_berita' => request('judul_berita'),
            'isi_berita' => request('isi_berita'),
            'tanggal_berita' => Carbon::now(),
            'sifat_berita' => request('sifat_berita')
          ]);

          return redirect()->to('/berita-ukm')->with('berhasil', 'Berita berhasil disimpan.');
        }else{
            return redirect()->to('/berita-ukm/edit/' .$request->id)->withErrors($validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BeritaUkm  $beritaUkm
     * @return \Illuminate\Http\Response
     */
    public function destroy(BeritaUkm $id)
    {
        if (!$this->pemilikAdminUkm($id)){
          return redirect()->back();
        }

        $id->delete();

        return redirect()->to('/berita-ukm')->with('berhasil', 'Berita berhasil dihapus.');

    }

    public function cetak_pdf(BeritaUkm $id){

    $berita = BeritaUkm::where('id', $id->id)->get();

    if(Auth::guard('adminUkm')->check()){
      if (!$this->pemilikAdminUkm($id)){
        return redirect()->back();
      }
    }else{
      if($berita[0]->sifat_berita == 'internal'){
        if(Session::has('ukmDipilih')){

        }else{
          return redirect()->back();
        }
      }
    }
      $id_ukm = $id->id_ukm;
      $ukm = Ukm::where('id', $id_ukm)->get();
      $berita = BeritaUkm::where('id', $id->id)->get();

      //return view('adminUkm.beritaUkm.laporan_pdf', compact('ukm', 'berita'));

      $pdf = PDF::loadview('adminUkm.beritaUkm.laporan_pdf', compact('ukm', 'berita'));
      return $pdf->download($berita[0]['judul_berita']);
    }

    public function semuaBerita(Ukm $id){
      if(Auth::guard('anggotaUkm')->check()){
        if(Session::has('ukmDipilih')){
          $id_ukm = Session::get('ukmDipilih');
        }else{
          $id_ukm = $id->id;
        }
        $id_user = Auth::guard('anggotaUkm')->user()->id;
        $profil = ProfilUser::where('id_user', $id_user)->get();
      }else if(Auth::guard('adminUkm')->check()){
        $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
      }else if(Auth::guard('monitoring')->check()){
        if(Session::has('monitoringUkmDipilih')){
          $id_ukm = Session::get('monitoringUkmDipilih');
        }else{
          $id_ukm = $id->id;
        }
        $user = Auth::guard('monitoring')->user();
      }else{
        $id_ukm = $id->id;
      }


      $ukm = Ukm::where('id', $id_ukm)->get();
      $berita = BeritaUkm::where('id_ukm', $id_ukm)->paginate(5);
      $beritaU = BeritaUkm::where('id_ukm', $id_ukm)->where('sifat_berita', 'umum')->paginate(5);
      $beritaI = BeritaUkm::where('id_ukm', $id_ukm)->where('sifat_berita', 'internal')->paginate(5);


      if(Auth::guard('anggotaUkm')->check()){
        if(Session::has('ukmDipilih')){
          return view('anggotaUkm.beritaUkm.anggotaIndex', compact('ukm', 'berita', 'beritaU','beritaI', 'profil'));
        }else{
          return view('anggotaUkm.beritaUkm.index', compact('ukm', 'berita', 'beritaU', 'profil'));
        }
      }else if(Auth::guard('adminUkm')->check()){
        return view('adminUkm.beritaUkm.semuaBerita', compact('ukm', 'berita', 'beritaU', 'beritaI'));
      }else if(Auth::guard('monitoring')->check()){
        return view('monitoring.beritaUkm.index', compact('ukm', 'berita', 'beritaU', 'profil', 'user'));
      }else{
        return view('public.home.beritaUkm', compact('ukm', 'berita', 'beritaU'));
      }
    }

}
