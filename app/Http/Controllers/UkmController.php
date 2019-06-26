<?php

namespace App\Http\Controllers;

use App\Ukm;
use Illuminate\Http\Request;
use App\User;
use DB;
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
    public function index()
    {
        //
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

      // if($countUkm>0){
      //     Session::flash('message', 'Nama Ukm telah terdaftar!');
      //     Session::flash('message_type', 'danger');
      //     return redirect()->to('/ukm/tambah');
      //
      // }
      // if($countUser>0){
      //     Session::flash('message', 'Username sudah terpakai!');
      //     Session::flash('message_type', 'danger');
      //     return redirect()->to('/ukm/tambah');
      // }

      // $this->validate($request, [
      //     'nama_ukm' => 'required|string|max:255|unique:ukm',
      //     'username' => 'required|string|max:20|unique:user',
      //     'password' => 'required'
      // ]);

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
        return redirect()->to('/admin')->with('berhasil', 'UKM Baru Berhasil Ditambahkan.');

      }else{
        return redirect()->to('/ukm/tambah')->withErrors($validator)->withInput();
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ukm  $ukm
     * @return \Illuminate\Http\Response
     */
    public function show(Ukm $ukm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ukm  $ukm
     * @return \Illuminate\Http\Response
     */
    public function edit(Ukm $ukm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ukm  $ukm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ukm $ukm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ukm  $ukm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ukm $ukm)
    {
      User::where('id_ukm', $ukm->id)->delete();
      $ukm->delete();
      return redirect()->to('/admin')->with('berhasil', 'UKM Berhasil Dihapus.');
      // return $ukm->id;
    }
}
