@php($recus = $entree->recus)
@php($totalRecu = 0)
@php($total_facture = 0)
@foreach($entree->articlesEntrees as $articlesEntree)
    @php($total = $articlesEntree->prix * $articlesEntree->unite)
    @php($total_facture += $total)
@endforeach
@php($tva = $entree->taxe * $total_facture /100)
@php($net_a_payer = $tva + $total_facture)
@extends('layouts.master')
@section('content')
    {{ Session::get('message') }}

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Entrées</h6>
                    </div>
                    <a href="{{ URL::to('/recus/'. $entree->id .'/payer') }}" class="pull-right btn btn-primary">Ajouter</a>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datable_1" class="table table-hover display  pb-30" >
                                    <thead>
                                    <tr>
                                        <th>Ref Reçu</th>
                                        <th>Montant</th>
                                        <th>Moyen</th>
                                        <th>Date</th>
                                        <th>Voir +</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Ref Reçu</th>
                                        <th>Montant</th>
                                        <th>Moyen</th>
                                        <th>Date</th>
                                        <th>Voir +</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($recus as $recu)
                                            @php($totalRecu += $recu->montant)
                                            <tr>
                                                <td>{{ $recu->ref }}</td>
                                                <td>{{ $recu->montant }}</td>
                                                <th>{{ $recu->moyen }}</th>
                                                <th>{{ $recu->date_recu }}</th>
                                                <td><a class="btn btn-primary" href="{{ URL::to('/recus/'. $recu->id .'/detail') }}">Details</a></td>
                                                <td class="text-nowrap"><a href="{{ URL::to('/recus/'. $recu->id .'/modifier') }}" class="mr-25" data-toggle="tooltip" data-original-title="Modifer"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> <a href="{{ URL::to('/enrees/'. $entree->id .'/supprimer') }}" data-toggle="tooltip" data-original-title="Supprimer"> <i class="fa fa-close text-danger"></i> </a> </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <a href="{{ URL::to('/recus/'. $entree->id ) }}" class="btn btn-success mr-10">
                                    {{ $totalRecu }} Reçu
                                </a>
                                <button type="button" class="btn btn-warning mr-10">
                                    {{ $net_a_payer - $totalRecu }} Restant
                                </button>
                                <a href="{{ URL::to('/recus/'. $entree->id .'/payer') }}" class="btn btn-primary mr-10">
                                    Payer Facture
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection