@extends('layouts.master')
@section('content')
    <!-- Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Modifier Utilisateur</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-wrap">
                                    <form action="{{ URL::to('/users/'. $user->id .'/modifier') }}" method="post">
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
                                                        <label class="control-label mb-10" for="prenom">Prenom </label>
                                                        <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Prenom " value="{{ $user->prenom }}">
                                                        <span class="help-block"> </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" style="display: none">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="sigle">Sigle </label>
                                                        <input type="text" id="sigle" name="sigle" class="form-control" placeholder="Sigle " value="{{ $user->sigle }}">
                                                        <span class="help-block"> </span>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="nom">Nom </label>
                                                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom user" value="{{ $user->nom }}">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="email">Email </label>
                                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email " value="{{ $user->email }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="telephone">Telephone </label>
                                                        <input type="text" id="telephone" name="telephone" class="form-control" placeholder="Telephone " value="{{ $user->telephone }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- /Row -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="adresse">Adresse </label>
                                                        <textarea name="adresse" id="adresse" class="form-control">{{ $user->adresse }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="telephone">Roles  </label>
                                                        <br />
                                                        @php($roles_user = [])
                                                        @foreach($user->getRoles() as $value)
                                                            @php($role_user = json_decode($value, true))
                                                            @php(array_push($roles_user, $role_user['slug']))
                                                            <div class="checkbox-inline pl-0">
                                                                <span class="checkbox checkbox-info">
                                                                    <input checked type="checkbox" name="roles[]" id="role_{{ $role_user['slug'] }}" value="{{ $role_user['slug'] }}">
                                                                    <label for="role_{{ $role_user['slug'] }}">{{ $role_user['name'] }}</label>
                                                                </span>
                                                            </div>
                                                        @endforeach
                                                        @foreach($roles as $role)
                                                            @if(!in_array($role->slug, $roles_user))
                                                                <div class="checkbox-inline pl-0">
                                                                <span class="checkbox checkbox-info">
                                                                    <input type="checkbox" name="roles[]" id="role_{{ $role['slug'] }}" value="{{ $role['slug'] }}">
                                                                    <label for="role_{{ $role['slug'] }}">{{ $role['name'] }}</label>
                                                                </span>
                                                                </div>
                                                            @endif
                                                        @endforeach
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