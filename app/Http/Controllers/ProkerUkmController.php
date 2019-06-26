<?php

namespace App\Http\Controllers;

use Auth;
use App\ProkerUkm;
use App\Ukm;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use App\Http\AuthTraits\OwnsRecord;
use PDF;

class ProkerUkmController extends Controller
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
        $dProker = ProkerUkm::where('id_ukm', $id_ukm)->get();
        return view('adminUkm.prokerUkm.index', compact('ukm', 'dProker'));
    }

    public function data_proker()
    {
        $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
        $ukm = Ukm::where('id', $id_ukm)->get();

        $proker = ProkerUKM::where('id_ukm', $id_ukm)->orderBy('tgl_kegiatan', 'DESC')->get();

        return $proker;
    }

    public function download_proposal(ProkerUkm $id){
        if (!$this->pemilikAdminUkm($id)){
          return redirect()->back();
        }
       $file = ('../public' .$id->proposal);
       $headers = ['Content-Type' => 'application/pdf', ];
       return response()->download($file, 'proposal ' .$id->nama_proker, $headers);
    }

    public function download_laporan(ProkerUkm $id){
        if (!$this->pemilikAdminUkm($id)){
          return redirect()->back();
        }
       $file = ('../public' .$id->laporan);
       $headers = ['Content-Type' => 'application/pdf', ];
       return response()->download($file, 'laporan ' .$id->nama_proker, $headers);
    }

    public function upload_proposal(Request $request, ProkerUkm $id){
        $validator = $this->validate($request, [
          'proposal' => 'required|mimes:pdf'
        ]);

        if($validator){
          //DEFINISIKAN PATH
          $this->path = storage_path('../public/file/proposal/');
          //MENGAMBIL FILE proposal DARI FORM
          $file = $request->file('proposal');
          //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
          $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
          //UPLOAD ORIGINAN FILE
          // Image::make($file)->save($this->path . $fileName);
          $file->move($this->path, $fileName);

          ProkerUkm::where('id', $id->id)
          ->update([
            'proposal' => '/file/proposal/'.$fileName
          ]);

          return redirect()->to('/proker-ukm')->with('berhasil', 'Proposal berhasil disimpan.');

        }else{
          return redirect()->to('/proker-ukm')->withErrors($validator)->withInput();
        }
    }

    public function upload_laporan(Request $request, ProkerUkm $id){

      $validator = $this->validate($request, [
        'laporan' => 'required|mimes:pdf',
      ]);

        if($validator){
          //DEFINISIKAN PATH
          $this->path = storage_path('../public/file/laporan/');
          //MENGAMBIL FILE proposal DARI FORM
          $file = $request->file('laporan');
          //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
          $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
          //UPLOAD ORIGINAN FILE
          // Image::make($file)->save($this->path . $fileName);
          $file->move($this->path, $fileName);

          ProkerUkm::where('id', $id->id)
          ->update([
            'pelaksanaan' => "Terlaksana",
            'laporan' => '/file/laporan/'.$fileName
          ]);
          return redirect()->to('/proker-ukm')->with('berhasil', 'Laporan berhasil disimpan dan Status menjadi Terlaksana');

        }else{

          return redirect()->to('/proker-ukm')->with('error', 'Gagal menyimpan laporan, pastikan proposal dalam bentuk .pdf');
        }
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
        return view('adminUkm.prokerUkm.create', compact('ukm'));
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
          'nama_proker' => 'required|string|min:3|max:255',
          'tgl_kegiatan' => 'required',
          'deskripsi' => 'required',
          'proposal' => 'mimes:pdf'
        ]);

        if($validator){//jika validasi berhasil
          if(!empty($request->proposal)){//jika upload proposal
            //DEFINISIKAN PATH
            $this->path = storage_path('../public/file/proposal/');
            //MENGAMBIL FILE proposal DARI FORM
            $file = $request->file('proposal');
            //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            //UPLOAD ORIGINAN FILE
            // Image::make($file)->save($this->path . $fileName);
            $file->move($this->path, $fileName);

            ProkerUkm::create([
              'id_ukm' => $id_ukm,
              'nama_proker' => request('nama_proker'),
              'deskripsi' => request('deskripsi'),
              'tgl_kegiatan' => request('tgl_kegiatan'),
              'proposal' => '/file/proposal/'.$fileName
            ]);

          }else{ //jika tidak upload proposal
            ProkerUkm::create([
              'id_ukm' => $id_ukm,
              'nama_proker' => request('nama_proker'),
              'deskripsi' => request('deskripsi'),
              'tgl_kegiatan' => request('tgl_kegiatan')
            ]);
          }

          return redirect()->to('/proker-ukm')->with('berhasil', 'Program kerja berhasil disimpan.');

        }else{//jika validasi gagal
          return redirect()->to('/proker-ukm/tambah')->withErrors($validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProkerUkm  $prokerUkm
     * @return \Illuminate\Http\Response
     */
    public function show(ProkerUkm $id)
    {
        if (!$this->pemilikAdminUkm($id)){
          return redirect()->back();
        }
        $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
        $ukm = Ukm::where('id', $id_ukm)->get();
        $proker = ProkerUkm::where('id', $id->id)->get();

        return view('adminUkm.prokerUkm.show', compact('ukm', 'proker'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProkerUkm  $prokerUkm
     * @return \Illuminate\Http\Response
     */
    public function edit(ProkerUkm $id)
    {
        if (!$this->pemilikAdminUkm($id)){
          return redirect()->back();
        }
        $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
        $ukm = Ukm::where('id', $id_ukm)->get();
        $proker = ProkerUkm::where('id', $id->id)->get();
        return view('adminUkm.prokerUkm.edit', compact('ukm', 'proker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProkerUkm  $prokerUkm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProkerUkm $id)
    {
        $validator = $this->validate($request, [
          'nama_proker' => 'required|string|min:3|max:255',
          'tgl_kegiatan' => 'required',
          'deskripsi' => 'required',
          'proposal' => 'mimes:pdf',
          'laporan' => 'mimes:pdf'
        ]);

        if($validator){//jika berhasil validasi

          if(!empty($request->proposal)){//upload file proposal
            //DEFINISIKAN PATH
            $this->path = storage_path('../public/file/proposal/');
            //MENGAMBIL FILE proposal DARI FORM
            $file = $request->file('proposal');
            //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
            $fileNameProposal = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            //UPLOAD ORIGINAN FILE
            $file->move($this->path, $fileNameProposal);
            //hapus file sebelumnya
            if($id->proposal != null){
              unlink('../public' .$id->proposal);
            }
          }

          if(!empty($request->laporan)){//upload file laporan
            //DEFINISIKAN PATH
            $this->path = storage_path('../public/file/laporan/');
            //MENGAMBIL FILE proposal DARI FORM
            $file = $request->file('laporan');
            //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
            $fileNameLaporan = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            //UPLOAD ORIGINAN FILE
            $file->move($this->path, $fileNameLaporan);
            //hapus file sebelumnya
            if($id->laporan != null){
              unlink('../public' .$id->laporan);
            }
          }

          if(!empty($request->proposal) && !empty($request->laporan)){ //jika upload proposal dan laporan
            ProkerUkm::where('id', $id->id)
            ->update([
              'nama_proker' => request('nama_proker'),
              'deskripsi' => request('deskripsi'),
              'tgl_kegiatan' => request('tgl_kegiatan'),
              'proposal' => '/file/proposal/'.$fileNameProposal,
              'laporan' => '/file/laporan/'.$fileNameLaporan,
              'pelaksanaan' => "Terlaksana"
            ]);
          }else if(!empty($request->proposal) && empty($request->laporan)){ //jika upload proposal saja
            ProkerUkm::where('id', $id->id)
            ->update([
              'nama_proker' => request('nama_proker'),
              'deskripsi' => request('deskripsi'),
              'tgl_kegiatan' => request('tgl_kegiatan'),
              'proposal' => '/file/proposal/'.$fileNameProposal
            ]);
          }else if(empty($request->proposal) && !empty($request->laporan)){ //jika upload laporan saja
            ProkerUkm::where('id', $id->id)
            ->update([
              'nama_proker' => request('nama_proker'),
              'deskripsi' => request('deskripsi'),
              'tgl_kegiatan' => request('tgl_kegiatan'),
              'laporan' => '/file/laporan/'.$fileNameLaporan,
              'pelaksanaan' => "Terlaksana"
            ]);
          }else if(empty($request->proposal) && empty($request->laporan)){ //jika tidak upload proposal dan laporan
            ProkerUkm::where('id', $id->id)
            ->update([
              'nama_proker' => request('nama_proker'),
              'deskripsi' => request('deskripsi'),
              'tgl_kegiatan' => request('tgl_kegiatan')
            ]);
          }
          return redirect()->to('/proker-ukm')->with('berhasil', 'Program kerja berhasil disimpan.');
        }else{//jika gagal validasi
          return redirect()->to('/proker-ukm/edit/' .$id->id)->withErrors($validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProkerUkm  $prokerUkm
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProkerUkm $id)
    {
        if($id->proposal != null){
          unlink('../public' .$id->proposal);
        }
        if($id->laporan != null){
          unlink('../public' .$id->laporan);
        }

        $id->delete();
        return redirect()->to('/proker-ukm')->with('berhasil', 'Berhasil Menghapus Proker.');
    }

    public function cetak_pdf(ProkerUkm $id){

      if (!$this->pemilikAdminUkm($id)){
        return redirect()->back();
      }

      $id_ukm = Auth::guard('adminUkm')->user()->id_ukm;
      $ukm = Ukm::where('id', $id_ukm)->get();
      $proker = ProkerUkm::where('id', $id->id)->get();

      //return view('adminUkm.prokerUkm.laporan_pdf', compact('ukm', 'proker'));

    	$pdf = PDF::loadview('adminUkm.prokerUkm.laporan_pdf', compact('ukm', 'proker'));
    	return $pdf->download($proker[0]['nama_proker']);
    }
}
