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
                    <a href="{{ URL::to('/entrees/ajouter') }}" class="pull-right btn btn-primary">Ajouter</a>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datable_1" class="table table-hover display  pb-30" >
                                    <thead>
                                    <tr>
                                        <th>Ref Entree</th>
                                        <th>Client</th>
                                        <th>Montant Total</th>
                                        <th>Somme Payer</th>
                                        <th>Date</th>
                                        <th>Voir +</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Ref Entree</th>
                                        <th>Client</th>
                                        <th>Montant Total</th>
                                        <th>Somme Payer</th>
                                        <th>Date</th>
                                        <th>Voir +</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($entrees as $entree)
                                            @php($totalArticle = 0)
                                            @foreach($entree->articlesEntrees as $article )
                                                @php($totalArticle += $article->unite * $article->prix)
                                            @endforeach
                                            <tr>
                                                <td>{{ $entree->ref }}</td>
                                                <td>{{ $entree->client->prenom }} {{ $entree->client->nom }}</td>
                                                <th>{{ $totalArticle }}</th>
                                                <th>{{ $entree->payer }}</th>
                                                <th>{{ $entree->dates }}</th>
                                                <td><a class="btn btn-primary" href="{{ URL::to('/entrees/'.$entree->id .'/show') }}">Details</a></td>
                                                <td class="text-nowrap"><a href="{{ URL::to('/entrees/'. $entree->id .'/modifier') }}" class="mr-25" data-toggle="tooltip" data-original-title="Modifer"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> <a href="{{ URL::to('/enrees/'. $entree->id .'/supprimer') }}" data-toggle="tooltip" data-original-title="Supprimer"> <i class="fa fa-close text-danger"></i> </a> </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection