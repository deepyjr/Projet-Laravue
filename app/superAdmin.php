<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class superAdmin extends Model
{
    protected $fillable = ['email', 'pseudo', 'password'];
}