<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Sortie;
use App\SortieCaisse;

use Sentinel;
class SortieCaissesController extends Controller
{
    public function index($id)
    {
        $sortie = Sortie::find($id);
        return view('sortieCaisses.lister')->with('sortie', $sortie);
    }

    public function create($id)
    {
        $sortie = Sortie::find($id);
        return view('sortieCaisses.payer')->with('sortie', $sortie);
    }

    public function store($id, Request $request)
    {
        //dd($request);
        $sortie = Sortie::find($id);
        $user = Sentinel::check();
        $sortieCaisse = new SortieCaisse();
        $sortieCaisse->ref = $request->ref;
        $sortieCaisse->piece = $request->piece;
        $sortieCaisse->complement = $request->complement;
        $sortieCaisse->date_facture = Carbon::createFromFormat('d/m/Y', $request->date_sortieCaisse);
        $sortieCaisse->moyen = $request->moyen_payement;
        $sortieCaisse->montant = $request->montant;
        $sortieCaisse->sortie_id = $id;
        $sortieCaisse->user_id = $user->id;
        $sortieCaisse->save();

        return redirect('/sorties/'.$id.'/show');

    }
}
