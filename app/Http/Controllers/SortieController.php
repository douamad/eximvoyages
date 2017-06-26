<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\Sortie;
use App\Fournisseur;
use Carbon\Carbon;
use App\Article;
use App\ArticleSortie;

class SortieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sorties = Sortie::all();
        return view('sorties.lister')->with('sorties', $sorties);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles = Article::all();
        $fournisseurs = Fournisseur::all();
        return view('sorties.ajouter')->with(['fournisseurs'=>$fournisseurs, 'articles'=>$articles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request);
        $articles = explode("_", $request->artiles_id);
        $prix = explode("_", $request->artiles_prix);
        $qte = explode("_", $request->artiles_qte);

        $user = Sentinel::check();
        $sortie = new Sortie();
        $sortie->ref = $request->ref;
        $sortie->piece = "neant";
        $sortie->complement = $request->complement;
        $sortie->dates = Carbon::createFromFormat('d/m/Y', $request->date_entre);
        $sortie->taxe = (isset($request->taxe) && $request->taxe != null)?$request->taxe:1 ;
        $sortie->settaxe = (isset($request->settaxe) && $request->settaxe != null)?$request->settaxe:0;
        $sortie->regler = 0;
        $sortie->payer = 0;
        $sortie->fournisseur_id = $request->fournisseur_id;
        $sortie->user_id = $user->id;
        if($sortie->save())
        {
            $sortie_id =  $sortie->id;
            foreach ($articles as $key=>$value)
            {
                $articleSortie = new ArticleSortie();
                $articleSortie->sortie_id = $sortie_id;
                $articleSortie->article_id = $value;
                $articleSortie->unite = $qte[$key];
                $articleSortie->prix = $prix[$key];
                $articleSortie->save();
            }

        }

        return redirect('/sorties')->with('message','Entrée creer avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sortie = Sortie::find($id);
        return view('sorties.afficher')->with('sortie', $sortie);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $sortie = Sortie::find($id);
        $articles = Article::all();
        $fournisseurs = Fournisseur::all();
        $categories = CategorieArticle::all();
        if(!$sortie)
        {
            abort(404);
        }

        return view('articles.modifier')->with(['sortie'=>$sortie, 'articles'=>$articles, 'fournisseurs' => $fournisseurs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        $article->code = $request->code;
        $article->libelle = $request->libelle;
        $article->description = $request->description;
        $article->prix = $request->prix;
        $article->categorie_id = $request->categorie_id;
        $article->save();
        return redirect('/articles')->with('message','Article modifier avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect('/articles')->with('message','Article supprimer avec succés');
    }
}
