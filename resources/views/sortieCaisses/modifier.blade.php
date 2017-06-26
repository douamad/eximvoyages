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
                                    <form action="{{ URL::to('/articles/'. $article->id .'/modifier') }}" method="post">
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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="code">Code Article</label>
                                                        <input type="text" id="code" name="code" class="form-control" value="{{ $article->code }}" placeholder="Code Article">
                                                        <span class="help-block"> </span>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="libelle">Libelle Article</label>
                                                        <input type="text" id="libelle" name="libelle" class="form-control" value="{{ $article->libelle }}" placeholder="Libelle Article">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!-- /Row -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="categorie">Catégorie Article</label>
                                                        <select name="categorie_id" id="categorie" class="form-control">
                                                            @foreach($categories as $categorie)
                                                                <option value="{{ $categorie->id }}" {{ ($article->categorie_id == $categorie->id)?'selected':'' }}> {{ $categorie->libelle }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="prix">Prix unitaire</label>
                                                        <input type="number" id="prix" name="prix" class="form-control" value="{{ $article->prix }}" placeholder="Prix de l'article">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- /Row -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="description">Description Article</label>
                                                        <textarea name="description" id="description" class="form-control"> {{ $article->description }}</textarea>
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