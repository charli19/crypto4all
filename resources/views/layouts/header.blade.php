<!doctype html>
<html lang="en">
<head>
	<title>Crypto4all - Criptomonedas</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	 
    <!-- Favicon -->
	<link rel="shortcut icon" href="{{url('img/logo.png')}}" />



    <!-- SEO -->
    <meta name="description" content="Consulta los precios de las Criptomonedas a tiempo real. Bitcoin, Ethereum, Bitcoin Cash, Litecoin" />
    <meta name="keywords" content="bitcoin, ethereum, litecoin, bitcoin cash" />
    <meta name="title" content="Crypto 4 All - Criptomonedas" />
    <meta property="og:title" content="Crypto 4 All - Criptomonedas" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.crypto4all.pcadicto.com/" />



	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{url('/librerias/bootstrap.min.css')}}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
	<link rel="stylesheet" href="{{url('/librerias/style.css')}}">
	<link rel="stylesheet" href="{{url('/librerias/chartist-custom.css')}}">

	<!--CSS valoracion-->
	<link rel="stylesheet" type="text/css" href="{{url('css/valoracion.css')}}">

	<!--Jquery-->
	<link rel="stylesheet" href="https://code.jquery.com/jquery-3.1.1.min.js">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{url('/librerias/main.css')}}">

	<!-- Material Design Bootstrap -->
	<link href="{{url('/css/mdb.min.css')}}" rel="stylesheet">
	<!-- Your custom styles (optional) -->
	<link href="{{url('/css/style.css')}}" rel="stylesheet">

	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{url('/librerias/demo.css')}}">

	<!-- GOOGLE FONTS -->
	<link href="{{url('/librerias/sanspro.css')}}" rel="stylesheet">

	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{url('assets/img/apple-icon.png')}}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{url('assets/img/favicon.png')}}">
	<script src="{{url('/librerias/jquery-3.1.1.min.js')}}"></script>
	<script src="{{url('/librerias/highstock.js')}}"></script>
	<script src="{{url('/librerias/exporting.js')}}"></script>
	<script src="{{url('/librerias/indicators.js')}}"></script>
	<script src="{{url('/librerias/stochastic.js')}}"></script>

<style>
	container-fluid{
    	color: black !important;
	}

@media screen and (max-width: 992px) {
    body {
		widht:800px;
    }
}

/* On screens that are 600px wide or less, the background color is olive */
@media screen and (max-width: 600px) {
    body {

    }
}
</style>
</head>
<body>
	<!-- WRAPPER -->
	<div id="wrapper">

		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand d-inline">
				<a href="{{url('/')}}"><img src="{{url('/img/logo.png')}}" alt="Klorofil Logo" width="35px" height="35px" class="d-inline img-responsive logo"></a>
			</div>
			<div class="container-fluid d-inline">
				<div class="navbar-btn ">
					<button type="button" class="d-inline btn-toggle-fullwidth"><i class="fas fa-bars"></i></button>
				</div>
				<div id="navbar-menu mt-5 d-inline">
					@php $criptomonedas=\App\Criptomoneda::all() @endphp

					<b><p class="text-center" style="margin-top:10px;">Última hora</p><p class=" bold text-center" style="margin-top:10px;"></b>

					@foreach($criptomonedas as $criptomoneda)
						@if($criptomoneda->porcentaje_1h<0)
							<span>{{$criptomoneda->nombre}}: </span><span class="text-danger d-inline">{{$criptomoneda->porcentaje_1h}}% </span>
						@elseif($criptomoneda->porcentaje_1h>0)
							{{$criptomoneda->nombre}}: <span class="text-success d-inline">{{$criptomoneda->porcentaje_1h}}%</span>
						@else
							{{$criptomoneda->nombre}}: <span class="d-inline">{{$criptomoneda->porcentaje_1h}}%</span>
						@endif
					@endforeach


				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->

		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>

					<ul class="nav">
						<li><a href="{{url('/')}}" class="active"><i class="fas fa-tachometer-alt"></i> <span>Inicio</span></a></li>

						<li>
							<!--Desplegable para ver todas las criptomonedas-->
							<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="icon-submenu fa fa-arrow-left"></i><i class="fas fa-chart-area"></i>Criptomonedas</a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="{{ url('/criptomonedas/bitcoin') }}"><i class="fab fa-bitcoin"></i>Bitcoin</a></li>
									<li><a href="{{ url('/criptomonedas/ethereum') }}"><i class="fab fa-ethereum"></i>Ethereum</a></li>
									<li><a href="{{ url('/criptomonedas/litecoin') }}"><i class="fas fa-lira-sign"></i>Litecoin</a></li>
									<li><a href="{{ url('/criptomonedas/bitcoin Cash') }}"><i class="fab fa-btc"></i>Bitcoin Cash</a></li>
								</ul>
							</div>
						</li>

						<li><a href="{{ url('/foro') }}"><i class="fas fa-comment"></i> <span>Foro</span></a></li>
						<hr>
						<li>
							@if(!Auth::guest())
								@php $user=\Auth::user(); @endphp

								<a href="#subPages1" data-toggle="collapse" class="collapsed"><i class="fas fa-user-circle"></i> <span>Panel de usuario</span> <i class="icon-submenu fa fa-arrow-left"></i></a>
								<div id="subPages1" class="collapse ">
									<ul class="nav">
										<li><a href="{{ url('/usuarios/'.$user->nick) }}"><i class="fas fa-user"></i>{{ Auth::user()->nick }}</a></li>
										<li><a href="{{ url('/usuarios/'.$user->nick.'/editar') }}"><i class="fas fa-user-edit"></i>Editar perfil</a></li>
										<li><a class="dropdown-item" href="{{ route('logout') }}"
											   onclick="event.preventDefault();
															  document.getElementById('logout-form').submit();">
												<i class="fas fa-sign-out-alt"></i>{{ __('Cerrar sesión') }}
											</a>

											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												@csrf
											</form></li>
									</ul>
								</div>
						</li>
						@endif
						@guest
							<li><a href="{{ route('login') }}"><i class="fa fa-sign-in-alt"></i>Iniciar sesión</a></li>

							<li><a href="{{ route('register') }}" class=""><i class="fab fa-wpforms"></i> <span>Registrarse</span></a></li>
						@endguest




					</ul>				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->

		<!-- MAIN -->
		<div class="main">