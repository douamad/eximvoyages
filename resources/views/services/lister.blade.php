@extends('layouts.master')
@section('content')
    {{ Session::get('message') }}

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Services</h6>
                    </div>
                    <a href="/services/ajouter" class="pull-right btn btn-primary">Ajouter</a>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datable_1" class="table table-hover display  pb-30" >
                                    <thead>
                                    <tr>
                                        <th>Code Service</th>
                                        <th>Libelle Service</th>
                                        <th>Categorie Service</th>
                                        <th>Voir +</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Code Service</th>
                                        <th>Libelle Service</th>
                                        <th>Categorie Service</th>
                                        <th>Voir +</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($services as $service)
                                            <tr>
                                                <td>{{ $service->code }}</td>
                                                <td>{{ $service->libelle }}</td>
                                                <th>{{ $service->categorie->libelle }}</th>
                                                <td><a class="btn btn-primary" href="/services/{{ $service->id }}/show">Details</a></td>
                                                <td class="text-nowrap"><a href="/services/{{ $service->id }}/modifier" class="mr-25" data-toggle="tooltip" data-original-title="Modifer"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> <a href="/services/{{ $service->id }}/supprimer" data-toggle="tooltip" data-original-title="Supprimer"> <i class="fa fa-close text-danger"></i> </a> </td>
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