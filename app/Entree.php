<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entree extends Model
{
    protected $fillable= [
        'ref','piece','complement','dates','taxe','settaxe','regler','payer','client_id','user_id'
    ];

    public function vendeur()
    {
        return $this->belongsTo('App\User');
    }
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    public function articlesEntrees()
    {
        return $this->hasMany('App\ArticleEntree');
    }
    public function recus()
    {
        return $this->hasMany('App\Recu');
    }

}
