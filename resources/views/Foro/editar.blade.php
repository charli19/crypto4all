
@include('layouts.header')
<!-- MAIN CONTENT -->
    <!--Dice los errores del formulario con estilo-->
<div class="container">
    @if(Auth::guest())
        <h1 class="text-center">Para añadir entradas debes iniciar sessión</h1>

        <div class="row center-block" style="display: flex;align-items: center;justify-content: center;">

            <a href="{{ url("login") }}"><button class="btn btn-lg btn-info">Ir al Login</button></a>
        </div>
        <br>

    @elseif(Auth::user()->nick == $entrada->user->nick  || Auth::user()->hasRole('admin'))

<!--Dice los errores del formulario con estilo-->
        @if( $errors->any() )
            <div class="alert alert-danger">
                <h6>Corrige los siguientes errores:</h6>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <a href="{{ route('foro') }}"><button type="button" class="btn btn-primary d-block pull-right float-right mb-3"><h4>Volver</h4></button></a>

        <form method="POST" action=" {{ url('foro/editar') }} ">
            {{ method_field('PUT') }}
            {!! csrf_field() !!}
            <input type="text" name="id" id="id" value="{{$entrada->id_entrada}}" hidden>
            <input type="text" name="id_usuario" id="id_usuario" value="{{$entrada->user->id}}" hidden>

            <label for="titulo"><h1>Titulo</h1></label>

            <input type="text"  name="titulo" id="titulo" value="{{$entrada->titulo}}" class="form-control d-block">
            <br>

            <div class="form-group">
                <label for="texto">Texto:</label>
                <textarea  class="form-control"  name="texto" id="texto" rows="3">{{$entrada->texto}}
                </textarea>
            </div>
            <br>
            <button class="btn btn-primary d-block" type="submit"><h4>Editar entrada</h4></button>
        </form>


    @endif
</div>
<!-- END MAIN CONTENT -->
@include('layouts.footer')