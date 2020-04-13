<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    protected $fillable = ['clienId', 'date', 'description', 'type'];
}