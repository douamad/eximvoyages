<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategorieService;

class CategorieServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategorieService::all();
        return view('services.categorie.lister')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.categorie.ajouter');
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
        $categorie = new CategorieService();
        $categorie->code = $request->code;
        $categorie->libelle = $request->libelle;
        $categorie->description = $request->description;
        $categorie->save();
        return redirect('/services/categories')->with('message','Catégorie creer avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('services.categorie.lister');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorie = CategorieService::find($id);
        if(!$categorie)
        {
            abort(404);
        }

        return view('services.categorie.modifier')->with('categorie',$categorie);
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
        $categorie = CategorieService::find($id);
        $categorie->code = $request->code;
        $categorie->libelle = $request->libelle;
        $categorie->description = $request->description;
        $categorie->save();
        return redirect('/services/categories')->with('message','Catégorie modifier avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorie = CategorieService::find($id);
        $categorie->delete();
        return redirect('/services/categories')->with('message','Catégorie modifier avec succés');
    }
}
