<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'code',
        'libelle',
        'description',
        'type',
        'categorie_id',
        'prix'
    ];



    public function categorie()
    {
        return $this->belongsTo('App\CategorieArticle');
    }
}
