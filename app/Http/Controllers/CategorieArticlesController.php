<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategorieArticle;

class CategorieArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategorieArticle::all();
        return view('articles.categorie.lister')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.categorie.ajouter');
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
            'libelle'=>'required'
        ]);
        $categorie = new CategorieArticle();
        $categorie->code = $request->code;
        $categorie->libelle = $request->libelle;
        $categorie->description = $request->description;
        $categorie->save();
        return redirect('/articles/categorie')->with('message','Catégorie creer avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('articles.categorie.lister');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorie = CategorieArticle::find($id);
        if(!$categorie)
        {
            abort(404);
        }

        return view('articles.categorie.modifier')->with('categorie',$categorie);
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
            'libelle'=>'required'
        ]);
        $categorie = CategorieArticle::find($id);
        $categorie->code = $request->code;
        $categorie->libelle = $request->libelle;
        $categorie->description = $request->description;
        $categorie->save();
        return redirect('/articles/categorie')->with('message','Catégorie modifier avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorie = CategorieArticle::find($id);
        $categorie->delete();
        return redirect('/articles/categorie')->with('message','Catégorie modifier avec succés');
    }
}
