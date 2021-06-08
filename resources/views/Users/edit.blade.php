
@include('layouts.header')
<!-- MAIN CONTENT -->
<div class="container">
    @if(Auth::guest())

        <h1>Este usuario no deberia llegar aqui</h1>
        <a href="{{ url("login") }}"><button class="btn btn-lg btn-info">Ir al Login</button></a>
    @endif

    <h1 class="d-block text-center"> {{$user->nick}}</h1>
    <hr>
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

    <form method="POST" action=" {{ url('usuarios/editar') }} ">
    {{ method_field('PUT') }}
    {!! csrf_field() !!}

        <input type="text" name="id" id="id" value="{{$user->id}}" hidden>


        <div class="panel panel-headline col-md-12">
            <div class="panel-heading">
                <h3 class="text-center">Datos del perfil</h3>
            </div>
            <hr><br>
            <div class="panel-body">
                <div class="form-row">

                    <!-- Grid column -->
                    <div class="col-md-6">
                        <!-- Material input -->
                        <div class="md-form form-group">
                            <label style="font-size:15px;" for="nick">Nick</label><br>
                                <input  type="text" class="form-control" name="nick" id="nick" value="{{$user->nick}}" placeholder="Nick"><br>
                        </div>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-6">
                        <!-- Material input -->
                        <div class="md-form form-group">
                            <label style="font-size:15px;"  for="nombre">Nombre</label><br>
                            <input type="text" class="form-control" name="nombre" id="nombre" value="{{$user->nombre}}" placeholder="Tu nombre"><br>
                        </div>
                    </div>
                    <!-- Grid column -->
                    <div class="col-md-6">
                        <!-- Material input -->
                        <div class="md-form form-group">
                            <label  style="font-size:15px;" for="apellidos">Apellidos</label><br>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" value="{{$user->apellidos}}" placeholder="Apellidos"><br>
                        </div>
                    </div>

                    <!-- Grid column -->
                    <div class="col-md-6">
                        <!-- Material input -->
                        <div class="md-form form-group">
                            <label style="font-size:15px;"  for="email">Correo electrónico</label><br>
                            <input type="text" class="form-control" name="email" id="email" value="{{$user->email}}" placeholder="Email"><br>
                        </div>
                    </div>
                    <!-- Grid column -->
                    <div class="col-md-6">
                        <!-- Material input -->
                        <div class="md-form form-group">
                            <label style="font-size:15px;"  for="fecha_nacimiento">Fecha nacimiento</label><br>
                            <input  type="date" class="form-control"name="fecha_nacimiento" id="fecha_nacimiento" value="{{$user->fecha_nacimiento }}" placeholder="Fecha de nacimiento"><br>
                        </div>
                    </div>

                    <!-- Grid column -->
                    <div class="col-md-6">
                        <!-- Material input -->
                        <div class="md-form form-group">
                            <label style="font-size:15px;"  for="imagen">Imagen de usuario</label><br>
                            <input  type="text" class="form-control" name="imagen" id="imagen" value="{{ old( 'imagen', $user->imagen) }}" placeholder="URL de imagen"><br>
                        </div>
                    </div>
                &nbsp;
                <div>
                    <h3 class="text-center" style="margin-top:10px !important; ">Social</h3>
                    <hr><br>
                    <!-- Grid column -->
                    <div class="col-md-6">
                        <!-- Material input -->
                        <div class="md-form form-group">
                            <label style="font-size:15px;"  for="imagen">Página web</label><br>
                            <input type="text" class="form-control" name="web" id="web" value="{{ old( 'web', $user->web) }}" placeholder="URL de web"><br>
                        </div>
                    </div>

                    <!-- Grid column -->
                    <div class="col-md-6">
                        <!-- Material input -->
                        <div class="md-form form-group">
                            <label style="font-size:15px;"  for="imagen">Facebook</label><br>
                            <input type="text" class="form-control" name="facebook" id="facebook" value="{{ old( 'facebook', $user->facebook) }}" placeholder="URL de facebook"><br>
                        </div>
                    </div>
                    <!-- Grid column -->
                    <div class="col-md-6">
                        <!-- Material input -->
                        <div class="md-form form-group">
                            <label style="font-size:15px;"  for="imagen">Instagram</label><br>
                            <input type="text" class="form-control" name="instagram" id="instagram" value="{{ old( 'instagram', $user->instagram) }}" placeholder="URL de instagram"><br>
                        </div>
                    </div>
                    <!-- Grid column -->
                    <div class="col-md-6">
                        <!-- Material input -->
                        <div class="md-form form-group">
                            <label  style="font-size:15px;"  for="imagen">Twitter</label><br>
                            <input type="text" class="form-control" name="twitter" id="twitter" value="{{ old( 'twitter', $user->twitter) }}" placeholder="URL de twitter"><br>
                        </div>
                    </div>
                    <!-- Grid column -->
                    <div class="col-md-6">
                        <!-- Material input -->
                        <div class="md-form form-group">
                            <label style="font-size:15px;"  for="imagen">Google Plus</label><br>
                            <input type="text" class="form-control" name="google" id="google" value="{{ old( 'google', $user->google) }}" placeholder="URL de google plus"><br>
                        </div>
                    </div>
                    <!-- Grid column -->
                    <div class="col-md-6">
                        <!-- Material input -->
                        <div class="md-form form-group">
                            <label style="font-size:15px;"  for="imagen">Linkedin</label><br>
                            <input type="text" class="form-control" name="linkedin" id="linkedin" value="{{ old( 'linkedin', $user->linkedin) }}" placeholder="URL de linkedin"><br>
                        </div>
                    </div>


                </div>

            </div>
            <button type="submit" class="btn btn-primary btn-md float-right "><h4>Editar usuario</h4></button>

        </div>
        <br>
    </form>
</div><br>
<!-- END MAIN CONTENT -->
@include('layouts.footer')