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
                Editar información
            </h2>
       </div>
    </div>
    <div class="card grid md:mb-2">
        <div class="cols-4 sm:cols-8 md:cols-6">
            <h3 class="mb-1">Datos del usuario</h3>
            <p class="text-light-blue">Esta es la información para el contacto de tu cuenta.</p>
        </div>
        <div class="cols-4 sm:cols-8 md:cols-6">
            <x-form method="put" :action="route('profile.update', $user)">
                @include('client.profile.partials.form', ['btnText' => 'Editar'])
            </x-form>
        </div>
    </div>
</div>
@endsection