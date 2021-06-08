
@include('layouts.header')
<!-- MAIN CONTENT -->
<div class="container">
    @if(Auth::guest())

        <!--Vista de usuario no registrado-->

        <h1 class="text-center">Para añadir una entrada tienes que iniciar sesión</h1>
        <div class="row center-block" style="display: flex;align-items: center;justify-content: center;">

            <a href="{{url('login')}}"><button class="btn btn-info btn-lg"><h4>Iniciar session</h4></button>&nbsp;</a>
        </div>
        <br>

    @elseif(Auth::user()->hasRole('user') | Auth::user()->hasRole('admin'))


        <br><a href="{{ route('foro') }}"><button type="button" class="btn btn-primary d-block pull-right float-right"><h4>Volver</h4></button></a><br><br>

        <!--<h1 class="d-block"> Creacion de Entrada </h1>-->
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

    <form method="POST" action=" {{ url('foro/crear') }} ">
        {!! csrf_field() !!}

        <input type="text" name="id_usuario" id="id_usuario" value="{{Auth::user()->id}}" hidden>

        <h2 class="d-block"><label class="d-block" for="texto">Titulo:</label></h2>
        <input type="text"  name="titulo" id="titulo" class="form-control d-block">


        <hr>

        <div class="form-group">
        <h3><label for="texto">Texto:</label></h3>
            <textarea  class="form-control"  name="texto" id="texto" rows="3"></textarea>
        </div>
            <hr>
            <br>
        <button type="submit" class="btn btn-primary d-block"><h4>Crear entrada</h4></button>
    </form>


    @endif

</div><br><br>
<!-- END MAIN CONTENT -->
@include('layouts.footer')