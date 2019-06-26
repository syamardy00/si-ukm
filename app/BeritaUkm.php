<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BeritaUkm extends Model
{
    protected $table = "berita";
    protected $fillable = ['judul_berita', 'isi_berita', 'tanggal_berita', 'id_ukm', 'sifat_berita'];
}
