@extends('layouts.master')
@section('content')
    @php($total_entree = 0)
    @php($recus = $entree->recus)
    @php($moyen = '')
    @php($totalRecu = 0)
    @foreach($recus as $recu)
        @php($moyen = $recu->moyen)
        @php($totalRecu += $recu->montant)
    @endforeach
    <!-- Row -->
    <div class="row ">
        <div class="col-md-12">
            <div class="panel panel-default card-view ">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Facture</h6>
                    </div>
                    <div class="pull-right">
                        <h6 class="txt-dark">Entree #{{ $entree->ref }}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body" style="background-image: url({{ asset('img/clean-exim-logo.jpg') }}); background-repeat: no-repeat; background-position: center;">
                        <div class="row">
                            <div class="col-xs-6">
                                <span class="txt-dark head-font inline-block capitalize-font mb-5">CLIENT:</span>
                                <address class="mb-15">
                                    <span class="address-head mb-5">{{ $entree->client->prenom }} {{ $entree->client->nom }}</span>
                                    Adresse: {{ $entree->client->adresse }} <br>
                                    Email:  {{ $entree->client->email }}<br>
                                    Tel: {{ $entree->client->telephone }} <br>
                                </address>
                            </div>
                            <div class="col-xs-6 text-right">
                                <span class="txt-dark head-font inline-block capitalize-font mb-5">FOURNISSEUR:</span>
                                <address class="mb-15">
                                    <span class="address-head mb-5">Exim Voyages</span>
                                    Adresse: 38 Av Lamine Gueye Dakar - Sénégal <br>
                                    Email: contact@eximvoyages.com <br />
                                    Fax: (+221) 33 823 23 78
                                    Tel: (+221) 33 823 23 14

                                </address>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <address>
                                    <span class="txt-dark head-font capitalize-font mb-5">Moyen Payement:</span>
                                    <br>
                                    {{ $moyen }}
                                </address>
                            </div>
                            <div class="col-xs-6 text-right">
                                <address>
                                    <span class="txt-dark head-font capitalize-font mb-5">Date Facture:</span><br>
                                    {{ $entree->dates }}<br><br>
                                </address>
                            </div>
                        </div>

                        <div class="seprator-block"></div>

                        <div class="invoice-bill-table">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Prix</th>
                                        <th>Quantité</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($entree->articlesEntrees as $articlesEntree)
                                        @php($total = $articlesEntree->prix * $articlesEntree->unite)
                                        @php($total_entree += $total)
                                    <tr>
                                        <td>{{ $articlesEntree->article->libelle }}</td>
                                        <td>{{ $articlesEntree->prix }}</td>
                                        <td>{{ $articlesEntree->unite }}</td>
                                        <td>{{ $total }}</td>
                                    </tr>
                                    @endforeach
                                    @php($tva = $entree->taxe * $total_entree / 100)
                                    <tr class="txt-dark">
                                        <td></td>
                                        <td></td>
                                        <td>Total Hors taxe</td>
                                        <td>{{ $total_entree }}</td>
                                    </tr>
                                    <tr class="txt-dark">
                                        <td></td>
                                        <td></td>
                                        <td>TVA</td>
                                        <td>{{ $tva  }}</td>
                                    </tr>
                                    <tr class="txt-dark">
                                        <td></td>
                                        <td></td>
                                        <td>Total Net</td>
                                        <td>{{ $tva + $total_entree  }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="pull-right">
                                <a href="{{ URL::to('/recus/'. $entree->id ) }}" class="btn btn-success mr-10">
                                    {{ $totalRecu }} Reçu
                                </a>
                                <button type="button" class="btn btn-warning mr-10">
                                    {{ ($tva + $total_entree) - $totalRecu }} Restant
                                </button>
                                <a href="{{ URL::to('/recus/'. $entree->id .'/payer') }}" class="btn btn-primary mr-10">
                                    Payer Facture
                                </a>
                                <button type="button" class="btn btn-success btn-outline btn-icon left-icon" onclick="javascript:window.print();">
                                    <i class="fa fa-print"></i><span> Imprimer</span>
                                </button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->
@endsection