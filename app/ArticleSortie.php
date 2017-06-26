<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleSortie extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'sortie_id', 'article_id', 'unite', 'prix'
    ];

    public function entree()
    {
        return $this->belongsTo('App\Sortie');
    }
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
