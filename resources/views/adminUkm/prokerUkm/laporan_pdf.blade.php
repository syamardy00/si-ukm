<center>
<div style="background:#222D32; color:white; padding:5px; border-bottom:5px solid #0097BC; margin-bottom:-13px;">
<h1>Sistem Informasi Unit Kegiatan Mahasiswa</h1>
<h2>Politeknik TEDC Bandung</h2>
</div>
</center>
<br>
<div style="background:#222D32; color:white; padding:5px; border-bottom:5px solid #0097BC;">
  Program Kerja UKM
</div>
<hr><br>
<center>

<table>
  <tr>
    <td style="width:300px; vertical-align:top;"><b>Nama Unit Kegiatan Mahasiswa </b></td> <td style="width:300px;">{{$ukm[0]['nama_ukm']}}</td>
  </tr>
  <tr>
    <td style="width:300px; vertical-align:top;"><b>Nama Program Kerja </b></td> <td style="width:300px;">{{$proker[0]['nama_proker']}}</td>
  </tr>
  <tr>
    <td style="width:300px; vertical-align:top;"><b>Tanggal Kegiatan </b></td> <td style="width:300px;">{{$proker[0]['tgl_kegiatan']}}</td>
  </tr>
  <tr>
    @if($proker[0]['pelaksanaan'] == "Terlaksana")
      <td style="width:300px; vertical-align:top;"><b>Status Pelaksanaan </b></td> <td style="width:300px; color:green;">{{$proker[0]['pelaksanaan']}}</td>
    @else
      <td style="width:300px; vertical-align:top;"><b>Status Pelaksanaan </b></td> <td style="width:300px; color:green;">{{$proker[0]['pelaksanaan']}}</td>
    @endif
  </tr>
  <tr>
    <td style="width:300px; vertical-align:top;"><b>Deskripsi </b></td> <td style="width:300px;">{{$proker[0]['deskripsi']}}</td>
  </tr>
</table>
</center>
