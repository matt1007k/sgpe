<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistema de Boletas de Pago Electrónica - @yield('title', 'Inicio')</title>
    <meta name="description" content="BOLETAS DREA, BOLETAS DREAYAC,BOLETAS DREAYACUCHO, Boletas de Pago Electrónica de la Dirección Regional de Educación de Ayacucho ,  Boletas de Pago Electrónica de la Dirección Regional de Educación, Educación" />
    <meta name="keywords" content="DREA, DRE AYAC, DREAYACUCHO, BPE,Boletas de Pago Electrónica de la Dirección Regional de Educación de Ayacucho,  Boletas de Pago Electrónica de la Dirección Regional de Educación, Educación" />
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/client.js') }}" defer></script> --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone"
    rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
        <livewire:styles>
        @stack('css')
    </head>
    <body>
        <div id="app" style="width: 100%;
        height: 100vh;">
            <div class="container-layout">
                
                @include('partials.navbar')
                
                <main class="py-4">
                    @yield('content')
                </main>
                
                @include('partials.footer')
            </div>
            @include('partials.alert-floating')
        </div>
    <livewire:scripts>
        @stack('js')
</body>
</html>
