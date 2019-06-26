<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

// use Illuminate\Contracts\Auth\Authenticatable;
// use Illuminate\Auth\Authenticatable as AuthenticableTrait;


class Login extends Authenticatable
{
    // use AuthenticableTrait;
    public $table = "user";
    protected $fillable = ['id_user', 'id_role', 'id_ukm','username' ,'password'];
}
