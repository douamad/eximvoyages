<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategorieArticle extends Model
{
    protected $fillable = [
        'code',
        'libelle',
        'description'
    ];
}
