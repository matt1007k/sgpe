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
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <livewire:styles>
        
     <!-- Scripts -->
     {{-- <script src="{{ asset('js/client.js') }}"></script> --}}
</head>
<body> 
    @yield('content')
    <livewire:scripts>
</body>
</html>