<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class objet extends Model
{
    protected $fillable = ['siteId', 'name', 'dernier_lavage'];
}