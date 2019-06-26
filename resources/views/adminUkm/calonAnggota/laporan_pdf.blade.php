<center>
<div style="background:#222D32; color:white; padding:5px; border-bottom:5px solid #0097BC; margin-bottom:-13px;">
<h1>Sistem Informasi Unit Kegiatan Mahasiswa</h1>
<h2>Politeknik TEDC Bandung</h2>
</div>
</center>
<br>
<div style="background:#222D32; color:white; padding:5px; border-bottom:5px solid #0097BC;">
  Data Calon Anggota
</div>
<hr><br>
<center>

<table>
  <tr>
    <td style="width:300px; vertical-align:top;"><b>Nama Unit Kegiatan Mahasiswa </b></td> <td style="width:300px;">{{$ukm[0]['nama_ukm']}}</td>
  </tr>
  <tr>
    <td style="width:300px; vertical-align:top;"><b>Tanggal Pendaftaran </b></td> <td style="width:300px;">{{$calonAnggota[0]->tgl_pendaftaran}}</td>
  </tr>
  <tr>
    <td style="width:300px; vertical-align:top;"><b>NIM </b></td> <td style="width:300px;">{{$calonAnggota[0]->nim}}</td>
  </tr>
  <tr>
    <td style="width:300px; vertical-align:top;"><b>Nama Lengkap </b></td> <td style="width:300px;">{{$calonAnggota[0]->nama}}</td>
  </tr>
  <tr>
    <td style="width:300px; vertical-align:top;"><b>Jenis Kelamin </b></td> <td style="width:300px;">{{$calonAnggota[0]->jenis_kelamin}}</td>
  </tr>
  <tr>
    <td style="width:300px; vertical-align:top;"><b>Tanggal Lahir </b></td> <td style="width:300px;">{{$calonAnggota[0]->tgl_lahir}}</td>
  </tr>
  <tr>
    <td style="width:300px; vertical-align:top;"><b>Jurusan </b></td> <td style="width:300px;">{{$calonAnggota[0]->nama_jurusan}}</td>
  </tr>
  <tr>
    <td style="width:300px; vertical-align:top;"><b>Tahun Angkatan </b></td> <td style="width:300px;">{{$calonAnggota[0]->tahun_angkatan}}</td>
  </tr>
  <tr>
    <td style="width:300px; vertical-align:top;"><b>Email </b></td> <td style="width:300px;">{{$calonAnggota[0]->email}}</td>
  </tr>
  <tr>
    <td style="width:300px; vertical-align:top;"><b>No Telepon </b></td> <td style="width:300px;">{{$calonAnggota[0]->no_telepon}}</td>
  </tr>
</table>
</center>
