<?php
/**
 * Created by PhpStorm.
 * User: ext_camara13
 * Date: 13/01/2017
 * Time: 20:02
 */

namespace App\Transformer;


class ClientTransformer
{
    public function transform($client){
        return  [
            'id' => $client->id,
            'nom' => $client->nom,
            'prenom' => $client->prenom,
            'sigle' => $client->sigle,
            'adresse' => $client->adresse,
            'telephone' => $client->telephone,
            'email' => $client->email,
            'type_client' => $client->type_client
        ];
    }
}