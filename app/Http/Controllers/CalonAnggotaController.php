<?php

namespace App\Http\Controllers;

use Auth;
use PDF;
use App\Ukm;
use App\Jurusan;
use App\ProfilUser;
use Carbon\Carbon;
use DB;
use App\CalonAnggota;
use Illuminate\Http\Request;
use App\Http\AuthTraits\OwnsRecord;
use Session;

class CalonAnggotaController extends Controller
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
          $id_ukm = Session::get('ukmDipilih');
          $ukm = Ukm::where('id', $id_ukm)->get();
          return view('anggotaUkm.calonAnggota.index', compact('profil', 'ukm'));
        }

        if(Session::has('monitoringUkmDipilih')){
          $user = Auth::guard('monitoring')->user();
          $id_ukm = Session::get('monitoringUkmDipilih');
          $ukm = Ukm::where('id', $id_ukm)->get();
          return view('monitoring.calonAnggota.index', compact('user', 'ukm'));
        }

        $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
        $ukm = Ukm::where('id', $id_ukm)->get();
        // $calonAnggota = CalonAnggota::where('id_ukm', $id_ukm)->get();
        $dCalonAnggota = DB::table('penerimaan')
        ->join('jurusan', 'penerimaan.id_jurusan', '=', 'jurusan.id')
        ->select(
          'penerimaan.*',
          'jurusan.nama_jurusan'
          )
        ->where('id_ukm', $id_ukm)->get();

        //return $calonAnggota;
        return view('adminUkm.calonAnggota.index', compact('ukm', 'dCalonAnggota'));
    }

    public function data_calonAnggota()
    {
        if(Session::has('monitoringUkmDipilih')){
          $id_ukm = Session::get('monitoringUkmDipilih');
        }else if(Session::has('ukmDipilih')){
          $id_ukm = Session::get('ukmDipilih');
        }else{
          $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
        }

        $ukm = Ukm::where('id', $id_ukm)->get();
        // $calonAnggota = CalonAnggota::where('id_ukm', $id_ukm)->get();
        $calonAnggota = DB::table('penerimaan')
        ->join('jurusan', 'penerimaan.id_jurusan', '=', 'jurusan.id')
        ->select(
          'penerimaan.*',
          'jurusan.nama_jurusan'
          )
        ->where('id_ukm', $id_ukm)->orderBy('tgl_pendaftaran', 'DESC')
        ->get();

        //return $calonAnggota;
        return $calonAnggota;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $ukm = Ukm::where('id', $id)->get();
        $jurusan = Jurusan::orderBy('nama_jurusan', 'ASC')->get();

        if($ukm[0]->pendaftaran == 1){
          return view('public.home.pendaftaran', compact('ukm', 'jurusan'));
        }else{
          return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request);
      $validator = $this->validate($request, [
        'nim' => 'required|string|min:9|max:10',
        'nama' => 'required|min:3|max:50',
        'id_jurusan' => 'required',
        'jenis_kelamin' => 'required',
        'tahun_angkatan' => 'required',
        'email' => 'required|email',
        'no_telepon' => 'required'
      ]);

      if($validator){
        $tanggal = Carbon::now();
        $tahun = Carbon::now()->format('Y');
        $hitung = CalonAnggota::where('nim', $request->nim)->where('id_ukm', $request->id_ukm)->whereYear('tgl_pendaftaran', $tahun)->count();

        if($hitung == 0){
          CalonAnggota::create([
            'nim' => request('nim'),
            'nama' => request('nama'),
            'id_jurusan' => request('id_jurusan'),
            'jenis_kelamin' => request('jenis_kelamin'),
            'tgl_lahir' => request('tgl_lahir'),
            'tahun_angkatan' => request('tahun_angkatan'),
            'email' => request('email'),
            'no_telepon' => request('no_telepon'),
            'id_ukm' => request('id_ukm'),
            'tgl_pendaftaran' => $tanggal
          ]);
        }else{
          return redirect()->back()->with('gagal', 'Data dengan NIM yang anda masukan telah terdaftar sebagai calon anggota tahun ' .$tahun. ' pada UKM ini.');
        }
        return redirect()->to('/home/profil-ukm/' .$request->id_ukm)->with('berhasil', 'Anda Berhasil Terdaftar.');
      }else{
        return redirect()->back()->withErrors($validator)->withInput();
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CalonAnggota  $calonAnggota
     * @return \Illuminate\Http\Response
     */
    public function show(CalonAnggota $id)
    {
      if(Auth::guard('adminUkm')->check()){
        if (!$this->pemilikAdminUkm($id)){
          return redirect()->back();
        }
        $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
      }else if(Auth::guard('anggotaUkm')->check()){
        if (!$this->pemilikAnggotaUkm($id)){
          return redirect()->back();
        }
        $id_ukm = Session::get('ukmDipilih');
        $id_user = Auth::guard('anggotaUkm')->user()->id;
        $profil = ProfilUser::where('id_user', $id_user)->get();
      }else if(Auth::guard('monitoring')->check()){
        $id_ukm = Session::get('monitoringUkmDipilih');
        $user = Auth::guard('monitoring')->user();
      }

        $ukm = Ukm::where('id', $id_ukm)->get();
        // $calonAnggota = CalonAnggota::where('id_ukm', $id_ukm)->get();
        $calonAnggota = DB::table('penerimaan')
        ->join('jurusan', 'penerimaan.id_jurusan', '=', 'jurusan.id')
        ->select(
          'penerimaan.*',
          'jurusan.nama_jurusan'
          )
        ->where('penerimaan.id', $id->id)
        ->get();

        if(Auth::guard('adminUkm')->check()){
          return view('adminUkm.calonAnggota.show', compact('ukm', 'calonAnggota'));
        }else if(Auth::guard('anggotaUkm')->check()){
          return view('anggotaUkm.calonAnggota.show', compact('ukm', 'calonAnggota', 'profil'));
        }else if(Auth::guard('monitoring')->check()){
          return view('monitoring.calonAnggota.show', compact('ukm', 'calonAnggota', 'user'));
        }

      }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CalonAnggota  $calonAnggota
     * @return \Illuminate\Http\Response
     */
    public function edit(CalonAnggota $calonAnggota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CalonAnggota  $calonAnggota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalonAnggota $calonAnggota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CalonAnggota  $calonAnggota
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalonAnggota $id)
    {
        $id->delete();
        return redirect()->to('/calon-anggota')->with('berhasil', 'Berhasil Menghapus Anggota.');
    }

    public function cetak_pdf(CalonAnggota $id){
      if(Auth::guard('monitoring')->check()){
          $id_ukm = Session::get('monitoringUkmDipilih');
      }else if(Auth::guard('anggotaUkm')->check()){
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
      $calonAnggota = DB::table('penerimaan')
      ->join('jurusan', 'penerimaan.id_jurusan', '=', 'jurusan.id')
      ->select(
        'penerimaan.*',
        'jurusan.nama_jurusan'
        )
      ->where('penerimaan.id', $id->id)
      ->get();

      //return view('adminUkm.calonAnggota.laporan_pdf', compact('ukm', 'calonAnggota'));

    	$pdf = PDF::loadview('adminUkm.calonAnggota.laporan_pdf', compact('ukm', 'calonAnggota'));
    	return $pdf->download($ukm[0]['nama_ukm']. '-' .$calonAnggota[0]->nama);
    }

    public function ubah_status_pendaftaran(){
      $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
      $ukm = Ukm::where('id', $id_ukm)->get();

      if($ukm[0]['pendaftaran'] == 0){
        Ukm::where('id', $id_ukm)
        ->update([
          'pendaftaran' => 1
        ]);
      return redirect()->back()->with('berhasil', 'Berhasil mengubah status pendaftaran menjadi AKTIF.');
      }else{
        Ukm::where('id', $id_ukm)
        ->update([
          'pendaftaran' => 0
        ]);
      return redirect()->back()->with('berhasil', 'Berhasil mengubah status pendaftaran menjadi TIDAK AKTIF.');
      }
    }

}
