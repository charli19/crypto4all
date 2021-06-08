
@include('layouts.header')
<!-- MAIN CONTENT -->
<div class="container">

        <div class="row">

            <div class="col-md-8 col-md-offset-2" style="margin-top: 70px">
                <div class="panel panel-default">

                    <div class="panel-heading text-center" style="background-color: #4285f4; color: white">REGISTRO</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('nick') ? ' has-error' : '' }}">
                                <label for="nick" class="col-md-4 control-label"><i class="fab fa-odnoklassniki"></i></label>

                                <div class="col-md-6">
                                    <input placeholder="Introduzca su nick" id="nick" type="text" class="form-control" name="nick" value="{{ old('nick') }}" required autofocus>

                                    @if ($errors->has('nick'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('nick') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="nombre" class="col-md-4 control-label"><i class="fas fa-user"></i></label>

                                <div class="col-md-6">
                                    <input placeholder="Introduzca su nombre" id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label"><i class="fas fa-at"></i></label>

                                <div class="col-md-6">
                                    <input placeholder="Introduzca su correo electrónico" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label"><i class="fas fa-key"></i></label>

                                <div class="col-md-6">
                                    <input placeholder="Introduzca su contraseña" id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label"><i class="fas fa-key"></i></label>

                                <div class="col-md-6">
                                    <input placeholder="Confirme su contraseña" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <h6>Registrarse</h6>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- END MAIN CONTENT -->
@include('layouts.footer')




