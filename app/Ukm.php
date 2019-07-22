<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ukm extends Model
{
    protected $table = "ukm";
    protected $fillable = ['id','nama_ukm', 'logo_ukm', 'visi', 'misi', 'profil', 'struktur', 'pendaftaran'];
    public $timestamps = false;
}
