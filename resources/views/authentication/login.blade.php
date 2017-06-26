@extends('layouts.master0')
@section('content')
    <!-- Row -->
    <div class="table-struct full-width full-height">
        <div class="table-cell vertical-align-middle">
            <div class="auth-form  ml-auto mr-auto no-float">
                <div class="panel panel-default card-view mb-0">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Connexion</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    @if(isset($message) && $message !== '')
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <i class="ti-na pr-15"></i>{{ $message }}
                                    </div>
                                    @endif
                                    <div class="form-wrap">
                                        <form action="{{ URL::to('/login') }}" method="post">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="email">Adresse Email</label>
                                                <div class="input-group">
                                                    <input type="email" class="form-control" required="" id="email" name="email" placeholder="Enter email">
                                                    <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="password">Mot de passe</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" required="" name="password" id="password" placeholder="Saisir Mot de passe">
                                                    <div class="input-group-addon"><i class="icon-lock"></i></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="checkbox checkbox-success pr-10 pull-left">
                                                    <input id="checkbox_2" type="checkbox">
                                                    <label for="checkbox_2"> Rester Connecté </label>
                                                </div>
                                                <a class="capitalize-font txt-danger block pt-5 pull-right" href="#">Mot de passe oublié</a>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success btn-block">Se Connecter</button>
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