<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecuCheque extends Model
{
    protected $fillable = [
        'banque', 'code', 'complement', 'encaisser', 'date_encaissement', 'montant', 'recu_id'
    ];

    public function recu()
    {
        return $this->belongsTo('App\recu');
    }
}
