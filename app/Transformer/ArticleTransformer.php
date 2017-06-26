<?php
/**
 * Created by PhpStorm.
 * User: ext_camara13
 * Date: 11/01/2017
 * Time: 15:40
 */

namespace App\Transformer;


class ArticleTransformer
{
    public function transform($article){
        return  [
            'id' => $article->id,
            'code' => $article->code,
            'libelle' => $article->libelle,
            'description' => $article->description,
            'type' => $article->type,
            'categorie_id' => $article->categorie_id,
            'prix' => $article->prix
        ];
    }
}