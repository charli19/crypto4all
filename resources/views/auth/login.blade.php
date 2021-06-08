@include('layouts.header')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" style="margin-top: 70px">
                <div class="panel panel-default">
                    <div class="panel-heading text-center" style="background-color: #4285f4; color:white">INICIO DE SESIÓN</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label"><i class="fas fa-at"></i></label>

                                <div class="col-md-6">
                                    <input placeholder="Introduzca su correo electrónico" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

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
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <h6>Iniciar sesión</h6>
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        <h6>Recuperar contraseña</h6>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.footer')