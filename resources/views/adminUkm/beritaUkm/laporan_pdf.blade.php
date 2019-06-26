<center>
<div style="background:#222D32; color:white; padding:5px; border-bottom:5px solid #0097BC; margin-bottom:-13px;">
<h1>Sistem Informasi Unit Kegiatan Mahasiswa</h1>
<h2>Politeknik TEDC Bandung</h2>
</div>
</center>
<br>
<div style="background:#222D32; color:white; padding:5px; border-bottom:5px solid #0097BC;">
  Berita UKM
</div>
<hr><br>

<table>
  <tr>
    <td style="width:300px; vertical-align:top;"><b>Nama Unit Kegiatan Mahasiswa </b></td> <td style="width:300px;">{{$ukm[0]['nama_ukm']}}</td>
  </tr>
  <tr>
    <td style="width:300px; vertical-align:top;"><b>Judul Berita </b></td> <td style="width:300px;">{{$berita[0]->judul_berita}}</td>
  </tr>
  <tr>
    <td style="width:300px; vertical-align:top;"><b>Tanggal Berita </b></td> <td style="width:300px;">{{$berita[0]->tanggal_berita}}</td>
  </tr>
  <tr>
    <td style="width:300px; vertical-align:top;"><b>Sifat Berita </b></td> <td style="width:300px;">{{$berita[0]->sifat_berita}}</td>
  </tr>
</table>
<hr>
{!! $berita[0]->isi_berita !!}
