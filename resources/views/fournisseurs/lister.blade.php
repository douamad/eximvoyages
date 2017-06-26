@extends('layouts.master')
@section('content')
    {{ Session::get('message') }}

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Articles</h6>
                    </div>
                    <a href="{{ URL::to('/fournisseurs/ajouter') }}" class="pull-right btn btn-primary">Ajouter</a>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datable_1" class="table table-hover display  pb-30" >
                                    <thead>
                                    <tr>
                                        <th>Prenom/Sigle</th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Telephone</th>
                                        <th>Voir +</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Prenom/Sigle</th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Telephone</th>
                                        <th>Voir +</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($fournisseurs as $fournisseur)
                                            <tr>
                                                @if($fournisseur->type_client == 'personne')
                                                    <td>{{ $fournisseur->prenom }}</td>
                                                @else
                                                    <td>{{ $fournisseur->sigle }}</td>
                                                @endif
                                                <td>{{ $fournisseur->nom }}</td>
                                                <td>{{ $fournisseur->email }}</td>
                                                <td>{{ $fournisseur->telephone }}</td>
                                                <td><a class="btn btn-primary" href="{{ URL::to('/fournisseurs/'.$fournisseur->id .'/show') }}">Details</a></td>
                                                <td class="text-nowrap"><a href="{{ URL::to('/fournisseurs/'. $fournisseur->id .'/modifier') }}" class="mr-25" data-toggle="tooltip" data-original-title="Modifer"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> <a href="{{ URL::to('/fournisseurs/'. $fournisseur->id .'/supprimer') }}" data-toggle="tooltip" data-original-title="Supprimer"> <i class="fa fa-close text-danger"></i> </a> </td>
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