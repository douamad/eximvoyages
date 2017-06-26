<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\CategorieService;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('services.lister')->with('services', $services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategorieService::all();
        return view('services.ajouter')->with('categories', $categories);
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
        $services = new Service();
        $services->code = $request->code;
        $services->libelle = $request->libelle;
        $services->description = $request->description;
        $services->prix = $request->prix;
        $services->categorie_id = $request->categorie_id;
        $services->save();
        return redirect('/services')->with('message','Service créé avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('services.lister');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        $categories = CategorieService::all();
        if(!$service)
        {
            abort(404);
        }

        return view('services.modifier')->with(['service'=>$service, 'categories' => $categories]);
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
        $service = Service::find($id);
        $service->code = $request->code;
        $service->libelle = $request->libelle;
        $service->description = $request->description;
        $service->prix = $request->prix;
        $service->categorie_id = $request->categorie_id;
        $service->save();
        return redirect('/services')->with('message','Service modifier avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();
        return redirect('/services/categorie')->with('message','Service modifier avec succés');
    }
}
