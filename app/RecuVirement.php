<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecuVirement extends Model
{
    protected $fillable = [
        'banque', 'code', 'complement', 'effectif', 'date_effectif', 'montant', 'recu_id'
    ];

    public function recu()
    {
        return $this->belongsTo('App\recu');
    }
}
