@extends('layouts.master')
@section('content')
    <!-- Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Modifier Client</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-wrap">
                                    <form action="{{ URL::to('/clients/ajouter') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-body">
                                            @if(count($errors) > 0)
                                                @foreach ($errors->all() as $error )
                                                    <div class="alert alert-danger alert-dismissable">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        <i class="ti-na pr-15"></i>{{ $error }}
                                                    </div>
                                                @endforeach
                                            @endif
                                            <h6 class="txt-dark capitalize-font"><i class="icon-action-redo mr-10"></i>Rensseignez les champs si dessous</h6>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="prenom">Prenom Client</label>
                                                        <div class="radio-list">
                                                            <div class="radio-inline pl-0">
                                                                    <span class="radio radio-info">
                                                                        <input type="radio" name="type_client" id="personne" value="personne" @if($client->type_client == 'personne') checked="checked" @endif>
                                                                        <label for="personne">Personne</label>
                                                                    </span>
                                                            </div>
                                                            <div class="radio-inline">
                                                                    <span class="radio radio-info">
                                                                        <input type="radio" name="type_client" id="societe" value="societe" @if($client->type_client == 'societe') checked="checked" @endif>
                                                                        <label for="societe">Societé</label>
                                                                    </span>
                                                            </div>
                                                        </div>
                                                        <span class="help-block"> </span>
                                                    </div>
                                                </div>
                                                <!--/span-->

                                                <!--/span-->
                                            </div>
                                            <!-- /Row -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="prenom">Prenom Client</label>
                                                        <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Prenom Client" value="{{ $client->prenom }}">
                                                        <span class="help-block"> </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" style="display: none">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="sigle">Sigle Client</label>
                                                        <input type="text" id="sigle" name="sigle" class="form-control" placeholder="Sigle Client" value="{{ $client->sigle }}">
                                                        <span class="help-block"> </span>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="nom">Nom Client</label>
                                                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom client" value="{{ $client->nom }}">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="email">Email Client</label>
                                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email Client" value="{{ $client->email }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="telephone">Telephone Client</label>
                                                        <input type="text" id="telephone" name="telephone" class="form-control" placeholder="Telephone Client" value="{{ $client->telephone }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- /Row -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="adresse">Adresse Client</label>
                                                        <textarea name="adresse" id="adresse" class="form-control">{{ $client->adresse }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="seprator-block"></div>

                                        </div>
                                        <div class="form-actions mt-10">
                                            <button type="submit" class="btn btn-success  mr-10"> Enregistrer</button>
                                            <button type="button" class="btn btn-default">Annuler</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->
@endsection