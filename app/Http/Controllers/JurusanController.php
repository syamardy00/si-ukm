<?php

namespace App\Http\Controllers;

use App\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dJurusan = Jurusan::orderBy('nama_jurusan', 'ASC')->get();
        return view('admin.jurusan.index', compact('dJurusan'));
    }

    public function data_jurusan()
    {
        $jurusan = Jurusan::orderBy('nama_jurusan', 'ASC')->get();
        return $jurusan;
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
      //dd($request);
      $validator = $this->validate($request, [
        'nama_jurusan' => 'required|string|min:2|max:50|unique:jurusan,nama_jurusan'
      ]);

      if($validator){
        Jurusan::create([
          'nama_jurusan' => request('nama_jurusan')
        ]);

        return redirect()->to('/jurusan')->with('berhasil', 'Jurusan berhasil disimpan.');

      }else{
        return redirect()->to('/jurusan')->with('gagal', 'Jurusan gagal disimpan, nama jurusan sudah ada.');
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function show(Jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurusan $jurusan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurusan $id)
    {
        $id->delete();
        return redirect()->to('/jurusan')->with('berhasil', 'Jurusan berhasil dihapus.');
    }
}
