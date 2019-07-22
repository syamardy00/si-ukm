<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\AuthTraits\OwnsRecord;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = "user";
    protected $fillable = ['id_user', 'id_role', 'id_ukm','username' ,'password'];
    public $timestamps = false;
}
