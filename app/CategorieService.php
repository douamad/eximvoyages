<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategorieService extends Model
{
    protected $fillable = [
        'code',
        'libelle',
        'description'
    ];
}
