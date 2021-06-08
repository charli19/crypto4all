
@include('layouts.header')
<!-- MAIN CONTENT -->
<div class="container">
    @if(Auth::guest())
        <!--Vista de usuario no registrado-->

        <h1 class="text-center">Para ver el ranking de usuarios tienes que iniciar sesión</h1>
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

    @elseif(Auth::user()->hasRole('user'))
    <h1 class="text-center">No tienes tantos privilegios</h1>
    @else
        <!--Vista de usuario registrado-->


    <div class="row">
            <div class=" panel-headline col-md-12">
                <div class="panel-heading">
                @if(Auth::user()->hasRole('admin'))
                    <a style="margin-top: 20px" class="btn btn-primary pull-right d-block float-right mb-3" href=" {{url("/nuevousuario")}}"><h4>Añadir</h4></a>
                @endif
                    <h3 class="panel-title" style="text-align:center"><h1 class="d-block">{{ $title }}</h1></h3>

                </div>
                <br>

                <div class="panel-body">
                    <div class="row">
                        <div>
                            <table id="users" class="display" style="width:100%">
                                <thead  class="blue lighten-3">
                                <tr>
                                    <th><h5>Posicion</h5></th>
                                    <th><h5>NICK</h5></th>
                                    <th><h5>NOMBRE</h5></th>
                                    <th><h5>EMAIL</h5></th>
                                    <th><h5>COMENTARIOS</h5></th>

                                    @if(Auth::user()->hasRole('admin'))
                                        <th><h5>EDITAR</h5></th>
                                        <th><h5>ELIMINAR</h5></th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($users as $user)
                                    <tr>
                                        <td><h5><a href="{{ url("/usuarios/$user->nick") }}">  {{ $user->id }}</a></h5></td>
                                        <td><h5>{{ $user->nick }}</h5></td>
                                        <td><h5>{{ $user->nombre }} {{$user->apellidos }} </h5></td>
                                        <td><h5>{{ $user->email }}</h5></td>
                                        <td><h5> {{ count($user->comentarioEntrada()->get()) }}</h5></td>

                                        @if(Auth::user()->hasRole('admin'))
                                            <td><h5>
                                                    <a href="{{ url('/usuarios/'.$user->nick.'/editar') }}">E</a>
                                                </h5></td>
                                            <td><h5>
                                                    <form method="POST" action="{{route("eliminarusuario", $user) }}" method="POST">
                                                        {{ method_field('DELETE') }}
                                                        {!! csrf_field() !!}
                                                        <button type="submit">Eliminar</button>
                                                    </form>
                                                </h5></td>
                                        @endif
                                    </tr>


                                @empty
                                    No hay usuarios
                                @endforelse

                                </tbody>
                                <tfoot  class="blue lighten-3">
                                <tr>
                                    <th><h5>ID</h5></th>
                                    <th><h5>NICK</h5></th>
                                    <th><h5>NOMBRE</h5></th>
                                    <th><h5>EMAIL</h5></th>
                                    <th><h5>COMENTARIOS</h5></th>

                                    @if(Auth::user()->hasRole('admin'))
                                        <th><h5>EDITAR</h5></th>
                                        <th><h5>ELIMINAR</h5></th>
                                    @endif
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>





        <script>
            $(document).ready(function() {
                $('#users').DataTable( {
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                    }
                } );
            } );
        </script>

    @endif
</div><br><br>
<!-- END MAIN CONTENT -->
@include('layouts.footer')
