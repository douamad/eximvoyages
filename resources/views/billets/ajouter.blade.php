@extends('layouts.master')
@section('content')
    <!-- Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Ajouter Billet</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-wrap">
                                    <form action="{{ URL::to('/billets/' .$billet->id. '/payer') }}" method="post">
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
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="numero_billet">Numero Billet</label>
                                                            <input type="text" id="numero_billet" name="numero_billet" value="{{ $billet->numero_billet }}" class="form-control" placeholder="Numero Billet">
                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="civilite_psg">Civilite Passager</label>
                                                            <input type="text" id="civilite_psg" name="civilite_psg" value="{{ $billet->civilite_psg }}" class="form-control" placeholder="Civilite Passager">
                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="prenom_psg">Prénom passager</label>
                                                            <input type="text" id="prenom_psg" name="prenom_psg" value="{{ $billet->prenom_psg }}" class="form-control" placeholder="Prénom passager">
                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="nom_psg">Nom Passager</label>
                                                            <input type="text" id="nom_psg" name="nom_psg" class="form-control" placeholder="Nom Passager" value="{{ $billet->nom_psg }}">
                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="code_iata">Code Iata Passager</label>
                                                            <input type="text" id="code_iata" name="code_iata" value="{{ $billet->code_iata }}" class="form-control" placeholder="Code Iata Passager">
                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="nom_comp">Nom Compagnie</label>
                                                            <input type="text" id="nom_comp" name="nom_comp" value="{{ $billet->nom_comp }}" class="form-control" placeholder="Nom Compagnie">
                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="ref_dossier">Reference Dossier</label>
                                                            <input type="text" id="ref_dossier" name="ref_dossier" class="form-control" placeholder="Reference Dossier" value="{{ $billet->ref_dossier }}">
                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="date_billet">Date Billet</label>
                                                            <input type="hidden" id="date_billet_default" name="date_billet_default" class="form-control" value="{{ $billet->date_billet }}">
                                                            <div class="input-group date">
                                                                <input type="text" id="date_billet" name="date_billet" class="form-control">
                                                                <span class="input-group-addon">
																	<span class="fa fa-calendar"></span>
																</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="prix_htt">Prix Hors Taxe</label>
                                                            <input type="text" id="prix_htt" name="prix_htt" value="{{ $billet->prix_htt }}" class="form-control" placeholder="Prix Hors Taxe">
                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="prix_ttc">Montant TTC</label>
                                                            <input type="text" id="prix_ttc" name="prix_ttc" class="form-control" placeholder="Prix TTC" value="{{ $billet->prix_ttc }}">
                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="commission">Commission</label>
                                                            <input type="text" id="commission" name="commission" value="{{ $billet->commission }}" class="form-control" placeholder="Commission">
                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="frais_service">Frais de Service</label>
                                                            <input type="text" id="frais_service" name="frais_service" value="{{ $billet->frais_service }}" class="form-control" placeholder="Frais de Service">
                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="net_a_payer">Net A Payer</label>
                                                            <input type="text" id="net_a_payer" name="net_a_payer" class="form-control" placeholder="Net A Payer" value="{{ $billet->net_a_payer }}">
                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>

                                                </div>


                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="montant_recu">Montant Recu</label>
                                                            <input type="text" id="montant_recu" name="montant_recu" value="{{ $billet->montant_recu }}" class="form-control" placeholder="Montant Recu">
                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="control-label mb-10" for="moyen_payement">Moyen Payement</label>
                                                        <select class="form-control" id="moyen_payement" name="moyen_payement">
                                                            <option value="cash">Cash</option>
                                                            <option value="transfert">Transfert</option>
                                                            <option value="cheque">Chéque</option>
                                                            <option value="virement">Virement Banquaire</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            <!-- /Row -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="adresse">Texte Billet</label>
                                                        <textarea name="adresse" id="adresse" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="seprator-block"></div>
                                                @php($trajets = $billet->trajets)

                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body">
                                                        <div class="table-wrap">
                                                            <div class="table-responsive">
                                                                <table  class="table  top-countries" >
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                Lieu Depart
                                                                            </th>
                                                                            <th>
                                                                                Date Depart
                                                                            </th>
                                                                            <th>
                                                                                Heure Depart
                                                                            </th>
                                                                            <th>
                                                                                Vol Depart
                                                                            </th>
                                                                            <th>
                                                                                Lieu Arrive
                                                                            </th>
                                                                            <th>
                                                                                Heure Arrive
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    @foreach($trajets as $trajet)
                                                                        @php($clien_id = explode('_',$key))
                                                                        <tr>
                                                                            <td>
                                                                                {{ $trajet->lieu_depart }}
                                                                            </td>
                                                                            <td>
                                                                                {{ $trajet->date_depart }}
                                                                            </td>
                                                                            <td>
                                                                                {{ $trajet->heure_depart }}
                                                                            </td>
                                                                            <td>
                                                                                {{ $trajet->vol_depart }}
                                                                            </td>
                                                                            <td>
                                                                                {{ $trajet->lieu_arr }}
                                                                            </td>
                                                                            <td>
                                                                                {{ $trajet->heure_arr }}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

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
            var montttc = parseInt($('#prix_ttc').val());
            var montnet = 0;
            var comm = 0;
            var fraiss = 0;

            $('#date_billet').datetimepicker({
                useCurrent: true,
                defaultDate: $('#date_billet_default').val(),
                format: "DD/MM/YYYY",
                maxDate: "moment",
                locale: "fr",
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
            }).on('dp.show', function() {
                if($(this).data("DateTimePicker").date() === null)
                    $(this).data("DateTimePicker").date(moment());
            });

            $('#commission').change(function() {
                if ($('#commission').val() > 0 && $('#commission').val() < 100) {
                    comm = montttc * parseInt($('#commission').val()) / 100;
                    montnet = parseInt(parseInt(montttc) + parseInt(comm) + parseInt(fraiss));
                    $('#net_a_payer').val(montnet);
                }
            });
            $('#frais_service').change(function() {
                if ($('#frais_service').val() > 0) {
                    montnet =parseInt(parseInt(montttc) + parseInt($('#frais_service').val()) + parseInt(fraiss));
                    $('#net_a_payer').val(montnet);
                }
            });
        });

    </script>
    @endpush
@endsection