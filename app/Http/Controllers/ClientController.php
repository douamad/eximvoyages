<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.lister')->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.ajouter');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $client = new Client();
        if($request->type_client == 'personne')
        {
            $client->prenom = $request->prenom;
            $client->sigle = '';
        }
        else{
            $client->prenom = '';
            $client->sigle = $request->sigle;;
        }
        $client->nom = $request->nom;
        $client->adresse = $request->adresse;
        $client->telephone = $request->telephone;
        $client->email = $request->email;
        $client->type_client = $request->type_client;
        $client->save();
        return redirect('/clients')->with('message','Client creer avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('client.lister');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        if(!$client)
        {
            abort(404);
        }

        return view('clients.modifier')->with(['client'=>$client]);
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
        $client = Client::find($id);
        $client->nom = $request->nom;
        $client->prenom = $request->prenom;
        $client->sigle = $request->sigle;
        $client->adresse = $request->adresse;
        $client->telephone = $request->telephone;
        $client->email = $request->email;
        $client->type_client = $request->type_client;
        $client->save();
        return redirect('/clients')->with('message','Client modifier avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect('/clients')->with('message','Client supprimer avec succés');
    }
}
