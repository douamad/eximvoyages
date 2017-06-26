@extends('layouts.master')
@section('content')
    <!-- Row -->
    <div class="table-struct full-width full-height">
        <div class="table-cell vertical-align-middle">
            <div class="auth-form  ml-auto mr-auto no-float">
                <div class="panel panel-default card-view mb-0">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Ajouter Utilisateur</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-wrap">
                                        <form action="{{ URL::to('/users/ajouter') }}" method="post">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="civilite">Civilité</label>
                                                <div class="input-group">
                                                    <select class="form-control" name="civilite" id="civilite">
                                                        <option value="M">Monsieur</option>
                                                        <option value="Mme">Madame</option>
                                                        <option value="Mlle">Mademoiselle</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="prenom">Prénom</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" required="" id="prenom" name="prenom" placeholder="Prénom">
                                                    <div class="input-group-addon"><i class="icon-user"></i></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="nom">Nom</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" required="" id="nom" name="nom" placeholder="Nom">
                                                    <div class="input-group-addon"><i class="icon-user"></i></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="email">Adresse email</label>
                                                <div class="input-group ">
                                                    <input type="email" class="form-control" required="" id="email" name="email" placeholder="Adresse email">
                                                    <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="telephone">Télephone</label>
                                                <div class="input-group">
                                                    <input type="tel" class="form-control" required="" name="telephone" id="telephone" placeholder="Adresse email">
                                                    <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="adresse">Adresse</label>
                                                <div class="input-group">
                                                    <textarea name="adresse" id="adresse" rows="3" class="form-control" required="required"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="password">Mot de passe</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" required="" id="password" name="password" placeholder="Saisir Mot de passe">
                                                    <div class="input-group-addon"><i class="icon-lock"></i></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="role">Civilité</label>
                                                <div class="input-group mb-10">
                                                    <select class="form-control" name="role" id="role">
                                                        <option value="admin">admin</option>
                                                        <option value="editeur">editeur</option>
                                                        <option value="vendeur">vendeur</option>
                                                        <option value="comptable">comptable</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success btn-block">Ajouter</button>
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
    </div>
    <!-- /Row -->
@endsection