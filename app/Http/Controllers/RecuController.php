<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Entree;
use App\Recu;
use App\RecuCheque;
use App\RecuTransfert;
use App\RecuVirement;
use Sentinel;

class RecuController extends Controller
{
    public function index($id)
    {
        $entree = Entree::find($id);
        return view('recus.lister')->with('entree', $entree);
    }

    public function create($id)
    {
        $entree = Entree::find($id);
        return view('recus.payer')->with('entree', $entree);
    }

    public function store($id, Request $request)
    {
        //dd($request);
        $entree = Entree::find($id);
        $user = Sentinel::check();
        $recu = new Recu();
        $recu->ref = $request->ref;
        $recu->piece = $request->piece;
        $recu->complement = $request->complement;
        $recu->date_recu = Carbon::createFromFormat('d/m/Y', $request->date_recu);
        $recu->moyen = $request->moyen_payement;
        $recu->montant = $request->montant;
        $recu->entree_id = $id;
        $recu->user_id = $user->id;
        $recu->save();
        if($request->moyen_payement == 'transfert')
        {
            $recu_transfert = new RecuTransfert();
            $recu_transfert->reseau = $request->reseau_transfert;
            $recu_transfert->code = $request->code_transfert;
            $recu_transfert->montant = $request->montant;
            $recu_transfert->encaisser = true;
            $recu_transfert->recu_id = $recu->id;
            $recu_transfert->save();
        }
        if($request->moyen_payement == 'cheque')
        {
            $recu_cheque = new RecuCheque();
            $recu_cheque->banque = $request->banque_cheque;
            $recu_cheque->code = $request->code_cheque;
            $recu_cheque->montant = $request->montant;
            $recu_cheque->recu_id = $recu->id;
            $recu_cheque->encaisser = true;
            $recu_cheque->save();
        }
        if($request->moyen_payement == 'virement')
        {
            $recu_virement = new RecuTransfert();
            $recu_virement->banque = $request->banque_virement;
            $recu_virement->montant = $request->montant;
            $recu_virement->code = $request->code_virement;
            $recu_virement->recu_id = $recu->id;
            $recu_virement->encaisser = true;
            $recu_virement->save();

        }

        return redirect('/entrees/'.$id.'/show');

    }
}
