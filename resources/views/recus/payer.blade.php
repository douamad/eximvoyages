@php($total_facture = 0)
@foreach($entree->articlesEntrees as $articlesEntree)
    @php($total = $articlesEntree->prix * $articlesEntree->unite)
    @php($total_facture += $total)
@endforeach
@php($tva = $entree->taxe * $total_facture /100)
@php($net_a_payer = $tva + $total_facture)
@php($recus = $entree->recus)
@php($totalRecu = 0)
@foreach($recus as $recu)
    @php($totalRecu += $recu->montant)
@endforeach
@extends('layouts.master')
@section('content')
    <!-- Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Ajouter Entree</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-wrap">
                                    <form action="{{ URL::to('/recus/'. $entree->id .'/payer') }}" method="post">
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
                                                            <label class="control-label mb-10" for="ref">Ref Entrees</label>
                                                            <input type="text" id="ref_entree" name="ref_entree" class="form-control" value="{{ $entree->ref }}">
                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="control-label mb-10" for="montant_facture">Montant à Payer</label>
                                                        <input type="text" id="montant_facture" name="montant_facture" class="form-control" value="{{ $net_a_payer }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="ref">Montant Reçu</label>
                                                            <input type="text" id="montant_recu" name="montant_recu" class="form-control" value="{{ $totalRecu }}">
                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="control-label mb-10" for="montant_restant">Montant Restant</label>
                                                        <input type="text" id="montant_restant" name="montant_restant" class="form-control" value="{{ $net_a_payer - $totalRecu}}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="ref">Ref Reçu</label>
                                                            <input type="text" id="ref" name="ref" class="form-control">

                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="control-label mb-10" for="date_entre">Date Reçu</label>
                                                        <div class="input-group date">
                                                            <input type="text" id="date_entre" name="date_recu" class="form-control">
                                                            <span class="input-group-addon">
																	<span class="fa fa-calendar"></span>
																</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                                <label class="control-label mb-10" for="montant">Montant Payé</label>
                                                            <input type="text" id="montant" name="montant" class="form-control">

                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="control-label mb-10" for="moyen_payement">Moyen Payement</label>
                                                        <select class="form-control" id="moyen_payement" name="moyen_payement">
                                                                <option value="cash">Cash</option>
                                                                <option value="transfert">Transfert</option>
                                                                <option value="cheque">Chéque</option>
                                                                <option value="virement">Virement Banquaire</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row moyen-payement moyen-cheque">
                                                    <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label mb-10" for="ref">Banque</label>
                                                                <input type="text" id="banque-cheque" name="banque_cheque" class="form-control">
                                                                <span class="help-block"> </span>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="control-label mb-10" for="date_entre">Numero Chéque</label>
                                                        <input type="text" id="code-cheque" name="code_cheque" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row moyen-payement moyen-virement">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="banque-virement">Banque</label>
                                                            <input type="text" id="banque-virement" name="banque_virement" class="form-control">
                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="control-label mb-10" for="code-virement">Code</label>
                                                        <input type="text" id="code-virement" name="code_virement" class="form-control">
                                                    </div>
                                                </div>


                                                <div class="row moyen-payement moyen-transfert">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="ref">Réseaux</label>
                                                            <select class="form-control" name="reseau_transfert">
                                                                <option value="cash">Wari</option>
                                                                <option value="transfert">Joni Joni</option>
                                                                <option value="cheque">Western Union</option>
                                                                <option value="virement">Autre</option>
                                                            </select>
                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="control-label mb-10" for="code-transfert">Code Transfert</label>
                                                        <input type="text" id="code-transfert" name="code_transfert" class="form-control">
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
    <script>

    </script>

    @push('script-footer')
    <!-- Moment JavaScript -->
    <script type="text/javascript" src="{{ asset('vendors/bower_components/moment/min/moment-with-locales.min.js') }}"></script>
    <!-- Bootstrap Colorpicker JavaScript -->
    <script type="text/javascript" src="{{ asset('vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- Bootstrap Datetimepicker JavaScript -->
    <script type="text/javascript" src="{{ asset('vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <!-- Bootstrap Daterangepicker JavaScript -->
    <script type="text/javascript" src="{{ asset('js/form-picker-data.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendors/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.moyen-payement').hide();
            $('#moyen_payement').change(function () {
                $('.moyen-payement').hide();
                let moyen = $(this).val();
                if(moyen === 'cheque')
                    $('.moyen-cheque').show();
                else if(moyen === 'transfert')
                    $('.moyen-transfert').show();
                else if(moyen === 'virement')
                    $('.moyen-virement').show();
            });

        });
    </script>
    @endpush
@endsection