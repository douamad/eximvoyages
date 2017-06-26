<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Lavary\Menu\Menu;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Sentinel::check())
        {
            $mymenu = new Menu();
            $mymenu->make('example', function($menu){
                $menu->add('Accueil');
                $menu->add('Articles', array('url'=>'javascript:void(0);'))
                    ->prepend(' <i class="icon-picture mr-10"></i>')
                    ->append('<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span> ');
                $menu->articles->add('Lister', 'articles');
                $menu->articles->add('Ajouter', 'articles/ajouter');
                $menu->articles->add('modifier', 'articles/modifier');

                $menu->articles->add('Categorie Article', array('url'=>'javascript:void(0);'))
                    ->append('<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span> ');
                $menu->categorieArticle->add('Lister', 'articles/categorie');
                $menu->categorieArticle->add('Ajouter', 'articles/categorie/ajouter');
                $menu->categorieArticle->add('modifier', 'articles/categorie/modifier');


                $menu->add('Billets', array('url'=>'javascript:void(0);'))
                    ->prepend(' <i class="icon-picture mr-10"></i>')
                    ->append('<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span> ');
                $menu->billets->add('Lister', 'billets');
                $menu->billets->add('Ajouter', 'billets/ajouter');
                $menu->billets->add('Analyse', 'billets/analyse');
                $menu->billets->add('Reçus', 'recus');

                $menu->add('Entrees', array('url'=>'javascript:void(0);'))
                    ->prepend(' <i class="icon-picture mr-10"></i>')
                    ->append('<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span> ');
                $menu->entrees->add('Lister', 'entrees');
                $menu->entrees->add('Ajouter', 'entrees/ajouter');
                $menu->entrees->add('Analyse', 'entrees/analyse');
                $menu->entrees->add('Reçus', 'recus');


                $menu->add('Sorties', array('url'=>'javascript:void(0);'))
                    ->prepend(' <i class="icon-picture mr-10"></i>')
                    ->append('<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span> ');
                $menu->sorties->add('Lister', 'sorties');
                $menu->sorties->add('Ajouter', 'sorties/ajouter');
                $menu->sorties->add('Sortie de Caisses', 'SortieCaisses');

                $menu->add('Clients', array('url'=>'javascript:void(0);'))
                    ->prepend(' <i class="icon-picture mr-10"></i>')
                    ->append('<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span> ');
                $menu->clients->add('Lister', 'clients');
                $menu->clients->add('Ajouter', 'clients/ajouter');

                $menu->add('Fournisseurs', array('url'=>'javascript:void(0);'))
                    ->prepend(' <i class="icon-picture mr-10"></i>')
                    ->append('<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span> ');
                $menu->fournisseurs->add('Lister', 'fournisseurs');
                $menu->fournisseurs->add('Ajouter', 'fournisseurs/ajouter');

                $menu->add('Users', array('url'=>'javascript:void(0);'))
                    ->prepend(' <i class="icon-picture mr-10"></i>')
                    ->append('<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span> ');
                $menu->users->add('Lister', 'users');
                $menu->users->add('Ajouter', 'users/ajouter');
            });





            return $next($request);
        }
        else
        {
            return redirect('/login');
        }
        //return $next($request);
    }
}
