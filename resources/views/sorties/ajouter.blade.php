@extends('layouts.master')
@section('content')
    <!-- Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Ajouter Sortie</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-wrap">
                                    <form action="{{ URL::to('/sorties/ajouter') }}" method="post">
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
                                                            <label class="control-label mb-10" for="ref">Ref Sorties</label>
                                                            <input type="text" id="ref" name="ref" class="form-control">

                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <label class="control-label mb-10" for="date_entre">Date Sortie</label>
                                                        <div class="input-group date">
                                                            <input type="text" id="date_entre" name="date_entre" class="form-control">
                                                            <span class="input-group-addon">
																	<span class="fa fa-calendar"></span>
																</span>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                            <!-- /Row -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10" for="fournisseur_id">Catégorie Article</label>
                                                        <select name="fournisseur_id" id="fournisseur_id" class="form-control">
                                                            @foreach($fournisseurs as $fournisseur)
                                                                <option value="{{ $fournisseur->id }}"> {{ $fournisseur->nom }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="complement">Infos Complementaire</label>
                                                            <input type="text" id="complement" name="complement" class="form-control" placeholder="Infos complementaires">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <!-- Basic Table -->
                                                    <div class="col-sm-12">

                                                        <div class="panel panel-default card-view">
                                                            <div class="panel-wrapper collapse in">
                                                                <div class="panel-body">
                                                                    <h3 class="text-muted">Listes des articles</h3>

                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label class="control-label mb-10" for="articles">Article</label>
                                                                                    <select id="articles" class="form-control">
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label class="control-label mb-10" for="prix">Prix</label>
                                                                                    <input type="number" id="prix"  class="form-control" placeholder="Prix">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label class="control-label mb-10" for="quantite">Quantites</label>
                                                                                    <input type="number" id="quantite"  class="form-control" placeholder="Quantite">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    <input type="hidden" name="artiles_id" id="artiles_id">
                                                                    <input type="hidden" name="artiles_prix" id="artiles_prix">
                                                                    <input type="hidden" name="artiles_qte" id="artiles_qte">
                                                                    <button class="btn btn-primary" id="ajouterArticle" type="button">Ajouter Articles</button>
                                                                    <button class="btn btn-primary selectedArt" id="ajouterArticle" type="button" >Ajouter Articles</button>
                                                                    <div class="table-wrap mt-40">
                                                                        <div class="table-responsive">
                                                                            <table class="table mb-0">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Article</th>
                                                                                    <th>Prix</th>
                                                                                    <th>Unite</th>
                                                                                    <th>Totale</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody id="tab-rticle">

                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Basic Table -->
                                                </div>

                                                <!-- /Row -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="prenom">Appliquer Taxe?</label>
                                                            <div class="radio-list">
                                                                <div class="radio-inline pl-0">
                                                                    <span class="radio radio-info">
                                                                        <input type="radio" name="settaxe" id="settaxe_oui" value="1" checked="checked">
                                                                        <label for="settaxe_oui">Oui</label>
                                                                    </span>
                                                                </div>
                                                                <div class="radio-inline">
                                                                    <span class="radio radio-info">
                                                                        <input type="radio" name="settaxe" id="settaxe_non" value="0">
                                                                        <label for="settaxe_non">Non</label>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <span class="help-block"> </span>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="taxe">Taxe</label>
                                                            <input type="number" step="any" id="taxe" name="taxe" class="form-control" placeholder="Taxe">
                                                        </div>
                                                    </div>
                                                    <!--/span-->
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
                let articles = [];
                let selectedArticles = [];
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
                getJSON("http://localhost:8000/api/articles/").then(function(result) {
                    result.data.forEach(function (item, index, array) {
                        articles.push(item)
                        jQuery('#articles').append('<option value="'+ item.id +'">'+ item.libelle +'</option>')
                        jQuery('#prix').val(item.prix);
                    })
                }, function(error) {
                    console.log("Failed to fetch data.txt: " + error);
                });
                jQuery('#ajouterArticle').click(function () {
                    let article = articles.find(function (item) {
                        return item.id == $('#articles').val();
                    });
                    article.prix = $('#prix').val();
                    selectedArticles.push({
                        'article': article,
                        'qte': parseFloat((!isNaN($('#quantite').val()) && $('#quantite').val() != 0)?$('#quantite').val():1)
                    });
                    refreshTabArt();

                })
                $(document).on('click', '.selected-art', function (el) {
                    let str = el.target.id
                    let tab = str.split("-")
                    console.log(tab[1])
                    delLine(tab)
                    refreshTabArt();
                })
                function refreshTabArt() {
                    let html = '';
                    var article_id = [];
                    var article_prix = [];
                    var article_qte = [];
                    $('#tab-rticle').html(html);
                    $('#artiles_id').val( article_id);
                    $('#artiles_prix').val(article_prix);
                    $('#artiles_qte').val(article_qte);
                    selectedArticles.forEach(function (item, index, array) {
                        let total =  parseFloat(item.qte * item.article.prix);
                        html += '<tr id="ligne-art-'+ parseInt(index + 1) +'"><td>'+ + parseInt(index + 1) +'</td><td>'+ item.article.libelle +'</td><td>'+ item.article.prix +'</td><td>'+ item.qte +'</td><td>'+ total +'</td><td class="text-nowrap"> <button type="button" class="selected-art" > <i class="fa fa-close text-danger" id="art-'+ + parseInt(index + 1) +'"></i> </button> </td></tr>'
                        $('#tab-rticle').html(html);
                        article_id.push(item.article.id);
                        article_prix.push(item.article.prix);
                        article_qte.push(item.qte);
                        $('#artiles_id').val(article_id.join('_'));
                        $('#artiles_prix').val(article_prix.join('_'));
                        $('#artiles_qte').val(article_qte.join('_'));
                        console.log(article_id, article_prix, article_qte.join('_'))
                    })

                }
                $('#articles').change(function () {
                    let article = articles.find(function (item) {
                        return item.id == $('#articles').val();
                    });
                    $('#prix').val(article.prix);
                });
                function delLine(tab)
                {
                    if(tab.length>0)
                    {
                        selectedArticles.splice(parseInt(tab[1] - 1),1);
                    }
                }
            });

        </script>
    @endpush
@endsection