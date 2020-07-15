@extends('layouts.client')

@section('content')
<div class="container">
    <div class="content">
        <h2 class="mb-2">Tablero de resumen</h2>

        <h3> 
            <span class="font-medium">
                Bienvenido 
            </span>
            <span class="text-dark-blue-500 text-capitalize font-bold">
                {{ Auth::user()->name }},
            </span>
        </h3>
        <p class="mb-2 text-dark-blue">Revisa el resumen de tus actividades.</p>
        
        @include('admin.partials.items-count')

        <div class="grid mt-2">
            @include('admin.partials.graph')
            @include('admin.partials.email')
        </div>
    </div>
</div>
@endsection
