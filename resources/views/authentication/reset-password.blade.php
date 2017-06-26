@extends('layouts.master0')
@section('content')
    <!-- Row -->
    <div class="table-struct full-width full-height">
        <div class="table-cell vertical-align-middle">
            <div class="auth-form  ml-auto mr-auto no-float">
                <div class="panel panel-default card-view mb-0">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">reset password</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-wrap">
                                        <form action="/changer-mot-de-passe">
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="old_password">Ancien mot de passe</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" required="" id="old_password" placeholder="Saisir ancien mot de passe">
                                                    <div class="input-group-addon"><i class="icon-lock"></i></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="password">Nouveau mot de passe</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" required="" id="password" placeholder="Saisir nouveau mot de passe">
                                                    <div class="input-group-addon"><i class="icon-lock"></i></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="confirmpassword">Nouveau mot de passe</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" required="" id="confirmpassword" placeholder="Saisir nouveau mot de passe">
                                                    <div class="input-group-addon"><i class="icon-lock"></i></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success btn-block">Reset</button>
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