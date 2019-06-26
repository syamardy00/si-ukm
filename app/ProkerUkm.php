<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProkerUkm extends Model
{
    protected $table = "proker";
    protected $fillable = ['id_ukm', 'nama_proker', 'deskripsi', 'tgl_kegiatan', 'proposal', 'laporan', 'pelaksanaan'];
}
