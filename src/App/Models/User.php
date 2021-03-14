<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    protected $fillable = ['login', 'password', 'role_id', 'email', 'avatar', 'about', 'fio'];

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function post()
    {
        return $this->hasOne('App\Models\Post');
    }
}
