<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class commande extends Model
{
    protected $fillable = ['clientId', 'objetId', 'status', 'date_commande', 'date_debut', 'date_fin'];
}
