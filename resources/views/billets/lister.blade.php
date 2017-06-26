@extends('layouts.master')
@section('content')
    {{ Session::get('message') }}

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Articles</h6>
                    </div>
                    <button type="button" id="load_billet"  class="pull-md-8 btn btn-primary">Charger</button>
                    <a href="{{ URL::to('/billets/ajouter') }}" class="pull-right btn btn-primary">Ajouter</a>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datable_1" class="table table-hover display  pb-30" >
                                    <thead>
                                    <tr>
                                        <th>Numero</th>
                                        <th>Passager</th>
                                        <th>Date</th>
                                        <th>Prix</th>
                                        <th>Voir +</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Numero</th>
                                        <th>Passager</th>
                                        <th>Date</th>
                                        <th>Prix</th>
                                        <th>Voir +</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($billets as $billet)
                                            <tr>
                                                <td>{{ $billet->numero_billet }}</td>
                                                <td>{{ $billet->prenom_psg }} {{ $billet->nom_psg }}</td>
                                                <td>{{ $billet->date_billet }}</td>
                                                <td>{{ $billet->prix_ttc }}</td>
                                                <td><a class="btn btn-primary" href="{{ URL::to('/billets/'. $billet->id .'/payer') }}">Payer</a></td>
                                                <td class="text-nowrap"><a href="{{ URL::to('/billets/'. $billet->id .'/modifier') }}" class="mr-25" data-toggle="tooltip" data-original-title="Modifer"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> <a href="/billets/{{ $billet->id }}/supprimer" data-toggle="tooltip" data-original-title="Supprimer"> <i class="fa fa-close text-danger"></i> </a> </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- sample modal content -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myModalLabel">Modal Heading</h5>
                </div>
                <div class="modal-body">
                    <h5 id="dateload_load"></h5>
                    <h5 id="resultat_load"></h5>
                    <h5 id="billet_load"></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @push('script-footer')
        <script>
            $( document ).ready(function () {
                function get(url) {
                    return new Promise(function(succeed, fail) {
                        var req = new XMLHttpRequest();
                        req.open("GET", url, true);
                        req.addEventListener("load", function() {
                            if (req.status < 400)
                                succeed(req.responseText);
                            else
                                fail(new Error("Request failed: " + req.statusText));
                        });
                        req.addEventListener("error", function() {
                            fail(new Error("Network error"));
                        });
                        req.send(null);
                    });
                }
                function getJSON(url) {
                    return get(url).then(JSON.parse);
                }
                $('#load_billet').click(function () {
                    getJSON("./billets/charger").then(function(result) {
                        console.log(result);
                        var nb_total = parseInt($('#tot_new_billet').html()) + result.nb_billet;
                        var dt = new Date();
                        var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
                        $('#resultat_load').html("Chargement terminer avec succes");
                        $('#billet_load').html("Nombre de billet chargé " + result.nb_billet);
                        $('#dateload_load').html("Chargement terminé le "+time);
                        $('#myModal').modal('show')

                    }, function(error) {
                        console.log("Failed to fetch data.txt: " + error);
                        $('#resultat_load').html("Echec lors du chargement");
                        $('#myModal').modal('show')
                    });
                })
            });
        </script>
    @endpush
@endsection
