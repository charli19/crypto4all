<!DOCTYPE html>
<html lang="es">

<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">


    <title>@yield('title') - Crypto 4 All</title>

    <!-- Editor de textarea -->
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>


    <!--CSS de la valoracion-->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('css/valoracion.css')}}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{url('css/mdb.min.css')}}" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="{{url('css/style.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="    //cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

    <style>
        body {
            margin: 0;
            font-family: sans-serif;
        }

        .navbar {
            background-color: #47475C;
            height: 50px;
        }

        .navbar .navbar-brand img {
            height: 66px;
            margin-top: -7px;
            margin-left: 10px;
            width: auto;
        }

        .embed-bar {
            background-color: #eeeaea;
            color: #3d3d3d;
            height: 50px;
        }

        a.action {
            float: right;
            line-height: 50px;
            margin-right: 10px;
            color: #8087e8;
            text-decoration: none;
            font-size: 0.8em;
        }

        a.action i.fa {
            font-size: 1.6em;
        }

        .navbar a.action {
            color: #eeeaea;
        }

        .description {
            max-width: 800px;
            margin: 1em auto;
            padding: 10px;
        }

        .error {
            text-align: center;
            font-style: italic;
            color: red;
        }
    </style>

    <!--Highcharts-->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/stock/indicators/indicators.js"></script>
    <script src="https://code.highcharts.com/stock/indicators/stochastic.js"></script>

    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js">
    </script>



</head>

<body>
<!--Editor de texto-->
<script src="{{url('/vendors/ckeditor/ckeditor.js')}}"></script>
<header>


    @php $criptomonedas=\App\Criptomoneda::all() @endphp
    <nav class=" align-baseline alert " style="padding-top: 1px; padding-bottom: 1px; margin:0px; background-color: #fff928;" >
        <marquee class="mt-2"><p class="d-inline bold ">Ultimas 24h :</p>
                @foreach($criptomonedas as $criptomoneda)
                @if($criptomoneda->porcentaje_24h<0)
                    <p class="d-inline">{{$criptomoneda->nombre}}: <p class="text-danger d-inline">{{$criptomoneda->porcentaje_24h}}%  </p>
                @elseif($criptomoneda->porcentaje_24h>0)
                    <p class="d-inline">{{$criptomoneda->nombre}}: <p class="text-success d-inline">{{$criptomoneda->porcentaje_24h}}%  </p>
                @endif
                        @endforeach
        </marquee>
    </nav>

<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark primary-color">

    <!-- Navbar brand -->
    <a class="navbar-brand" href="{{ url('/home') }}"><i class="fa fa-dashboard"> C4A </i></a>

    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="basicExampleNav">

        <!-- Links -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('criptomonedas') }}"><i class="fa fa-area-chart"> CRIPTOMONEDAS</i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('foro') }}"><i class="fa fa-paper-plane-o"> FORO </i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href={{ route('usuarios') }}><i class="fa fa-group"> USUARIOS </i></a>
            </li>
            @if(Auth::guest())

            @else
            <li class="nav-item">
                <a class="nav-link" href={{ url('/usuarios/'.Auth::user()->nick) }}><i class="fa fa-address-card-o"> MI PERFIL </i></a>
            </li>
            @endif

            @if(Auth::guest())

                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li> /
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
            @else
                <li class="dropdown nav-item ">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                        {{ Auth::user()->nick }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu navbar-right" style="margin-right: 0px;">
                        <li>
                            <a href="{{ url('/usuarios/'.Auth::user()->nick.'/editar') }}" class="btn btn-outline-danger waves-effect center-block">
                                Editar perfil
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" class="btn btn-outline-danger waves-effect center-block" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar sesión

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="height:0px;">
                                {{ csrf_field() }}
                            </form>
                            </a>
                        </li>
                    </ul>
                </li>

            @endif
        </ul>
        <!-- Links -->


    </div>
    <!-- Collapsible content -->

</nav>
<!--/.Navbar-->
</header>
<div class="container">
<div class="row mt-3">
    <div class="col-12">

        @yield('content')
    </div>
</div>
</div>

<footer>

    <!--Footer-->
    <footer class="page-footer font-small indigo pt-0">

        <!--Footer Links-->
        <div class="container">

            <!--Grid row-->
            <div class="row pt-5 mb-3 text-center d-flex justify-content-center">

                <!--Grid column-->
                <div class="col-md-2 mb-3">
                    <h6 class="text-uppercase font-weight-bold">
                        <a href="{{route("home")}}">Dashboard</a>
                    </h6>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-2 mb-3">
                    <h6 class="text-uppercase font-weight-bold">
                        <a href="{{route("criptomonedas")}}">Criptomonedas</a>
                    </h6>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-2 mb-3">
                    <h6 class="text-uppercase font-weight-bold">
                        <a href="{{route("foro")}}">Foro</a>
                    </h6>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-2 mb-3">
                    <h6 class="text-uppercase font-weight-bold">
                        <a href="{{route("usuarios")}}">Usuarios</a>
                    </h6>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-2 mb-3">
                    <h6 class="text-uppercase font-weight-bold">
                        <a href="{{route("home")}}">Falta algo</a>
                    </h6>
                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->

            <hr class="rgba-white-light" style="margin: 0 15%;">

            <!--Grid row-->
            <div class="row d-flex text-center justify-content-center mb-md-0 mb-4">

                <!--Grid column-->
                <div class="col-md-8 col-12 mt-5">
                    <h3 class="text-center">Crypto 4 All</h3>
                    <p style="line-height: 1.7rem">Realizado por parte del equipo de PC Adicto.</p>

                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->

            <hr class="clearfix d-md-none rgba-white-light" style="margin: 10% 15% 5%;">

            <!--Grid row-->
            <div class="row pb-3">

                <!--Grid column-->
                <div class="col-md-12">

                    <div class="mb-5 flex-center">
                        <!--Facebook-->
                        <a class="fb-ic">
                            <i class="fa fa-facebook fa-lg white-text mr-md-4"> </i>
                        </a>
                        <!--Twitter-->
                        <a class="tw-ic">
                            <i class="fa fa-twitter fa-lg white-text mr-md-4"> </i>
                        </a>
                        <!--Google +-->
                        <a class="gplus-ic">
                            <i class="fa fa-google-plus fa-lg white-text mr-md-4"> </i>
                        </a>
                        <!--Linkedin-->
                        <a class="li-ic">
                            <i class="fa fa-linkedin fa-lg white-text mr-md-4"> </i>
                        </a>
                        <!--Instagram-->
                        <a class="ins-ic">
                            <i class="fa fa-instagram fa-lg white-text mr-md-4"> </i>
                        </a>
                        <!--Pinterest-->
                        <a class="pin-ic">
                            <i class="fa fa-pinterest fa-lg white-text"> </i>
                        </a>
                    </div>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->

        </div>
        <!--/Footer Links-->

        <!--Copyright-->
        <div class="footer-copyright py-3 text-center">
            © 2018 Copyright:
            <a href="https://mdbootstrap.com/material-design-for-bootstrap/"> www.pcadicto.com </a>
        </div>
        <!--/Copyright-->

    </footer>
    <!--/Footer-->

</footer>
<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="{{url('js/jquery-3.2.1.min.js')}}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{url('js/popper.min.js')}}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{url('js/bootstrap.min.js')}}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{url('js/mdb.min.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready( function () {
        $('#example').DataTable();

    } );
</script>

</body>


</html>

