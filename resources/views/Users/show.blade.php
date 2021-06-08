
@include('layouts.header')
<!-- MAIN CONTENT -->
<div class="container" style="margin-top:15px;margin-bottom:15px;">
    @if(Auth::guest() )
        <!--Vista de usuario no registrado-->

        <h1 class="text-center">Para ver un usuario tienes que iniciar sesión</h1>
        <div class="row center-block" style="display: flex;align-items: center;justify-content: center;">

            <a href="{{url('login')}}"><button class="btn btn-info btn-lg"><h4>Iniciar session</h4></button>&nbsp;</a>
        </div>
        <br>

        <h3 class="text-center">Puedes ver estas páginas</h3>
        <div class="row center-block" style="display: flex;align-items: center;justify-content: center;">
            <a href="{{url('criptomonedas')}}"><button class="btn btn-primary btn-lg "><h4>CRIPTOMONEDAS</h4></button>&nbsp;</a>
            <a href="{{url('/')}}"><button class="btn btn-warning btn-lg" style="color:white;"><h4>DASHBOARD</h4></button> &nbsp;
                <a href="{{url('foro')}}"><button class="btn btn-green btn-lg"><h4>FORO</h4></button>&nbsp;
        </div>
        @else


            <!--<a href="{{ route('usuarios') }}"><button type="button" class="btn btn-primary pull-left float-left mb-3"><h4>Volver</h4></button></a>-->
            @if(Auth::user()->nick==$user->nick || Auth::user()->hasRole('admin'))

                <a href="{{ url('/usuarios/'.$user->nick.'/editar')}}"><button type="button" class="btn btn-primary pull-right float-right mb-3"><h4>Editar</h4></button></a>
            @endif
        </div>
<div class="container">


        <div class="">
            <div class="jumbotron p-5 text-center text-md-left author-box">
            <!-- Name -->
            <h3 class="h3-responsive text-center font-weight-bold dark-grey-text">{{ucfirst($user->nick)}}</h3>
            <hr>
            <div class="row d-flex justify-content-center">
                <!-- Avatar -->
                <div class="col-10 col-md-2 mb-md-0 mb-4 ">
                        <img src="{{$user->imagen }}" class="img-circle img-fluid rounded-circle z-depth-2 avatar d-flex justify-content-center">

                </div>
                <!-- Author Data -->
                <div class="col-md-8">
                    <h5 class="font-weight-bold dark-grey-text mb-3">
                        <strong> {{ $user->nombre }} {{ $user->apellidos }}</strong>
                    </h5>
                    <div class="personal-sm pb-3">




                        <div class="personal-sm pb-3">
                            @if($user->web)
                                <a class="pr-2 email-ic">
                                    <a href="http://{{$user->web}}"><i class="fa fa-home mr-2"> </i></a>
                                </a>
                                @endif
                            @if($user->facebook)
                                <a class="pr-2 fb-ic">
                                    <a href="http://{{$user->facebook}}"><i class="fab fa-facebook-square"></i>

                                    </a>
                                </a>
                                @endif
                            @if($user->instagram)
                                <a class="pr-2 tw-ic">
                                    <a href="http://{{$user->instagram}}"><i class="fab fa-instagram"></i>

                                    </a>
                                </a>
                                @endif
                            @if($user->twitter)
                                <a class="pr-2 tw-ic">
                                    <a href="http://{{$user->twitter}}"><i class="fab fa-twitter"></i>

                                    </a>
                                </a>
                                @endif
                            @if($user->google)
                                <a class="pr-2 gplus-ic">
                                    <a href="http://{{$user->google}}"><i class="fab fa-google-plus-square"></i>

                                    </a>
                                </a>
                                @endif
                            @if($user->linkedin)
                                <a class="pr-2 li-ic">
                                    <a href="http://{{$user->linkedin}}"><i class="fab fa-linkedin"></i>

                                    </a>
                                </a>
                            @endif

                        </div>


                    </div>

                </div>



            </div>
        </div>
        </div>


    @if(Auth::user()->nick==$user->nick)
        @if(count($user->criptomonedaFavorita()->get())>0)
            <h3 class="">Mis criptomonedas favoritas:</h3>
            <ul>
            @foreach ($user->criptomonedaFavorita()->get() as $crip)
                    <a href="{{url('/criptomonedas/'.$user->criptomoneda($crip->id_criptomoneda))}}"><li><h4>{{$user->criptomoneda($crip->id_criptomoneda)}}</h4></li></a>
                @endforeach
            </ul>
        @endif
        <hr>
        <h3 class="text-cetnter">Mis entradas:</h3>
    @else

        <h3  class="text-center">Entradas de {{ $user->nick }}:</h3>

    @endif
        <hr>
    @if(count($user->entrada()->get())<1)
        <h4 class="text-center">Este usuario aun no tiene entradas</h4>
    @else
        @forelse($user->entrada()->get() as $entrada)
            <div class="panel text-center text-md-left">
                <!-- Name -->

                <div class="row text-center d-flex justify-content-center">

                     <!-- Author Data -->
                    <div class="col-12">


                        <a href=" {{ url("/foro/{$entrada->id_entrada}") }}">
                            <h3 class="h3-responsive text-center font-weight-bold dark-grey-text">{{ucfirst($entrada->titulo)}}</h3>
                        </a>
                        <p>{!! $entrada->texto !!}
                        </p>
                        <hr>
                        <p class="margin-top20 d-inline">
                            <a href=" {{ url("/foro/{$entrada->id_entrada}") }}">Seguir leyendo...</a> | <a href="{{ url('/foro/'.$entrada->id_entrada.'#comentarios') }}">Comentarios ({{count($entrada->comentarioEntrada()->get())}})</a> | {{ $entrada->created_at }}</p>
                        <a href="{{ url('/foro/'.$entrada->id_entrada.'#valoraciones') }}">
                            <p>Ver valoracion media ({{$entrada->media }} / {{count($entrada->valorEntrada()->get())}}) - Media/Total votos</p>
                        </a>


                        @if(Auth::guest() )
                        @elseif(Auth::user()->nick == $entrada->user->nick  || Auth::user()->hasRole('admin'))
                            <div class="row center-block" style="display: flex;align-items: center;justify-content: center;">
                                <a class="pr-2 li-ic" href="{{ url('/foro/'.$entrada->id_entrada.'/editar')}}">
                                    <button type="button" type="button" class="btn btn-primary pull-right float-right mb-3"><h5>EDITAR ENTRADA</h5></button></a>
                            </div>

                        @endif





                    </div>

                </div>
            </div>
            <hr>
        @empty
            No hay entradas
        @endforelse

    @endif
    @endif
</div><br><br>
<!-- END MAIN CONTENT -->
@include('layouts.footer')