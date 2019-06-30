<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/adminlte', function () {
  return view('adminlte.index');
});

// Route::get('/admin-ukm', function () {
//   return view('adminUkm.index');
// });

// Route::get('/login', function () {
//   return view('login');
// })->middleware('guest');

Route::get('/logout', 'LoginController@logout')->name('logout');

Route::group(['middleware' => 'guest'], function(){

  Route::get('/login', 'LoginController@index');
  Route::post('/login/do-login', 'LoginController@login')->name('login');

});

Route::group(['middleware' => 'auth:admin'], function(){

  Route::get('/ukm/kelola-ukm', 'UkmController@index')->name('admin');
  Route::get('/info-ukm/{ukm}', 'ProfilUkmController@index')->name('infoUkm.index');

  Route::get('/kelola-akun', 'UserController@index')->name('user.index');
  Route::get('/kelola-akun/edit/{user}', 'UserController@edit')->name('user.edit');
  Route::patch('/kelola-akun/edit/{user}/', 'UserController@update')->name('user.update');
  Route::delete('/kelola-akun/hapus/{user}', 'UserController@destroy')->name('user.destroy');
  Route::get('/kelola-akun/data-user', 'UserController@data_user')->name('user.data_user');

  Route::get('/ukm/tambah', 'UkmController@create')->name('ukm.create');
  Route::delete('/ukm/hapus/{ukm}', 'UkmController@destroy')->name('ukm.destroy');
  Route::post('/ukm/tambah/', 'UkmController@store')->name('ukm.store');

  Route::get('/jurusan', 'JurusanController@index')->name('jurusan.index');
  Route::delete('/jurusan/hapus/{id}', 'JurusanController@destroy')->name('jurusan.destroy');
  Route::post('/jurusan/tambah/', 'JurusanController@store')->name('jurusan.store');
  Route::get('/jurusan/data-jurusan', 'JurusanController@data_jurusan')->name('jurusan.data_jurusan');

  Route::get('edit-akun-admin', 'UserController@editAkunAdmin')->name('userAdmin.edit');
  Route::patch('edit-akun-admin/', 'UserController@updateAkun')->name('userAdmin.update');

  Route::get('/info-ukm/baca-berita/{id}', 'BeritaUkmController@show')->name('adminBeritaUkm.show');


});

Route::group(['middleware' => 'auth:adminUkm'], function(){

  Route::get('/profil-ukm', 'ProfilUkmController@indexAdminUkm')->name('profilUkm.indexAdminUkm');
  Route::get('/profil-ukm/edit', 'ProfilUkmController@edit')->name('profilUkm.edit');
  Route::patch('/profil-ukm/edit/', 'ProfilUkmController@update')->name('profilUkm.update');

  Route::get('/anggota-ukm/tambah', 'AnggotaUkmController@create')->name('anggotaUkm.create');
  Route::get('/anggota-ukm/tambah-dari-daftar', 'AnggotaUkmController@tambah_dari_daftar')->name('anggotaUkm.tambah_dari_daftar');
  Route::post('/anggota-ukm/tambah-dari-daftar/', 'AnggotaUkmController@store_from_list')->name('anggotaUkm.store_from_list');
  Route::post('/anggota-ukm/tambah/', 'AnggotaUkmController@store')->name('anggotaUkm.store');
  Route::get('/anggota-ukm/edit/{id}', 'AnggotaUkmController@edit')->name('anggotaUkm.edit');
  Route::get('/anggota-ukm/cetak-pdf/{id}', 'AnggotaUkmController@cetak_pdf')->name('anggotaUkm.cetak_pdf');
  Route::patch('/anggota-ukm/edit/{anggota_ukm}/', 'AnggotaUkmController@update')->name('anggotaUkm.update');
  Route::delete('/anggota-ukm/hapus/{id}', 'AnggotaUkmController@destroy')->name('anggotaUkm.destroy');
  Route::get('/anggota-ukm', 'AnggotaUkmController@index')->name('anggotaUkm.index');
  Route::get('/anggota-ukm/data-anggota', 'AnggotaUkmController@data_anggota')->name('anggotaUkm.data_anggota');
  Route::get('/anggota-ukm/data-mahasiswa', 'AnggotaUkmController@data_mahasiswa')->name('anggotaUkm.data_mahasiswa');

  Route::get('/proker-ukm', 'ProkerUkmController@index')->name('prokerUkm.index');
  Route::get('/proker-ukm/data-proker', 'ProkerUkmController@data_proker')->name('prokerUkm.data_proker');
  Route::get('/proker-ukm/tambah', 'ProkerUkmController@create')->name('prokerUkm.create');
  Route::get('/proker-ukm/edit/{id}', 'ProkerUkmController@edit')->name('prokerUkm.edit');
  Route::patch('/proker-ukm/edit/{id}/', 'ProkerUkmController@update')->name('prokerUkm.update');
  Route::get('/proker-ukm/lihat/{id}', 'ProkerUkmController@show')->name('prokerUkm.show');
  Route::get('/proker-ukm/lihat/cetak-pdf/{id}', 'ProkerUkmController@cetak_pdf')->name('prokerUkm.cetak_pdf');
  Route::get('/proker-ukm/proposal/download/{id}/', 'ProkerUkmController@download_proposal')->name('prokerUkm.download.proposal');
  Route::get('/proker-ukm/laporan/download/{id}/', 'ProkerUkmController@download_laporan')->name('prokerUkm.download.laporan');
  Route::post('/proker-ukm/proposal/upload/{id}/', 'ProkerUkmController@upload_proposal')->name('prokerUkm.upload.proposal');
  Route::post('/proker-ukm/laporan/upload/{id}/', 'ProkerUkmController@upload_laporan')->name('prokerUkm.upload.laporan');
  Route::post('/proker-ukm/tambah/', 'ProkerUkmController@store')->name('prokerUkm.store');
  Route::delete('/proker-ukm/hapus/{id}', 'ProkerUkmController@destroy')->name('prokerUkm.destroy');

  Route::get('/calon-anggota', 'CalonAnggotaController@index')->name('calonAnggota.index');
  Route::get('/calon-anggota/lihat/{id}', 'CalonAnggotaController@show')->name('calonAnggota.show');
  Route::get('/calon-anggota/data-calon-anggota', 'CalonAnggotaController@data_calonAnggota')->name('calonAnggota.data_calon_anggota');
  Route::delete('/calon-anggota/hapus/{id}', 'CalonAnggotaController@destroy')->name('calonAnggota.destroy');
  Route::get('/calon-anggota/lihat/cetak-pdf/{id}', 'CalonAnggotaController@cetak_pdf')->name('calonAnggota.cetak_pdf');
  Route::get('/calon-anggota/ubah-status', 'CalonAnggotaController@ubah_status_pendaftaran')->name('calonAnggota.ubah.status');

  Route::get('/berita-ukm', 'BeritaUkmController@index')->name('beritaUkm.index');
  Route::get('/berita-ukm/tambah', 'BeritaUkmController@create')->name('beritaUkm.create');
  Route::post('/berita-ukm/tambah/', 'BeritaUkmController@store')->name('beritaUkm.store');
  Route::get('/berita-ukm/semua-berita/', 'BeritaUkmController@semuaBerita')->name('beritaUkm.semuaBerita');
  Route::get('/berita-ukm/baca/{id}', 'BeritaUkmController@show')->name('beritaUkm.show');
  Route::get('/berita-ukm/edit/{id}', 'BeritaUkmController@edit')->name('beritaUkm.edit');
  Route::patch('/berita-ukm/edit/{id}/', 'BeritaUkmController@update')->name('beritaUkm.update');
  Route::get('/berita-ukm/data-berita', 'BeritaUkmController@data_berita')->name('beritaUkm.data_berita');
  Route::delete('/berita-ukm/hapus/{id}', 'BeritaUkmController@destroy')->name('beritaUkm.destroy');
  Route::get('/berita-ukm/baca/cetak-pdf/{id}', 'BeritaUkmController@cetak_pdf')->name('beritaUkm.cetak_pdf');

  Route::get('edit-akun-admin-ukm', 'UserController@editAkunAdminUkm')->name('userAdminUkm.edit');
  Route::patch('edit-akun-admin-ukm/', 'UserController@updateAkun')->name('userAdminUkm.update');

  Route::get('/galeri-foto', 'GaleriFotoController@index')->name('galeriFoto.index');
  Route::post('/galeri-foto/upload', 'GaleriFotoController@store')->name('galeriFoto.store');
  Route::delete('/galeri-foto/hapus/{id}', 'GaleriFotoController@destroy')->name('galeriFoto.destroy');

});

Route::group(['middleware' => 'auth:anggotaUkm'], function(){
  Route::get('/ukm', 'UkmController@anggotaUkm_index')->name('anggotaUkm.ukm.index');
  Route::get('/profil-saya', 'ProfilUserController@index')->name('anggotaUkm.profilUser.index');
  Route::patch('/profil-saya/update', 'ProfilUserController@update')->name('anggotaUkm.profilUser.update');

  Route::post('/ukm/dashboard', 'ProfilUkmController@indexAdminUkm')->name('anggotaUkm.ukm.dashboard');
  Route::get('/ukm/dashboard/', 'ProfilUkmController@indexAdminUkm')->name('anggotaUkm.ukm.dashboardProfilUkm');

  Route::get('/ukm/dashboard/galeri-foto', 'GaleriFotoController@index')->name('anggotaUkm.galeriFoto.index');

  Route::get('/ukm/dashboard/berita-ukm', 'BeritaUkmController@semuaBerita')->name('anggotaUkm.beritaUkm.index');
  Route::get('/ukm/dashboard/berita-ukm/baca/{id}', 'BeritaUkmController@show')->name('anggotaUkm.beritaUkm.show');

  Route::get('/ukm/dashboard/anggota-ukm', 'AnggotaUkmController@index')->name('anggotaUkm.anggotaUkm.index');
  Route::get('/ukm/dashboard/anggota-ukm/detail/{id}', 'AnggotaUkmController@show')->name('anggotaUkm.anggotaUkm.show');
  Route::get('/ukm/dashboard/anggota-ukm/data-anggota', 'AnggotaUkmController@data_anggota')->name('anggotaUkm.anggotaUkm.data_anggota');

  Route::get('/ukm/dashboard/proker-ukm', 'ProkerUkmController@index')->name('anggotaUkm.prokerUkm.index');
  Route::get('/ukm/dashboard/proker-ukm/detail/{id}', 'ProkerUkmController@show')->name('anggotaUkm.prokerUkm.show');
  Route::get('/ukm/dashboard/proker-ukm/data-proker', 'ProkerUkmController@data_proker')->name('anggotaUkm.prokerUkm.data_proker');
  Route::get('/ukm/dashboard/proker-ukm/proposal/download/{id}/', 'ProkerUkmController@download_proposal')->name('anggotaUkm.prokerUkm.download.proposal');
  Route::get('/ukm/dashboard/proker-ukm/laporan/download/{id}/', 'ProkerUkmController@download_laporan')->name('anggotaUkm.prokerUkm.download.laporan');

  Route::get('/ukm/dashboard/calon-anggota', 'CalonAnggotaController@index')->name('anggotaUkm.calonAnggota.index');
  Route::get('/ukm/dashboard/calon-anggota/detail/{id}', 'CalonAnggotaController@show')->name('anggotaUkm.anggotaUkm.calonAnggota.index');
  Route::get('/ukm/dashboard/calon-anggota/data-calon-anggota', 'CalonAnggotaController@data_calonAnggota')->name('anggotaUkm.calonAnggota.data_calon_anggota');

  Route::get('/ukm/profil-ukm/{id}', 'ProfilUkmController@profilUkm')->name('anggotaUkm.ukm.profilUkm');
  Route::get('/ukm/profil-ukm/{id}/berita', 'BeritaUkmController@semuaBerita')->name('public.beritaUkm.index');
  Route::get('/ukm/profil-ukm/berita/baca/{id}', 'BeritaUkmController@show')->name('public.beritaUkm.show');
  Route::get('/ukm/profil-ukm/{id}/galeri-foto', 'GaleriFotoController@index')->name('public.galeriFoto.index');

});

Route::group(['middleware' => ['auth:bem', 'auth:wd1']], function(){
  // prefix pakai /monitoring
});


Route::get('public/berita/baca/cetak-pdf/{id}', 'BeritaUkmController@cetak_pdf')->name('public.beritaUkm.cetak_pdf');
Route::get('public/anggota-ukm/cetak-pdf/{id}', 'AnggotaUkmController@cetak_pdf')->name('public.anggotaUkm.cetak_pdf');
Route::get('public/proker-ukm/detail/cetak-pdf/{id}', 'ProkerUkmController@cetak_pdf')->name('public.prokerUkm.cetak_pdf');
Route::get('public/calon-anggota/detail/cetak-pdf/{id}', 'CalonAnggotaController@cetak_pdf')->name('public.calonAnggota.cetak_pdf');





// Auth::routes();
//
// Route::get('/home', 'HomeController@index')->name('home');
