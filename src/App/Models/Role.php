<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function role()
    {
        return $this->hasOne('App\Models\User');
    }
}
