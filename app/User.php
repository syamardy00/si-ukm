<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\AuthTraits\OwnsRecord;

class User extends Model
{
    protected $table = "user";
    protected $fillable = ['id_user', 'id_role', 'id_ukm','username' ,'password'];
}
