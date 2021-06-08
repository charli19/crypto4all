
@include('layouts.header')
<!-- MAIN CONTENT -->

<div class="container" style="margin-top:20px;">
    @if(Auth::guest() || Auth::user()->hasRole('user'))

        <!--Vista de usuario no registrado-->

        <h1 class="text-center">Para ver el ranking de usuarios tienes que iniciar sesión</h1>
        <div class="row center-block" style="display: flex;align-items: center;justify-content: center;">

            <button class="btn btn-info btn-lg">Iniciar session</button>&nbsp;
        </div>
        <br>

        <h3 class="text-center">Puedes ver estas páginas</h3>
        <div class="row center-block" style="display: flex;align-items: center;justify-content: center;">
            <button class="btn btn-primary btn-lg ">CRIPTOMONEDAS</button>&nbsp;
            <button class="btn btn-warning btn-lg" style="color:white;">DASHBOARD</button> &nbsp;
            <button class="btn btn-green btn-lg">FORO</button>&nbsp;
        </div>


    @elseif(Auth::user()->hasRole('admin'))

        <div class="panel panel-headline col-md-12">
            <div class="panel-heading">
        <a class="btn btn-primary pull-right float-right mb-3" href="{{ route('usuarios') }}"><h4>Volver</h4></a>
        <h1 clasS="d-block"> Creacion de Usuario </h1>


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

        <hr>
        <!-- Extended material form grid -->
        <form method="POST" action=" {{ url('usuarios/crear') }} ">
            {{ method_field('PUT') }}
            {!! csrf_field() !!}
            <!-- Grid row -->
            <div class="form-row">
                <!-- Grid column -->
                <div class="col-md-6">
                    <!-- Material input -->
                    <div class="md-form form-group">
                        <input type="email" class="form-control" id="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email">
                        <label for="inputEmail4MD">Email</label>
                    </div>
                </div>
                <!-- Grid column -->


                <!-- Grid column -->
                <div class="col-md-6">
                    <!-- Material input -->
                    <div class="md-form form-group">
                        <input type="text" class="form-control" id="nombre" name="nombre" id="nombre" value="{{ old('nombre') }}" placeholder="Tu nombre">0
                        <label for="inputAddress2MD">Nombre</label>
                    </div>
                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->

            <!-- Grid row -->
            <div class="row">
                <!-- Grid column -->
                <div class="col-md-6">
                    <!-- Material input -->
                    <div class="md-form form-group">
                        <input type="text" class="form-control" name="nick" id="nick" value="{{ old('nick') }}" placeholder="Tu apodo">
                        <label for="inputAddressMD">Nick</label>
                    </div>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-6">
                    <!-- Material input -->
                    <div class="md-form form-group">
                        <input type="password" class="form-control" id="password" name="password" id="password" placeholder="Password">
                        <label for="inputPassword4MD">Password</label>
                    </div>
                </div>
                <!-- Grid column -->


            </div>
            <!-- Grid row -->

                <button type="submit" class="btn btn-primary btn-lg"><h4> Crear usuario </h4></button>
        </form>
        <!-- Extended material form grid -->

            </div>
        </div>

    @endif
</div>
<!-- END MAIN CONTENT -->
@include('layouts.footer')