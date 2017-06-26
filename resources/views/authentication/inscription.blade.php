@extends('layouts.master0')
@section('content')
    <!-- Row -->
    <div class="table-struct full-width full-height">
        <div class="table-cell vertical-align-middle">
            <div class="auth-form  ml-auto mr-auto no-float">
                <div class="panel panel-default card-view mb-0">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">sign up</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-wrap">
                                        <form action="{{ URL::to('/inscription') }} " method="post">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="prenom">Prénom</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" required="" id="prenom" placeholder="Prénom">
                                                    <div class="input-group-addon"><i class="icon-user"></i></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="Nom">Nom</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" required="" id="Nom" placeholder="Nom">
                                                    <div class="input-group-addon"><i class="icon-user"></i></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="email">Adresse email</label>
                                                <div class="input-group">
                                                    <input type="email" class="form-control" required="" id="email" placeholder="Adresse email">
                                                    <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="password">Mot de passe</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" required="" id="password" placeholder="Saisir Mot de passe">
                                                    <div class="input-group-addon"><i class="icon-lock"></i></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="confirmpasssword">Confirmer Mot de passe</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" required="" id="confirmpasssword" placeholder="Confirmer Mot de passe">
                                                    <div class="input-group-addon"><i class="icon-lock"></i></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success btn-block">S'inscrire</button>
                                            </div>
                                            <div class="form-group mb-0">
                                                <span class="inline-block pr-5">J'ai déja un compte</span>
                                                <a class="inline-block txt-danger" href="{{ URL::to('/login') }}">Se connecter</a>
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