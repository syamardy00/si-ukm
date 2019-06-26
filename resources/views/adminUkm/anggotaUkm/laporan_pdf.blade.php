<center>
<div style="background:#222D32; color:white; padding:5px; border-bottom:5px solid #0097BC; margin-bottom:-13px;">
<h1>Sistem Informasi Unit Kegiatan Mahasiswa</h1>
<h2>Politeknik TEDC Bandung</h2>
</div>
</center>
<br>
<div style="background:#222D32; color:white; padding:5px; border-bottom:5px solid #0097BC;">
  Data Anggota UKM
</div>
<hr><br>
<center>
@foreach($anggota as $a)
<table>
  <tr>
    <td style="width:280px; vertical-align:top;"><b>Nama Unit Kegiatan Mahasiswa </b></td> <td style="width:280px;">{{$ukm[0]['nama_ukm']}}</td>
    <td style="width:280px;" rowspan="6"><img src="{{base_path('public' .$a->foto)}}" style="height:120px;"></td>
  </tr>
  <tr>
    <td style="width:280px; vertical-align:top;"><b>Username </b></td> <td style="width:280px;">{{$a->username}}</td>
  </tr>
  <tr>
    <td style="width:280px; vertical-align:top;"><b>Nim </b></td> <td style="width:280px;">{{$a->nim}}</td>
  </tr>
  <tr>
    <td style="width:280px; vertical-align:top;"><b>Nama Lengkap </b></td> <td style="width:280px;">{{$a->nama}}</td>
  </tr>
  <tr>
    <td style="width:280px; vertical-align:top;"><b>Jenis Kelamin </b></td> <td style="width:280px;">{{$a->jenis_kelamin}}</td>
  </tr>
  <tr>
    <td style="width:280px; vertical-align:top;"><b>Tanggal Lahir </b></td> <td style="width:280px;">{{$a->tgl_lahir}}</td>
  </tr>
  <tr>
    <td style="width:280px; vertical-align:top;"><b>Jurusan </b></td> <td style="width:280px;">{{$a->nama_jurusan}}</td>
  </tr>
  <tr>
    <td style="width:280px; vertical-align:top;"><b>Tahun Angkatan </b></td> <td style="width:280px;">{{$a->tahun_angkatan}}</td>
  </tr>
  <tr>
    <td style="width:280px; vertical-align:top;"><b>No Telepon </b></td> <td style="width:280px;">{{$a->no_telepon}}</td>
  </tr>
  <tr>
    <td style="width:280px; vertical-align:top;"><b>Email </b></td> <td style="width:280px;">{{$a->email}}</td>
  </tr>
  <tr>
    <td style="width:280px; vertical-align:top;"><b>Status Keanggotaan </b></td> <td style="width:280px;">{{$a->status}}</td>
  </tr>
</table>
@endforeach
</center>
