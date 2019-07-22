<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\AuthTraits\OwnsRecord;

class AnggotaUkm extends Model
{
    protected $table = "anggota";
    protected $fillable = ['id_user', 'id_ukm', 'status'];
    public $timestamps = false;
}
