<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>EXIM VOYAGES APP</title>
    <meta name="author" content="Amadou Camara"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Data table CSS -->
    <link href="{{ asset('vendors/bower_components/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Custom CSS -->
    <link href="{{ elixir("css/app.css") }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ elixir("css/screen.css") }}" media="screen, print" />
    <link rel="stylesheet" type="text/css" href="{{ elixir("css/print.css") }}" media="print" />
</head>

<body>
    <!--Preloader-->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!--/Preloader-->
    <div class="wrapper">

        <!-- Top Menu Items -->
        @include('layouts.top-menu')
        <!-- /Top Menu Items -->

        <!-- Left Sidebar Menu -->
        @include('layouts.left-menu')
        <!-- /Left Sidebar Menu -->

        <!-- Right Sidebar Menu -->
        @include('layouts.rigth-menu')
        <!-- /Right Sidebar Menu -->

        <!-- Main Content -->
        <div class="page-wrapper">
            <div class="container-fluid" id="app">

                <!-- Title -->
                @include('layouts.header')
                <!-- /Title -->



                @yield('content')

                <!-- Footer -->
                @include('layouts.footer')
                <!-- /Footer -->

            </div>
            <!-- /Main Content -->

        </div>
        <!-- /#wrapper -->

        <!-- JavaScript -->

        <!-- jQuery -->
        {{--<script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>--}}
        <script type="text/javascript" src="{{ asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>

        <!-- Bootstrap Core JavaScript -->
        {{--<script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>--}}
        <script type="text/javascript" src="{{ asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

        <!-- Data table JavaScript -->
        {{--<script src="vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>--}}
        <script type="text/javascript" src="{{ asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>

        {{--<script src="js/dataTables-data.js"></script>--}}
        <script type="text/javascript" src="{{ asset('js/dataTables-data.js') }}"></script>

        <!-- Slimscroll JavaScript -->
        {{--<script src="js/jquery.slimscroll.js"></script>--}}
        <script type="text/javascript" src="{{ asset('js/jquery.slimscroll.js') }}"></script>

        <!-- Fancy Dropdown JS -->
        {{--<script src="js/dropdown-bootstrap-extended.js"></script>--}}
        <script type="text/javascript" src="{{ asset('js/init.js') }}"></script>

        <!-- Init JavaScript --> <script src="{{ elixir('js/app.js') }}"></script>
        {{--<script src="js/init.js"></script>--}}
        <script type="text/javascript" src="{{ asset('js/dropdown-bootstrap-extended.js') }}"></script>
        <script>
            var interval = 1000 * 60 * 1;
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
                window.setInterval(function(){
                    getJSON("./billets/charger").then(function(result) {
                        console.log(result);
                        var nb_total = parseInt($('#tot_new_billet').html()) + result.nb_billet;
                        var dt = new Date();
                        var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
                        $('#tot_new_billet').html(result.nb_billet);
                        $('#new_billets').html(result.nb_billet);
                        $('#date_new').html(time);
                    }, function(error) {
                        console.log("Failed to fetch data.txt: " + error);
                    });
                }, interval);
            });

        </script>
        @stack('script-footer')

    </div>

</body>

</html>
