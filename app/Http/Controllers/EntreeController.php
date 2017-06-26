<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Sentinel;
use Illuminate\Http\Request;
use App\Entree;
use App\Client;
use App\Article;
use App\ArticleEntree;

class EntreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entrees = Entree::all();
        return view('entrees.lister')->with('entrees', $entrees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles = Article::all();
        $clients = Client::all();
        return view('entrees.ajouter')->with(['clients'=>$clients, 'articles'=>$articles]);
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
        $now = Carbon::now();
        $entree = new Entree();
        $entree->ref = "B_".$now->dayOfYear. "_" .$now->hour. "_" .$now->minute. "_" .$now->second;;
        $entree->piece = "neant";
        $entree->complement = $request->complement;
        $entree->dates = Carbon::createFromFormat('d/m/Y', $request->date_entre);
        $entree->taxe = (isset($request->taxe) && $request->taxe != null)?$request->taxe:1 ;
        $entree->settaxe = (isset($request->settaxe) && $request->settaxe != null)?$request->settaxe:0;
        $entree->regler = 0;
        $entree->payer = 0;
        $entree->client_id = $request->client_id;
        $entree->user_id = $user->id;
        if($entree->save())
        {
            $entree_id =  $entree->id;
            foreach ($articles as $key=>$value)
            {
                $articleEntree = new ArticleEntree();
                $articleEntree->entree_id = $entree_id;
                $articleEntree->article_id = $value;
                $articleEntree->unite = $qte[$key];
                $articleEntree->prix = $prix[$key];
                $articleEntree->save();
            }

        }

        return redirect('/entrees')->with('message','Entrée creer avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entree = Entree::find($id);
        return view('entrees.afficher')->with('entree', $entree);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $entree = Entree::find($id);
        $articles = Article::all();
        $clients = Client::all();
        $categories = CategorieArticle::all();
        if(!$entree)
        {
            abort(404);
        }

        return view('articles.modifier')->with(['entree'=>$entree, 'articles'=>$articles, 'clients' => $clients]);
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
