<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sortie extends Model
{
    protected $fillable= [
        'ref','piece','complement','dates','taxe','settaxe','regler','payer','fournisseur_id','user_id'
    ];

    public function vendeur()
    {
        return $this->belongsTo('App\User');
    }
    public function fournisseur()
    {
        return $this->belongsTo('App\Fournisseur');
    }
    public function articlesSorties()
    {
        return $this->hasMany('App\ArticleSortie');
    }
    public function sortieCaisses()
    {
        return $this->hasMany('App\SortieCaisse');
    }
}
