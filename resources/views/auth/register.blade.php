@extends('layouts.auth')
@section('title', 'Crear una cuenta')

@section('content')
        <div class="how">
            <div class="card">
                <h3>¿Cómo crear una cuenta?</h3>
                <section>
                    <ul class="list-group mt-4">
                        <li class="list-item">
                            <div class="number">1</div>
                            <p>
                                Ingresa tus datos para registrarte.
                            <p>
                        </li>
                        <li class="list-item">
                            <div class="number">2</div>
                            <p>
                                Recibe una notificación a correo, con los datos de tu cuenta.     
                            </p>
                        </li>
                        <li class="list-item">
                            <div class="number">3</div>
                            <p>
                                Completa tus datos en la sección de <a href="{{ route('login') }}"> ingresar</a>. 
                            </p>
                        </li>
                        <li class="list-item">
                            <div class="number">4</div>
                            <p>
                                Finalmente, observa tus boletas de pago.
                            </p>
                        </li>
                    </ul>
                </section> 
                <div class="note">
                    <i class="icon">*</i>
                    <p>
                        Tu dirección de correo y número de (teléfono o celular) ingresado debe de existir, para recibir los datos de tu cuenta u otras actualizaciones.
                    </p>

                </div>

            </div>
        </div>
        <div class="card shadow-sm form__auth register">
            <div class="logo">
                <img src="{{ asset('images/client/logo_light.svg') }}" alt="Logo BPE Light">
            </div>
            <h2>Crear una cuenta,</h2>
            <h4 class="text-primary">Consulta tus datos para crear una cuenta.</h4>

            <form method="POST" action="{{ route('register') }}">
                @csrf 
                <livewire:code-verified.search-users></livewire:code-verified.search-users>
                {{-- <div class="group-input">
                    <label for="name">Nombre Completo</label>
                    <input type="text" id="name" name="name" class="input"  value="{{ old('name') }}"  required autofocus>
                    @error('name')
                    <div class="text-invalid">
                       {{ $message }} 
                    </div>
                    @enderror
                </div> --}}
                {{-- <div class="group-input code">
                    <div class="input1 w-full md:w-1/2">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"  class="input">
                        @error('email')
                        <div class="text-invalid">
                        {{ $message }} 
                        </div>
                        @enderror
                    </div>
                    <div class="input2">
                        <label for="phone">Telefóno o Celular</label>
                        <input type="text" id="phone" name="phone" class="input"  value="{{ old('phone') }}" required>                        
                        @error('phone')
                        <div class="text-invalid">
                        {{ $message }} 
                        </div>
                        @else
                        <span class="help-text">Ejm. 970 000 000</span>
                        @enderror
                    </div>
                </div>
                <div class="group-checkbox">
                    <label for="accept">
                        <input type="checkbox" name="accept" id="accept" {{ old('accept') ? 'checked' : '' }}>

                        <span>
                        Acepto los  <a href="#" class="ml-1"> Términos y Condiciones</a>
                        </span>
                    </label>
                </div>

                <button class="btn btn-primary btn-full">Registrarse</button> --}}
                <div class="link">Ya tengo una cuenta. <a href="{{ route('login') }}" class="ml-1">Ingresar</a></div>
            </form>

        </div>


@endsection
