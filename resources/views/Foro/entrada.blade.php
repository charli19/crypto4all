
@include('layouts.header')
<!-- MAIN CONTENT -->
<div class="container">

    <a href="{{ route('foro') }}"><button type="button"  style="margin-top:10px;"  class="btn btn-primary pull-right mb-3"><h4>Volver</h4></button></a><br><br><br>

<hr>
    @if(Auth::guest() || Auth::user()->hasRole('admin') || Auth::user()->hasRole('user'))


        <!--Entrada-->
        <div class="jumbotron p-5 text-center text-md-left author-box">
                <!-- Name -->
                <h3 class="h3-responsive text-center font-weight-bold dark-grey-text">{{ucfirst($entrada->titulo)}}</h3>
                <hr>
                <div class="row d-flex justify-content-center container">
                    <!-- Avatar -->
                    <div class="col-10 col-md-2 mb-md-0 mb-4 ">
                        <a  href="{{ url('/usuarios/'.$entrada->user->nick) }}">
                            <img width="300px" height="300px" src="{{$entrada->user->imagen }}" class="img-circle img-fluid rounded-circle z-depth-2 avatar d-flex justify-content-center">
                        </a>
                    </div>
                    <!-- Author Data -->
                    <div class="col-10 col-md-8">
                        <h5 class="font-weight-bold dark-grey-text mb-3">
                            <strong>{{$entrada->user->nick}}</strong>
                        </h5>
                        <div class="personal-sm pb-3">
                            @if($entrada->user->web)
                                <a class="pr-2 email-ic">
                                    <a href="http://{{$entrada->user->web}}"><i class="fa fa-home mr-2"> </i></a>
                                </a>
                            @endif
                            @if($entrada->user->facebook)
                                <a class="pr-2 fb-ic">
                                    <a href="http://{{$entrada->user->facebook}}"><i class="fab fa-facebook-square"></i>

                                    </a>
                                </a>
                            @endif
                            @if($entrada->user->instagram)
                                <a class="pr-2 tw-ic">
                                    <a href="http://{{$entrada->user->instagram}}"><i class="fab fa-instagram"></i>

                                    </a>
                                </a>
                                @endif
                            @if($entrada->user->twitter)
                                <a class="pr-2 tw-ic">
                                    <a href="http://{{$entrada->user->twitter}}"><i class="fab fa-twitter"></i>

                                    </a>
                                </a>
                                @endif
                            @if($entrada->user->google)
                                <a class="pr-2 gplus-ic">
                                    <a href="http://{{$entrada->user->google}}"><i class="fab fa-google-plus-square"></i>

                                    </a>
                                </a>
                                @endif
                            @if($entrada->user->linkedin)
                                <a class="pr-2 li-ic">
                                    <a href="http://{{$entrada->user->linkedin}}"><i class="fab fa-linkedin"></i>

                                    </a>
                                </a>
                            @endif

                        </div>
                        <hr>
                        <p>{!! $entrada->texto !!}
                        </p>

                    </div>

                    <div class="align-content-center">
                         <p class="text-center">{{$entrada->created_at}} </p>
                        @if(Auth::guest() )

                        @elseif(Auth::user()->nick == $entrada->user->nick  || Auth::user()->hasRole('admin'))
                            <a class="pr-2 li-ic" href="{{ url('/foro/'.$entrada->id_entrada.'/editar')}}">
                                <button type="button" type="button" class="btn btn-primary mb-3"><h5>EDITAR ENTRADA</h5></button></a>
                               
                        @endif      
                    </div>



                </div>
            </div>

        <!--Puntuaciones-->
        <div class="content">
        @if(Auth::guest() )
            
            @else
            <hr>
            <h3>Puntuación</h3>
            <hr>
            Puntuacion media: {{ $entrada->media }}.<br>
            Total de votos: {{count($entrada->valorEntrada()->get())}}<br>
                @if($entrada->votacion(Auth::user()->id,$entrada->id_entrada) )
                    Tu valoración ha sido {{$entrada->valorEntrada()->get()->where('id_usuario', Auth::user()->id)->first()->valor}}

                    <form method="POST" action="{{ url("/foro/{$entrada->id_entrada}/desvalorar") }} ">
                        {{ method_field('PUT') }}
                        {!! csrf_field() !!}

                        <input type="text" name="id_entrada" id="id_entrada" value="{{$entrada->id_entrada}}" hidden>
                        <input type="text" name="id_usuario" id="id_usuario" value="{{Auth::user()->id}}" hidden>
                        <button  class="btn btn-danger d-block " type="submit"><h5>Deshacer valoración</h5></button>
                    </form>
                @else
                    <hr>
                    <h3>Puntuar</h3>
                    <hr>
                    
                    <form method="POST" action="{{ url("/foro/{$entrada->id_entrada}/valorar") }} ">
                        {{ method_field('PUT') }}
                        {!! csrf_field() !!}

                        <input type="text" name="id_entrada" id="id_entrada" value="{{$entrada->id_entrada}}" hidden>
                        <input type="text" name="id_usuario" id="id_usuario" value="{{Auth::user()->id}}" hidden>
                        <p class="valoracion clasificacion text-left" >
                            <input id="radio1" type="radio" name="valor" value="5">
                            <label class="valoracion" for="radio1">★</label>
                            <input id="radio2" type="radio" name="valor" value="4">
                            <label class="valoracion" for="radio2">★</label>
                            <input id="radio3" type="radio" name="valor" value="3">
                            <label  class="valoracion" for="radio3">★</label>
                            <input id="radio4" type="radio" name="valor" value="2">
                            <label class="valoracion" for="radio4">★</label>
                            <input id="radio5" type="radio" name="valor" value="1">
                            <label class="valoracion" for="radio5">★</label>
                        </p>
                        <button class="btn btn-success d-block" type="submit"><h5>Valorar</h5></button>
                    </form>
                    <hr>
                @endif
            <!-- Cambiar valoracion (Solo update) y mostramos el numero de estrellas 5★ -->
@endif

            <a id="comentarios"><hr class="" /></a>

            <div id="#comentarios" class="container">



                <div class="comments-list text-center text-md-left mb-5">

                    <div class="text-center mb-4">
                        <h3>Comentarios
                            <span class="badge blue">{{count($entrada->comentarioEntrada()->get())}}</span>
                        </h3>
                    </div>
                </div>


                @foreach($entrada->comentarioEntrada()->get() as $comentario)
                    <!--First row-->
                    <div class="row jumbotron">
                        <!--Image column-->
                        <div class="col-sm-12 text-center col-md-12">
                            <img src="{{ $comentario->usuario()->get()->first()->imagen }}" widht="150" height="150" class="avatar rounded-circle z-depth-1-half"><br><br>
                        </div>
                        <!--/.Image column-->
                        <!--Content column-->
                        <div class="col-sm-12 col-12 text-center">
                            <a>
                                <h4 class="font-weight-bold">{{ $comentario->usuario()->get()->first()->nick }}</h4>
                            </a>
                            <div class="mt-2 ">
                                <ul class="list-unstyled">
                                    <li class="comment-date">
                                        <i class="fa fa-clock-o "></i> {{ $comentario->created_at }}</li>
                                </ul>
                            </div>

                            <div class="grey-text">
                                {!! $comentario->comentario  !!}
                            </div>
                            @if(Auth::guest())
                            @elseif(Auth::user()->nick == $comentario->usuario()->get()->first()->nick || Auth::user()->hasRole('admin'))

                            <div class="row center-block" style="display: flex;align-items: center;">
                                <form method="POST" action="{{route("eliminarcomentarioentrada", $comentario) }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {!! csrf_field() !!}
                                    <input type="text" name="id_comentario" id="id_comentario" value="{{$comentario->id_comentario}}" hidden>

                                <button class="btn btn-danger btn-lg pull-right float-right mb-3 " style="margin-top:10px;" class="btn btn-primary"  type="submit"><h5>Eliminar comentario</h5></button>


                            </form>
                            </div>
                            @endif
                        </div>
                        <!--/.Content column-->
                    </div>

                    <!--/.First row-->


                @endforeach
            </div>

                </div>

        
        <br>
        @if(Auth::guest() )

            <h1 class="text-center">Para realizar un comentario tienes que iniciar sesión</h1>

            <div class="row center-block" style="display: flex;align-items: center;justify-content: center;">
                <a href="{{url('login')}}"><button class="btn btn-info btn-lg"><h4>Iniciar session</h4></button>&nbsp;</a>
            </div>

        @elseif(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))

                @if(count($entrada->comentarioEntrada()->get())<1)
                <p class="text-center">Aun no hay comentarios, puedes ser el primero!</p>
                @endif
                <br>
                <fieldset>
                    <legend>Añade un comentario</legend>
                <form method="POST" action=" {{  url("/foro/{$entrada->id_entrada}/comentario")}} ">
                {!! csrf_field() !!}
                {{ method_field('PUT') }}
                    <input type="text" name="id_entrada" id="id_entrada" value="{{$entrada->id_entrada}}" hidden>
                    <input type="text" name="id_usuario" id="id_usuario" value="{{Auth::user()->id}}" hidden>
                    
                    <div class="form-group">
                    <label for="comentario">Comentario:</label>
                    <textarea  class="form-control" name="comentario" id="comentario"></textarea>
        
            </div>
                    <br>
                    <button class="btn btn-success" type="submit"><h5>Comentar</h5></button>
                </form>
                </fieldset>
        @endif
        </div>
        <br><br>
</div>

    @endif


<!-- END MAIN CONTENT -->
@include('layouts.footer')