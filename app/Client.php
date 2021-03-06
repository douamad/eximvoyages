<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'sigle',
        'adresse',
        'telephone',
        'email',
        'type_client'
    ];
}
