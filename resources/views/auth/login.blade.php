@extends('layouts.auth')
@section('title', 'Iniciar Sesión')

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
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="mt-2 forgot-password">¿Olvide mi contraseña?</a>
                        @endif
                <div class="link">No tengo una cuenta. <a href="{{ route('register') }}" class="ml-1">Registrarse</a></div>
            </form>

        </div>

@endsection
