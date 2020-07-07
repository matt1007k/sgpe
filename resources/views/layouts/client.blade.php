<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistema de Boletas de Pago Electrónica - @yield('title', 'Inicio')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/client.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone"
      rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <livewire:styles>
    @stack('styles')
</head>
<body >
    {{-- <div id="app"> --}}
        
        @include('partials.client.navbar')

        <main class="py-4">
            @yield('content')
        </main>

    {{-- </div> --}}
    @include('partials.messages.alert-floating')
    <livewire:scripts>
    @stack('scripts')
</body>
</html>
