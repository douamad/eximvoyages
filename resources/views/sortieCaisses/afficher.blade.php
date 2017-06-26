@extends('layouts.master')
@section('content')
    @php($total_sortie = 0)
    @php($sortieCaisses = $sortie->sortieCaisses)
    @php($moyen = '')
    @php($totalSortieCaisse = 0)
    @foreach($sortieCaisses as $sortieCaisse)
        @php($moyen = $sortieCaisse->moyen)
        @php($totalSortieCaisse += $sortieCaisse->montant)
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
                        <h6 class="txt-dark">Sortie #{{ $sortie->ref }}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body" style="background-image: url({{ asset('img/clean-exim-logo.jpg') }}); background-repeat: no-repeat; background-position: center;">
                        <div class="row">
                            <div class="col-xs-6">
                                <span class="txt-dark head-font inline-block capitalize-font mb-5">CLIENT:</span>
                                <address class="mb-15">
                                    <span class="address-head mb-5">{{ $sortie->client->prenom }} {{ $sortie->client->nom }}</span>
                                    Adresse: {{ $sortie->client->adresse }} <br>
                                    Email:  {{ $sortie->client->email }}<br>
                                    Tel: {{ $sortie->client->telephone }} <br>
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
                                    {{ $sortie->dates }}<br><br>
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
                                    @foreach($sortie->articlesSorties as $articlesSortie)
                                        @php($total = $articlesSortie->prix * $articlesSortie->unite)
                                        @php($total_sortie += $total)
                                    <tr>
                                        <td>{{ $articlesSortie->article->libelle }}</td>
                                        <td>{{ $articlesSortie->prix }}</td>
                                        <td>{{ $articlesSortie->unite }}</td>
                                        <td>{{ $total }}</td>
                                    </tr>
                                    @endforeach
                                    @php($tva = $sortie->taxe * $total_sortie / 100)
                                    <tr class="txt-dark">
                                        <td></td>
                                        <td></td>
                                        <td>Total Hors taxe</td>
                                        <td>{{ $total_sortie }}</td>
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
                                        <td>{{ $tva + $total_sortie  }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="pull-right">
                                <a href="{{ URL::to('/sortieCaisses/'. $sortie->id .'/payer') }}" class="btn btn-primary mr-10">
                                    Proceder au paiement
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