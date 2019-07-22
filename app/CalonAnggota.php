<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalonAnggota extends Model
{
    protected $table="penerimaan";
    protected $fillable = ['nim', 'nama', 'id_jurusan', 'jenis_kelamin', 'tgl_lahir', 'tahun_angkatan', 'email', 'no_telepon', 'id_ukm', 'tgl_pendaftaran'];
    public $timestamps = false;
}
