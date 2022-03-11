@extends('layouts.app')

@section('content')

<div class="container pt-5">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-2 col-lg-3 col-xl-4"></div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-4">
            <div class="">
                <div class="card-body text-center">
                    <div>
                        <img src="{{asset('dashboard/Capa.png')}}" class="w-25 card-img-top" alt="...">
                    </div>
                    <div class="mt-3 mb-5">
                        <span class="heading_1" >SAT</span>
                    </div>
                    <div>
                        <span class="heading_1">Te damos la bienvenida al Sistema</span>
                    </div>
                    <div class="mb-3">
                        <span class="heading_1">Automático de trazabilidad</span>
                    </div>
        
                </div>
                <form method="POST" action="{{ route('login') }}">
                    <ul class="list-group list-group-flush" style="padding-left: 30px;">
                        <li class="list-group-item border-bottom-0">
                            <label for="email" >Correo electrónico</label>
                        </li>
                        <li class="list-group-item border-bottom-0">
                            <input id="email" type="email" class="input_css form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Ingresa tu correo electrónico (ej. jrubio@correo.cl)" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </li>
                        <li class="list-group-item border-bottom-0">
                            <label for="email" >Contraseña</label>
                        </li>
                        <li class="list-group-item border-bottom-0">
                            <div class="input-group mb-3">
                                <input id="pass_log_id" type="password" class="input_css form-control @error('password') is-invalid @enderror" name="password" placeholder="Ingresa tu contraseña" required autocomplete="current-password">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">
                                        <!-- <i class="fa-solid fa-eye-slash"></i> -->
                                        <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
                                    </span>
                                </div>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </li>
                        <li class="list-group-item border-bottom-0">
                            <button type="submit" class="btn btn-primary w-100">
                                Iniciar sesión
                            </button>
                        </li>
                        <li class="list-group-item border-bottom-0 text-center">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </li>
                    </ul>
                </form>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-2 col-lg-3 col-xl-4"></div>
    </div>
</div>

<script>
 $("body").on('click', '.toggle-password', function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $("#pass_log_id");
  if (input.attr("type") === "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }

})
</script>
@endsection
