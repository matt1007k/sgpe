@extends('layouts.auth')
@section('title', 'Reestablecer contraseña')

@section('content')
<div class="message">
    <div class="card">
        <h4>Reestablecer contraseña</h4>
        @if (session('status'))
            <div class="alert alert-success">
                <i class="material-icons icon">warning</i>
                <div>
                    <h4>Mensaje del sistema</h4>
                {{ session('status') }}
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="group-input">
                <label for="email">Correo Electrónico</label>

                <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Ingrese su correo electrónico" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-text">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-full">
                    {{ __('Enviame un correo') }}
                </button>
            </div>
        </form>
    </div>
       
</div>
@endsection
