@extends('layouts.master')
@section('content')
    <!-- Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Modifier Categorie</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-wrap">
                                    <form action="{{ URL::to('/articles/categorie/'.$categorie->id .'/modifier') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-body">
                                            <h6 class="txt-dark capitalize-font"><i class="icon-action-redo mr-10"></i>Rensseignez les champs si dessous</h6>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="code">Code Categorie</label>
                                                        <input type="text" id="code" name="code" class="form-control" value="{{ $categorie->code }}" placeholder="Code Categorie">
                                                        <span class="help-block"> This is inline help </span>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="libelle">Libelle Categorie</label>
                                                        <input type="text" id="libelle" name="libelle" class="form-control"value="{{ $categorie->libelle }}" placeholder="Libelle Categorie">
                                                        <span class="help-block"> This field has error. </span>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!-- /Row -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="description">Gender</label>
                                                        <textarea name="description" class="form-control">{{ $categorie->description }}</textarea>
                                                        <span class="help-block"> Select your gender </span>
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