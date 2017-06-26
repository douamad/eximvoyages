@php($total_entrees = 0)
@php($total_sorties = 0)
@php($total_entrees_recu = 0)
@php($total_sortiCaisse  = 0)
@php($total_sorties_sortieCaisse = 0)
@php($total_sortie = 0)
@php($total_entrees_tab = array())
@php($total_entree_article = array())
@php($total_sortie_article = array())
@php($total_entree_client = array())
@php($total_entree_client_nom = array())
@php($total_sortie_fournisseur = array())
@php($total_entree_recu_tab = array())
@php($total_sortie_caisse_tab = array())
@php($total_entree_client_recu = array())
@php($total_sortie_fournisseur_recu = array())
@php($total_entree_day = [0,0,0,0,0,0,0])
@php($total_entree_month = [0,0,0,0,0,0,0,0,0,0,0,0])
@php($total_sortie_day = [0,0,0,0,0,0,0])
@php($total_sortie_month = [0,0,0,0,0,0,0,0,0,0,0,0])

@php($jours = ['dimanche','lundi','mardi','mercredi','jeudi','vendredi','samedi'])
@php($mois = ['janvier','fevrier','mars','avril','mai','juin','juillet','aout','septembre','octobre','novembre','decembre'])
@php($td = \Carbon\Carbon::now())
@foreach($entrees as $entree)
    {{--{{ $entree->ref }}, taxe : {{ $entree->taxe }} <br />--}}
    @php($total_article_entree = 0)
    @php($total_recu = 0)
    @foreach($entree->articlesEntrees as $article_entree)
        @php($article_entree_brut = $article_entree->prix * $article_entree->unite)
        @php($article_entree_tva = $article_entree_brut + ($article_entree_brut * $entree->taxe / 100))
        {{---- {{ $article_entree->article->libelle }} => ht: {{ $article_entree_brut    }} tt: {{ $article_entree_tva }}<br />--}}
        @if(isset($total_entree_article[$article_entree->article->libelle]))
            @php($total_entree_article[$article_entree->article->libelle] += $article_entree_tva)
        @else
            @php($total_entree_article[$article_entree->article->libelle] = $article_entree_tva)
        @endif
        @php($total_article_entree += $article_entree_tva)
    @endforeach
    @foreach($entree->recus as $recu)
        @php($total_recu += $recu->montant)
    @endforeach
    @php($total_entree_recu_tab[$entree->ref] = $total_recu)
    @php($total_entrees_tab[$entree->ref] = $total_article_entree)
    @php($date_entree = Carbon\Carbon::parse($entree->dates))
    @if($date_entree->weekOfYear == $td->weekOfYear)
        @php($total_entree_day[$date_entree->dayOfWeek] += $total_article_entree)
    @endif
    @php($total_entree_month[$date_entree->month - 1] += $total_article_entree)
    @if(isset($total_entree_client['client_'.  $entree->client->id]))
        @php($total_entree_client['client_'.  $entree->client->id] += $total_article_entree)
    @else
        @php($total_entree_client['client_'. $entree->client->id] = $total_article_entree)
        @php($total_entree_client_nom['client_'.  $entree->client->id] = $entree->client->prenom.' '.$entree->client->nom)
    @endif
    @php($total_entrees += $total_article_entree)
    @php($total_entrees_recu += $total_recu)
@endforeach
@foreach($sorties as $sortie)
    {{--{{ $sortie->ref }}, taxe : {{ $sortie->taxe }} <br />--}}
    @php($total_article_sortie = 0)
    @php($total_recu = 0)
    @foreach($sortie->articlesSorties as $article_sortie)
        @php($article_sortie_brut = $article_sortie->prix * $article_sortie->unite)
        @php($article_sortie_tva = $article_sortie_brut + ($article_sortie_brut * $sortie->taxe / 100))
        {{---- {{ $article_entree->article->libelle }} => ht: {{ $article_sortie_brut    }} tt: {{ $article_sortie_tva }}<br />--}}
        @if(isset($total_sortie_article[$article_sortie->article->libelle]))
            @php($total_sortie_article[$article_sortie->article->libelle] += $article_sortie_tva)
        @else
            @php($total_sortie_article[$article_sortie->article->libelle] = $article_sortie_tva)
        @endif
        @php($total_article_sortie += $article_sortie_tva)
    @endforeach
    @foreach($sortie->sortieCaisses as $sortieCaiss)
        @php($total_sortiCaisse += $sortieCaiss->montant)
    @endforeach
    @php($total_sortie_caisse_tab[$sortie->ref] = $total_sortiCaisse)
    @php($total_sorties_tab[$sortie->ref] = $total_article_entree)
    @php($date_sortie = Carbon\Carbon::parse($sortie->dates))
    @if($date_entree->weekOfYear == $td->weekOfYear)
        @php($total_sortie_day[$date_sortie->dayOfWeek] += $total_article_sortie)
    @endif
    @php($total_sortie_month[$date_sortie->month - 1] += $total_article_sortie)
    @if(isset($total_sortie_client['client_'.  $sortie->fournisseur->id]))
        @php($total_sortie_client['client_'.  $sortie->fournisseur->id] += $total_article_sortie)
    @else
        @php($total_sortie_client['client_'. $sortie->fournisseur->id] = $total_article_sortie)
    @endif
    @php($total_sorties += $total_article_sortie)
    @php($total_sorties_sortieCaisse += $total_sortiCaisse)
@endforeach


@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <div class="sm-data-box bg-blue">
                            <div class="row ma-0">
                                <div class="col-xs-5 text-center pa-0 icon-wrap-left">
                                    <i class="icon-diamond txt-light"></i>
                                </div>
                                <div class="col-xs-7 text-center data-wrap-right">
                                    <h6 class="txt-light">Entrees Du jour</h6>
                                    <span class="txt-light counter counter-anim toformat">{{ $total_entrees }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <div class="sm-data-box bg-green">
                            <div class="row ma-0">
                                <div class="col-xs-5 text-center pa-0 icon-wrap-left">
                                    <i class="icon-arrow-right-circle txt-light"></i>
                                </div>
                                <div class="col-xs-7 text-center data-wrap-right">
                                    <h6 class="txt-light">Entrees Recu</h6>
                                    <span class="txt-light counter counter-anim toformat">{{ $total_entrees_recu }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <div class="sm-data-box bg-red">
                            <div class="row ma-0">
                                <div class="col-xs-5 text-center pa-0 icon-wrap-left">
                                    <i class="icon-check txt-light"></i>
                                </div>
                                <div class="col-xs-7 text-center data-wrap-right">
                                    <h6 class="txt-light">Sortie du jour</h6>
                                    <span class="txt-light counter counter-anim toformat">{{ $total_sorties }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <div class="sm-data-box bg-green">
                            <div class="row ma-0">
                                <div class="col-xs-5 text-center pa-0 icon-wrap-left">
                                    <i class="icon-diamond txt-light"></i>
                                </div>
                                <div class="col-xs-7 text-center data-wrap-right">
                                    <h6 class="txt-light">Balance du mois</h6>
                                    <span class="txt-light counter counter-anim toformat">{{ $total_entrees - $total_sorties}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Row -->
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Conversion Rate</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="sm-graph-box">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div id="sparkline_1"></div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="counter-wrap text-right">
                                        <span class="counter-cap"><i class="fa  fa-level-up txt-success"></i></span><span class="counter">23</span><span>%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Total Visits</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="sm-graph-box">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div id="sparkline_2"></div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="counter-wrap text-right">
                                        <span class="counter-cap"><i class="fa  fa-level-up txt-success"></i></span><span class="counter">12</span><span>m</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">downloads</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="sm-graph-box">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div id="sparkline_6"></div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="counter-wrap text-right">
                                        <span class="counter-cap"><i class="fa  fa-level-down txt-danger"></i></span><span class="counter">1122</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark"><i class="icon-share mr-10"></i>Visits Conversion</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <canvas id="chart_1" height="417"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary card-view">
                <div class="panel-heading mb-20">
                    <div class="pull-left">
                        <h6 class="panel-title txt-light">Top Clients</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table  class="table  top-countries" >
                                    <tbody>
                                    @foreach($total_entree_client as $key=>$value)
                                        @php($clien_id = explode('_',$key))
                                        <tr>
                                            <td>
                                                {{ $total_entree_client_nom[$key] }}
                                            </td>
                                            <td>
                                                <span class="toformat">{{ $value }}</span> CFA
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
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark"><i class="icon-pie-chart mr-10"></i>Impressions</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <canvas id="chart_6" height="280"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark"><i class="icon-clock mr-10"></i>Average Position</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div id="morris_extra_line_chart" class="morris-chart" style="height:280px;"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Row -->
    @push('script-footer')
    <!-- simpleWeather JavaScript -->
    <script src="{{ elixir('vendors/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ elixir('vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ elixir('js/simpleweather-data.js') }}"></script>

    <!-- Progressbar Animation JavaScript -->
    <script src="{{ elixir('vendors/bower_components/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ elixir('vendors/bower_components/Counter-Up/jquery.counterup.min.js') }}"></script>

    <!-- Fancy Dropdown JS -->
    <script src="{{ elixir('js/dropdown-bootstrap-extended.js') }}"></script>

    <!-- Sparkline JavaScript -->
    <script src="{{ elixir('vendors/jquery.sparkline/dist/jquery.sparkline.min.js') }}"></script>

    <!-- ChartJS JavaScript -->
    <script src="{{ elixir('vendors/chart.js/Chart.min.js') }}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{ elixir('vendors/bower_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ elixir('vendors/bower_components/morris.js/morris.min.js') }}"></script>
    <script src="{{ elixir('js/morris-data.js') }}"></script>

    <script src="{{ elixir('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>

    <!-- Init JavaScript -->
    <script src="{{ elixir('js/dashboard-data.js') }}"></script>
    <script>

        $( document ).ready(function () {

            var number = 0;
//            function formatNums(nums) {
//                number = new Intl.NumberFormat('fr-FR').format(nums);
//                return number;
//            }
//            $('.toformat').each(function () {
//                $(this).html(formatNums($(this).html()))
//            })
            if( $('#chart_1').length > 0 ){
                var ctx1 = document.getElementById("chart_1").getContext("2d");
                var data1 = {
                    labels: {!! json_encode($jours) !!} ,
                    datasets: [
                        {
                            label: "fir",
                            backgroundColor: "rgba(60,184,120,0.4)",
                            borderColor: "rgba(60,184,120,0.4)",
                            pointBorderColor: "rgb(60,184,120)",
                            pointHighlightStroke: "rgba(60,184,120,1)",
                            data: {!! json_encode($total_entree_day) !!}
                        },
                        {
                            label: "sec",
                            backgroundColor: "rgba(252,176,59,0.4)",
                            borderColor: "rgba(252,176,59,0.4)",
                            pointBorderColor: "rgb(252,176,59)",
                            pointBackgroundColor: "rgba(252,176,59,0.4)",
                            data: {!! json_encode($total_sortie_day) !!},
                        }

                    ]
                };

                var areaChart = new Chart(ctx1, {
                    type:"line",
                    data:data1,

                    options: {
                        tooltips: {
                            mode:"label"
                        },
                        elements:{
                            point: {
                                hitRadius:90
                            }
                        },

                        scales: {
                            yAxes: [{
                                stacked: true,
                                gridLines: {
                                    color: "#eee",
                                },
                                ticks: {
                                    fontFamily: "Varela Round",
                                    fontColor:"#2f2c2c"
                                }
                            }],
                            xAxes: [{
                                stacked: true,
                                gridLines: {
                                    color: "#eee",
                                },
                                ticks: {
                                    fontFamily: "Varela Round",
                                    fontColor:"#2f2c2c"
                                }
                            }]
                        },
                        animation: {
                            duration:	3000
                        },
                        responsive: true,
                        maintainAspectRatio:false,
                        legend: {
                            display: false,
                        },
                        tooltips: {
                            backgroundColor:'rgba(47,44,44,.9)',
                            cornerRadius:0,
                            footerFontFamily:"'Varela Round'"
                        }

                    }
                });
            }
        });


    </script>
    @endpush
@endsection