<?php
/**
 * Created by PhpStorm.
 * User: ext_camara13
 * Date: 13/01/2017
 * Time: 20:45
 */

namespace App\Transformer;


class CategorieArticleTransformer
{
    public function transform($catedorie)
    {
        return [
            'id' => $catedorie->id,
            'code' => $catedorie->code,
            'libelle' => $catedorie->libelle,
            'description' => $catedorie->description
        ];
    }

}