@php($total_entrees = 0)
@php($total_sorties = 0)
@php($total_entrees_recu = 0)
@php($total_sortiCaisse  = 0)
@php($total_sorties_sortieCaisse = 0)
@php($total_sortie = 0)
@php($total_entrees_tab = array())
@php($total_entree_article = array())
@php($total_sortie_article = array())
@php($total_entree_client = array())
@php($total_entree_client_nom = array())
@php($total_sortie_fournisseur = array())
@php($total_entree_recu_tab = array())
@php($total_sortie_caisse_tab = array())
@php($total_entree_client_recu = array())
@php($total_sortie_fournisseur_recu = array())
@php($total_entree_day = [0,0,0,0,0,0,0])
@php($total_entree_month = [0,0,0,0,0,0,0,0,0,0,0,0])
@php($total_sortie_day = [0,0,0,0,0,0,0])
@php($total_sortie_month = [0,0,0,0,0,0,0,0,0,0,0,0])

@php($jours = ['dimanche','lundi','mardi','mercredi','jeudi','vendredi','samedi'])
@php($mois = ['janvier','fevrier','mars','avril','mai','juin','juillet','aout','septembre','octobre','novembre','decembre'])
@php($td = \Carbon\Carbon::now())
@foreach($entrees as $entree)
    {{--{{ $entree->ref }}, taxe : {{ $entree->taxe }} <br />--}}
    @php($total_article_entree = 0)
    @php($total_recu = 0)
    @foreach($entree->articlesEntrees as $article_entree)
        @php($article_entree_brut = $article_entree->prix * $article_entree->unite)
        @php($article_entree_tva = $article_entree_brut + ($article_entree_brut * $entree->taxe / 100))
        {{---- {{ $article_entree->article->libelle }} => ht: {{ $article_entree_brut    }} tt: {{ $article_entree_tva }}<br />--}}
        @if(isset($total_entree_article[$article_entree->article->libelle]))
            @php($total_entree_article[$article_entree->article->libelle] += $article_entree_tva)
        @else
            @php($total_entree_article[$article_entree->article->libelle] = $article_entree_tva)
        @endif
        @php($total_article_entree += $article_entree_tva)
    @endforeach
    @foreach($entree->recus as $recu)
        @php($total_recu += $recu->montant)
    @endforeach
    @php($total_entree_recu_tab[$entree->ref] = $total_recu)
    @php($total_entrees_tab[$entree->ref] = $total_article_entree)
    @php($date_entree = Carbon\Carbon::parse($entree->dates))
    @if($date_entree->weekOfYear == $td->weekOfYear)
        @php($total_entree_day[$date_entree->dayOfWeek] += $total_article_entree)
    @endif
    @php($total_entree_month[$date_entree->month - 1] += $total_article_entree)
    @if(isset($total_entree_client['client_'.  $entree->client->id]))
        @php($total_entree_client['client_'.  $entree->client->id] += $total_article_entree)
    @else
        @php($total_entree_client['client_'. $entree->client->id] = $total_article_entree)
        @php($total_entree_client_nom['client_'.  $entree->client->id] = $entree->client->prenom.' '.$entree->client->nom)
    @endif
    @php($total_entrees += $total_article_entree)
    @php($total_entrees_recu += $total_recu)
@endforeach
@foreach($sorties as $sortie)
    {{--{{ $sortie->ref }}, taxe : {{ $sortie->taxe }} <br />--}}
    @php($total_article_sortie = 0)
    @php($total_recu = 0)
    @foreach($sortie->articlesSorties as $article_sortie)
        @php($article_sortie_brut = $article_sortie->prix * $article_sortie->unite)
        @php($article_sortie_tva = $article_sortie_brut + ($article_sortie_brut * $sortie->taxe / 100))
        {{---- {{ $article_entree->article->libelle }} => ht: {{ $article_sortie_brut    }} tt: {{ $article_sortie_tva }}<br />--}}
        @if(isset($total_sortie_article[$article_sortie->article->libelle]))
            @php($total_sortie_article[$article_sortie->article->libelle] += $article_sortie_tva)
        @else
            @php($total_sortie_article[$article_sortie->article->libelle] = $article_sortie_tva)
        @endif
        @php($total_article_sortie += $article_sortie_tva)
    @endforeach
    @foreach($sortie->sortieCaisses as $sortieCaiss)
        @php($total_sortiCaisse += $sortieCaiss->montant)
    @endforeach
    @php($total_sortie_caisse_tab[$sortie->ref] = $total_sortiCaisse)
    @php($total_sorties_tab[$sortie->ref] = $total_article_entree)
    @php($date_sortie = Carbon\Carbon::parse($sortie->dates))
    @if($date_entree->weekOfYear == $td->weekOfYear)
        @php($total_sortie_day[$date_sortie->dayOfWeek] += $total_article_sortie)
    @endif
    @php($total_sortie_month[$date_sortie->month - 1] += $total_article_sortie)
    @if(isset($total_sortie_client['client_'.  $sortie->fournisseur->id]))
        @php($total_sortie_client['client_'.  $sortie->fournisseur->id] += $total_article_sortie)
    @else
        @php($total_sortie_client['client_'. $sortie->fournisseur->id] = $total_article_sortie)
    @endif
    @php($total_sorties += $total_article_sortie)
    @php($total_sorties_sortieCaisse += $total_sortiCaisse)
@endforeach
