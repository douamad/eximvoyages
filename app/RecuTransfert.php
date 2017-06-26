<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecuTransfert extends Model
{
    protected $fillable = [
        'reseau', 'code', 'complement', 'encaisser', 'date_encaissement', 'montant', 'recu_id'
    ];

    public function recu()
    {
        return $this->belongsTo('App\recu');
    }
}
