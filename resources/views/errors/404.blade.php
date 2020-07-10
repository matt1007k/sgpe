@extends('layouts.auth')

@section('title', "Página no encontrada")

@section('content')
<div class="bg-white message ">
    <div class="circles"></div>
    <div class="container flex flex-col sm:flex-row align-center justify-between">
        <div class="flex flex-col justify-enter align-center w-full">
            <div class="number flex font-bold">
                <span class="text-primary">4</span>
                <span class="text-dark-blue">0</span>
                <span class="text-primary">4</span>
            </div>   
            <div class="flex flex-col justify-center text-center">
                <h2>Página no encontrada</h2>
                <h4 class="text-light-blue">Verifique que esta página existe</h4>
                <div class="flex justify-center ">
                    <a href="{{ url('/') }}" class="mt-4 btn btn-primary" >Regresar al inicio</a>
                </div>

            </div>
        </div>
        <div>
            <img src="{{ asset('images/client/person.svg') }}" height="" alt="Person">
        </div>
    </div>
</div>
@endsection