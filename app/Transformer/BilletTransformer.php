<?php
/**
 * Created by PhpStorm.
 * User: ext_camara13
 * Date: 13/01/2017
 * Time: 20:40
 */

namespace App\Transformer;


class BilletTransformer
{
    public function transform($billet)
    {
        return [
            'nom_psg' => $billet->nom_psg,
            'prenom_psg' => $billet->prenom_psg,
            'civilite_psg' => $billet->civilite_psg,
            'code_iata' => $billet->code_iata,
            'nom_comp' => $billet->nom_comp,
            'code_comp' => $billet->code_comp,
            'numero_billet' => $billet->numero_billet,
            'ref_dossier' => $billet->ref_dossier,
            'id_comp' => $billet->id_comp,
            'id_cli' => $billet->id_cli,
            'client_id' => $billet->client_id,
            'prix_htt' => $billet->prix_htt,
            'prix_ttc' => $billet->prix_ttc,
            'commission' => $billet->commission,
            'frais_service' => $billet->frais_service,
            'net_a_payer' => $billet->net_a_payer,
            'montant_recu' => $billet->montant_recu,
            'date_billet' => $billet->date_billet
        ];
    }
}