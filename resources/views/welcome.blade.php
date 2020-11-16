@extends('layouts.pages')
@section('content')
    <div class="bg-hero"></div>
    <div class="hero-info">
        <div class="info">
            <div class="info-title">Contáctanos</div> 
            <div class="info-content">
                <div class="item-icon">
                    <i class="material-icons">phone</i>
                    <span>(066) 251123</span>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-header container">
        <div class="hero-head">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('images/client/logo_light.svg') }}" alt="Logo bpe">
            </a>
            <div class="menu">
                <a href="{{ route('login') }}">Ingresar</a>
                <a href="{{ route('register') }}">Registrarse</a>
            </div>
        </div>
        <div class="hero-section">
            <div class="hero-content">
                <h1>Boletas de Pago Electrónica</h1>
                <p class="hero-paragraph">Recibe y observa tus boletas de pago electrónica cuando lo necesites.</p>
                <div class="hero-actions">
                    <a href="{{ route('login') }}" class="btn btn-primary">Ingresar Ahora</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary">Registrarse</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="{{ asset('images/client/image-landing.svg')}}" alt="Landing">
            </div>
        </div>
    </div>  
@endsection
