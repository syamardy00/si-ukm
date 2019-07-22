<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class ProfilUser extends Model implements Authenticatable
{
      use AuthenticableTrait;

      protected $table='profil_user';
      protected $fillable = ['id_user', 'nim', 'nama', 'id_jurusan' ,'jenis_kelamin', 'tgl_lahir', 'tahun_angkatan', 'foto', 'email', 'no_telepon'];
      public $timestamps = false;
}
