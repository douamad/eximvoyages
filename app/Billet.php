<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billet extends Model
{
    protected $fillable = [
        'nom_psg',
        'prenom_psg',
        'civilite_psg',
        'code_iata',
        'nom_comp',
        'code_comp',
        'numero_billet',
        'ref_dossier',
        'id_comp',
        'id_cli',
        'client_id',
        'prix_htt',
        'prix_ttc',
        'commission',
        'frais_service',
        'net_a_payer',
        'montant_recu',
        'date_billet'
    ];
    public function trajets(){
        return $this->hasMany('App\Trajet');
    }
}
