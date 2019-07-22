<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GaleriFoto extends Model
{
    protected $table = "foto_ukm";
    protected $fillable = ['id', 'id_ukm', 'foto', 'keterangan'];
    public $timestamps = false;
}
