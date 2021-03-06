@extends('layouts.client')
@section('title', 'Registrar nuevo usuario')

@section('content')
<div class="container">
    <div class="content mt-0">
        <div class="flex align-center">
            <a href="{{ route('users.index') }}">
                <i class="material-icons-two-tone">keyboard_arrow_left</i>
            </a>
            <h2>Registrar nuevo usuario</h2>
       </div>
    </div>    
    <div class="content">
        <div class="card grid">
            <div class="cols-4 sm:cols-8 md:cols-6">
                <h3 class="mb-1">Datos del usuario</h3>
                <p class="text-light-blue">Esta es la información para el contacto y verificación de los datos. </p>
            </div>
            <div class="cols-4 sm:cols-8 md:cols-6">
                <x-form method="post" :action="route('users.store')">
                    @include('admin.users.partials.form', ['btnText' => 'Guardar'])
                </x-form>
            </div>
        </div>
    </div>
</div>    
@endsection

