<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleEntree extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'entree_id', 'article_id', 'unite', 'prix'
    ];

    public function entree()
    {
        return $this->belongsTo('App\Entree');
    }
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
