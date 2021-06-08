@include('layouts.header')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" style="margin-top: 70px">
                <div class="panel panel-default">
                    <div class="panel-heading text-center" style="background-color: #4285f4; color:white">REINICIO DE CONTRASEÑA</div>

                    <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 control-label"><i class="fas fa-at"></i></label>

                            <div class="col-md-6">
                                <input placeholder="Introduzca su correo electrónico" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 control-label"><i class="fas fa-key"></i></label>

                            <div class="col-md-6">
                                <input placeholder="Introduzca la nueva contraseña" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 control-label"><i class="fas fa-key"></i></label>

                            <div class="col-md-6">
                                <input placeholder="Confirme su contraseña" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <h5>{{ __('Reiniciar contraseña') }}</h5>
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.footer')
