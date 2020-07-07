<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema de Boletas de Pago Electrónica - @yield('title', 'Inicio')</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <livewire:styles>
        
     <!-- Scripts -->
     {{-- <script src="{{ asset('js/client.js') }}"></script> --}}
</head>
<body> 
    <main class="landing-auth">
        @yield('content')
    </main>
    <livewire:scripts>
</body>
</html>