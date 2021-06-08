@include('layouts.header')
<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" style="margin-top: 70px">
                <div class="panel panel-default">
                    <div class="panel-heading text-center" style="background-color: #4285f4; color:white">REINICIAR CONTRASEÑA</div>

                    <div class="panel-body">

    <div class="card-body">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group row">
            <label for="email" class="col-md-4 control-label"><i class="fas fa-at"></i></label>

            <div class="col-md-6">
                <input placeholder="Introduzca su correo electrónico" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    <h5>{{ __('Enviar enlace de restablecimiento de contraseña') }}</h5>
                </button>
            </div>
        </div>
    </form>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.footer')