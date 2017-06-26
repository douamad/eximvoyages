<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SortieCaisse extends Model
{
    protected $fillable = [
        'ref', 'piece', 'complement', 'date_facture', 'moyen', 'montant', 'sortie_id', 'user_id'
    ];

    public function moyen()
    {
        if($this->moyen == 'cheque')
            return $this->hasOne('App\RecuCheque');
        elseif ($this->moyen == 'transfert')
            return $this->hasOne('App\RecuTransfert');
        elseif ($this->moyen == 'virement')
            return $this->hasOne('App\RecuVirement');
    }
}
