<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class robot extends Model
{
    protected $fillable = ['objetId', 'name', 'produit_menager', 'outil_menager', 'quantite_produit_restant', 'quantite_outil_restant', 'dernier_lavage'];
}