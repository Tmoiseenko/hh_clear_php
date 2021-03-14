<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    public $timestamps = false;
    protected $fillable = ['email'];
}
