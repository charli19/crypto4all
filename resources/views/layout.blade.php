
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>@yield('title') - Crypto 4 All</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Editor de textarea -->
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
  </head>

  <!--CSS de la valoracion-->
  <link rel="stylesheet" type="text/css" href="{{url('css/valoracion.css')}}">

  <body>
  <script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>
    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="/curso/public/home">C4A</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('criptomonedas') }}">Cryptomonedas <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('usuarios') }}">Usuarios</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link " href={{ route('foro') }}>Foro</a>
            </li>
            @if(!Auth::guest())
            <li class="nav-item active">

              <a class="nav-link " href={{ url('/usuarios/'.Auth::user()->nick) }}>Mi perfil</a>
            </li>
            @endif
          </ul>
          <ul class="nav navbar-nav navbar-left">
            <!-- Authentication Links -->
            @if(Auth::guest())
              <li><a href="{{ route('login') }}">Login</a></li> /
              <li><a href="{{ route('register') }}">Register</a></li>
            @else
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                  {{ Auth::user()->nick }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" style="margin-right: 30px;">
                  <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                       Cerrar sesión
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="">
                      {{ csrf_field() }}
                    </form>
                  </li>
                </ul>
              </li>
            @endif
          </ul>

        </div>
      </nav>
    </header>

    <!-- Begin page content -->
    <main role="main" class="container">

    <div class="row mt-3">
    <div class="col-9">

    @yield('content')
      
    </div>
    <div class="col-3">
        @section('sidebar')
          <!--<h2>Widgets</h2>

        <form class="form-inline mt-2 mt-md-0">
          <input class="form-control " size="20" type="text" placeholder="Buscar " aria-label="Buscar">
          <button class="btn btn-block btn-outline-success pull-right"  type="submit">Buscar</button>
        </form>

        <h3 text="justify">Tus Criptomonedas Favoritas</h3>
          <hr/>

        <!--Fav o si no es user "Inicia session para..."


        <h3>Ultimas entradas</h3>
        <hr/> -->

        <!--Ultimas entradas-->
        @show


    </div>
</div>    



    </main>
<!--
<footer class="footer">
  <div class="container">
    <span class="text-muted">Place sticky footer content here.</span>
  </div>
</footer>
-->
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>
