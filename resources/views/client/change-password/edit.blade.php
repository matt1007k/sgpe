@extends('layouts.client')

@section('title', 'Editar información de cuenta')

@section('content')
<div class="container">
    <div class="content">
        <div class="flex align-center">
            <a href="{{ route('profile') }}">
                <i class="material-icons-two-tone">keyboard_arrow_left</i>
            </a>
            <h2>
                Cambiar contraseña
            </h2>
       </div>
    </div>
    <div class="card grid md:mb-2">
        <div class="cols-4 sm:cols-8 md:cols-6">
            <h3 class="mb-1">Nueva contraseña</h3>
            <p class="text-light-blue">La contraseña se actualizará con una propia.</p>
        </div>
        <div class="cols-4 sm:cols-8 md:cols-6">
            <x-form method="put" :action="route('change-password.update', $user)">
                @include('client.change-password.partials.form', ['btnText' => 'Cambiar'])
            </x-form>
        </div>
    </div>
</div>
@endsection