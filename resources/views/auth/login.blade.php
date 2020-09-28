@extends('layouts.auth')

@section('content')
    

        <div class="image"   @if(Request::routeIs('login')) style=" background-image: url({{ asset('images/client/bg-landing.png')}}); background-size: cover; background-position: center; max-width: 100%" @endif>
            <img src="{{ asset('images/client/image-landing.svg')}}" alt="Landing">
        </div>
        <div class="card shadow-sm form__auth login">
            <div class="logo">
                <img src="{{ asset('images/client/logo_light.svg') }}" alt="Logo BPE Light">
            </div>
            <h2>Bienvenido,</h2>
            <h4 class="text-primary">Ingresa tus datos para continuar</h4>

            <form method="POST" action="{{ route('login') }}">
                @csrf 
                <div class="group-input">
                    <label for="dni">DNI</label>
                    <input type="text" id="dni" name="dni" class="input @error('dni') is-invalid @enderror" value="{{ old('dni') }}"  required autofocus>
                    @error('dni')
                    <div class="text-invalid">
                       {{ $message }} 
                    </div>
                    @enderror
                </div>
                <div class="group-input">
                    <span class="flex justity-between">
                        <label for="password">Contraseña</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-password">¿Olvide mi contraseña?</a>
                        @endif
                    </span>
                    <input type="password" id="password" name="password" class="input @error('password') is-invalid @enderror" value="{{ old('password') }}"  required>
                    @error('password')
                    <div class="text-invalid">
                       {{ $message }} 
                    </div>
                    @enderror
                </div>
                <div class="group-checkbox">
                    <label for="remember">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>
                            Recordarme
                        </span>
                    </label>
                </div>
                <button class="btn btn-primary btn-full">Ingresar</button>
                <div class="link">No tengo una cuenta. <a href="{{ route('register') }}" class="ml-1">Registrarse</a></div>
            </form>

        </div>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
