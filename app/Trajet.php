<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'lieu_depart','heure_depart','date_depart','vol_depart','enreg','statut','terminal','heure_arr','lieu_arr','billet_id'
    ];

    public function billet(){
        return $this->belongsTo('App\Billet');
    }
}

