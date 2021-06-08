
@include('layouts.header')
<!-- MAIN CONTENT -->
<div class="container">
    <div class="row">
        <a href="{{url('/foro/nuevo')}}"><button type="button" style="margin-top:10px;" class="btn btn-primary d-inline pull-right "><h4>Añadir entrada</h4></button></a><br>
    </div>
<br>
<div class="panel panel-headline col-md-12">
            <div class="panel-heading">
                <h1 class="panel-title" style="text-align:center">Foro</h1>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div>
                    <table id="tabla"  class="display" style="width:100%">
        <thead>
        <tr>
            <td></td>
        </tr>
        </thead>
        <tbody>


        @forelse($entradas as $entrada)
            <tr>
                <td>

            <div class=" text-center text-md-left">
                <!-- Name -->

                <div class="row text-center d-flex justify-content-center">
                    <!-- Avatar -->
                    <div class="col-10 col-md-2 mb-md-0 mb-4">
                        <a  href="{{ url('/usuarios/'.$entrada->user->nick) }}"><h3 class="font-weight-bold dark-grey-text mb-3 text-center">
                            <strong>{{$entrada->user->nick}}</strong>
                        </h3>
                        <img src="{{$entrada->user->imagen }}"  class="img-circle img-fluid rounded-circle z-depth-2 avatar"></a>
                    </div>

                    <!-- Author Data -->
                    <div class="col-12 col-md-10">


                        <a href=" {{ url("/foro/{$entrada->id_entrada}") }}">
                            <h2 class=" text-centerdark-grey-text">{{ucfirst($entrada->titulo)}}</h2>
                        </a>
                        <hr>
                        <h4>{!! $entrada->texto !!}
                        </h4>
                        <hr>
                        <h5 class="margin-top20 d-inline">
                            <a href=" {{ url("/foro/{$entrada->id_entrada}") }}">Seguir leyendo...</a> | <a href="{{ url('/foro/'.$entrada->id_entrada.'#comentarios') }}">Comentarios ({{count($entrada->comentarioEntrada()->get())}})</a> | {{ $entrada->created_at }}</h5>
                        <a href="{{ url('/foro/'.$entrada->id_entrada.'#valoraciones') }}">
                            <h5>Ver valoracion media ({{$entrada->media }} / {{count($entrada->valorEntrada()->get())}}) - Media/Total votos</h5>
                        </a>


                    @if(Auth::guest() )
                        @elseif(Auth::user()->nick == $entrada->user->nick  || Auth::user()->hasRole('admin'))
                            <div class="row center-block" style="display: flex;align-items: center;justify-content: center;">
                                <a class="pr-2 li-ic" href="{{ url('/foro/'.$entrada->id_entrada.'/editar')}}">
                                    <button type="button" type="button" style="margin-top:10px;" class="btn btn-primary mb-3"><h4>EDITAR ENTRADA</h4></button></a>
                            </div>

                        @endif





                    </div>

                </div>
            </div>



            <hr>

            </td>
            </tr>

        @empty
            No hay entradas
        @endforelse


        </tbody>



    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<br>
    <script>
        $(document).ready(function() {
            $('#tabla').DataTable( {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            } );
        } );
    </script>

<!-- END MAIN CONTENT -->
@include('layouts.footer')