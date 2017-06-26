<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
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
        return $this->belongsTo('App\CategorieService');
    }
}
