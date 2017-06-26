<?php

namespace App\Http\Controllers;

use App\Article;
use App\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Billet;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use App\Trajet;
use Sentinel;
use App\Entree;
use App\ArticleEntree;

class BilletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billets = Billet::all()->where('montant_recu', '<=', 0);
        return view('billets.lister')->with('billets',$billets);
    }

    public function load()
    {

        $retour = array();
        try {

            $client = new GuzzleHttpClient();

            $apiRequest = $client->request('POST', 'http://localhost:8001/eximvoyages/checkmail.php');

            $content = json_decode($apiRequest->getBody()->getContents());
            if(is_object($content))
            {
                $nb_billet = $content->nb_billets;
                $retour['nb_billet'] = $nb_billet;
                $retour['resultat'] = "ok";
                $billets = $content->billets;
                $trajets_tabs = (array) $content->billet_trajets;
                $mes_billet = array();
                foreach ($billets as $billet)
                {
                    $new_billet = new Billet();
                    $new_billet->numero_billet = $billet->numero_billet;
                    $new_billet->nom_psg = $billet->nom_psg;
                    $new_billet->prenom_psg = $billet->prenom_psg;
                    $new_billet->civilite_psg = $billet->civilite_psg;
                    $new_billet->code_iata = $billet->code_iata;
                    $new_billet->nom_comp = $billet->nom_comp;
                    $new_billet->ref_dossier = $billet->ref_dossier;
                    $new_billet->prix_htt = $this->int($billet->prix_htt) ;
                    $new_billet->prix_ttc = $this->int($billet->prix_ttc);
                    $new_billet->date_billet = Carbon::parse($billet->date_billet);
                    if ($new_billet->save())
                    {
                        $trajet_billets = $trajets_tabs[$billet->numero_billet];
                        $billet_id = $new_billet->id;
                        foreach ($trajet_billets as $trajet_billet)
                        {
                            $trajet = new Trajet();
                            $trajet->lieu_depart = $trajet_billet->lieu_depart;
                            $trajet->heure_depart = $trajet_billet->heure_depart;
                            $trajet->date_depart = $trajet_billet->date_depart;
                            $trajet->vol_depart = $trajet_billet->vol_depart;
                            $trajet->statut = $trajet_billet->statut;
                            $trajet->heure_arr = $trajet_billet->heure_arr;
                            $trajet->lieu_arr = $trajet_billet->lieu_arr;
                            $trajet->billet_id = $billet_id;
                            $trajet->save();
                            //array_push($mes_billet, $trajet);
                        }
                    }



                }
                //dd($mes_billet);
            }
            else{
                dd($content);
                $retour['nb_billet'] = 0;
                $retour['resultat'] = "ok1";
            }

        } catch (RequestException $re) {
            $retour['nb_billet'] = 0;
            $retour['resultat'] = "ko";
        }
        return json_encode($retour);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $billet = Billet::find($id);
        return view('billets.ajouter')->with('billet',$billet);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $new_billet = Billet::find($id);
        $new_billet->numero_billet = $request->numero_billet;
        $new_billet->nom_psg = $request->nom_psg;
        $new_billet->prenom_psg = $request->prenom_psg;
        $new_billet->civilite_psg = $request->civilite_psg;
        $new_billet->code_iata = $request->code_iata;
        $new_billet->nom_comp = $request->nom_comp;
        $new_billet->ref_dossier = $request->ref_dossier;
        $new_billet->prix_htt = $this->int($request->prix_htt) ;
        $new_billet->prix_ttc = $this->int($request->prix_ttc);
        $new_billet->commission = $this->int($request->commission);
        $new_billet->frais_service = $this->int($request->frais_service);
        $new_billet->net_a_payer = $this->int($request->net_a_payer);
        $new_billet->montant_recu = $this->int($request->montant_recu);
        $new_billet->date_billet = Carbon::createFromFormat('d/m/Y', $request->date_billet);
        if($new_billet->save()){
            $client = new Client();
            $client->nom = $new_billet->nom_psg;
            $client->prenom = $new_billet->prenom_psg;
            $client_id = 1;
            if($client->save())
            {
                $client_id = $client->id;
            }
            $user = Sentinel::check();
            $entree = new Entree();
            $now = Carbon::now();
            $entree->ref = "B_".$now->dayOfYear. "_" .$now->hour. "_" .$now->minute. "_" .$now->second;
            $entree->piece = "billet";
            $entree->complement = "billet";
            $entree->dates = $new_billet->date_billet;
            $entree->taxe = 1 ;
            $entree->settaxe = 0;
            $entree->regler = 1;
            $entree->payer = 1;
            $entree->client_id = $client_id;
            $entree->user_id = $user->id;
            if($entree->save())
            {
                $entree_id =  $entree->id;
                $articleEntree = new ArticleEntree();
                $articleEntree->entree_id = $entree_id;
                $articleEntree->article_id = 1;
                $articleEntree->unite = 1;
                $articleEntree->prix = $new_billet->net_a_payer;
                $articleEntree->save();
            }
        }
        redirect('/billets')->with('message', 'Billet enregistrer avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function int($s){return(int)preg_replace('/[^\-\d]*(\-?\d*).*/','$1',$s);}
}
