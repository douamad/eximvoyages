<?php

namespace App\Http\Controllers;

use App\CategorieArticle;
use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return view('articles.lister')->with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategorieArticle::all();
        return view('articles.ajouter')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code'=>'required',
            'libelle'=>'required',
            'categorie_id'=>'required',
            'prix'=>'required|numeric'
        ]);
        $article = new Article();
        $article->code = $request->code;
        $article->libelle = $request->libelle;
        $article->description = $request->description;
        $article->prix = $request->prix;
        $article->categorie_id = $request->categorie_id;
        $article->save();
        return redirect('/articles')->with('message','Article creer avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('articles.lister');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $categories = CategorieArticle::all();
        if(!$article)
        {
            abort(404);
        }

        return view('articles.modifier')->with(['article'=>$article, 'categories' => $categories]);
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
        $this->validate($request, [
            'code'=>'required',
            'libelle'=>'required',
            'categorie_id'=>'required',
            'prix'=>'required|numeric'
        ]);
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
