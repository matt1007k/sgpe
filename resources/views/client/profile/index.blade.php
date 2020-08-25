@extends('layouts.client')
@section('title', 'Perfil')

@section('content')
<div class="container">
    <div class="content">
        <div class="flex align-center">
            <a href="{{ url()->previous() }}">
                <i class="material-icons-two-tone">keyboard_arrow_left</i>
            </a>
            <h2>Perfil</h2>
       </div>
    </div>
    <div class="content grid justify-self-center">
        <div class="card card-profile bg-dark cols-4 sm:cols-8 md:cols-9">
            
            <div class="flex flex-col justify-center align-center">
                <div class="avatar avatar-xl">
                    <!-- <div class="avatar&#45;default"> -->
                    <!--     <i class="material&#45;icons&#45;two&#45;tone">face</i> -->
                    <!-- </div> -->
                    <div class="avatar-image">
                        <img src="https://e7.pngegg.com/pngimages/7/618/png-clipart-man-illustration-avatar-icon-fashion-men-avatar-face-fashion-girl.png" alt="Avatar">
                    </div>
                </div> 
                <h3 class="mt-2 text-white">{{ Auth::user()->name }}</h3>
                <div class="{{ Auth::user()->role === 'user' ? 'mb-0' : 'mb-4' }}">
                    <livewire:users.show-status :status="Auth::user()->status" />
                </div>
                
                @if(Auth::user()->role === 'user')
                <div class="flex justify-center mt-2 mb-4">
                    <div class="payment-count text-center">
                        <h2 class="text-white">{{ $payments_count }}</h2>
                        <p class="headline text-light-blue">Pagos recibidos este {{ date('Y') }}</p>
                    </div>
                    <div class="ml-4 year-count text-center">
                        <h2 class="text-white">{{ $years_count }}</h2>
                        <p class="headline text-light-blue">Años pagados</p>
                    </div>
                </div>
                @endif
            </div>
            
            <div class="card-footer-float flex flex-wrap justity-between flex-col sm:flex-row">

                <div class="flex">
                    <span class="badge badge-primary badge-sm flex justify-center align-center" style="height: 32px; width: 32px">
                        <i class="material-icons-two-tone">credit_card</i>
                    </span>
                    <span class="ml-2">
                        <span class="headline">{{ Auth::user()->dni }}</span>
                        <p class="text-light-blue text-sm">DNI</p>
                    </span>
                </div>
                <div class="flex mt-2 sm:mt-0">
                    <span class="badge badge-primary badge-sm flex justify-center align-center" style="height: 32px; width: 32px">
                        <i class="material-icons-two-tone">email</i>
                    </span>
                    <span class="ml-2">
                        <span class="headline">{{ Auth::user()->email }}</span>
                        <p class="text-light-blue text-sm">Correo Electrónico</p>
                    </span>
                </div>
                <div class="flex mt-2 sm:mt-0">
                    <span class="badge badge-primary badge-sm flex justify-center align-center" style="height: 32px; width: 32px">
                        <i class="material-icons-two-tone">smartphone</i>
                    </span>
                    <span class="ml-2">
                        <span class="headline">
                            {{ Auth::user()->phone }}
                        </span>
                        <p class="text-light-blue text-sm">Teléfono o Celular</p>
                    </span>
                </div>

            </div>
        </div>
        <div class="card cols-4 sm:cols-8 md:cols-3 align-self-start">
            <h4 class="mb-4 text-center">Puedes cambiar la información de tu cuenta.</h4>
            <div class="flex flex-row md:flex-col ">
                <a href="{{ route('profile.edit') }}" class="mb-2 btn btn-primary btn-full text-center">Editar información</a>
                <a href="#" class="mb-2 ml-2 md:ml-0 text-center btn btn-outline-primary btn-full">Cambiar contraseña</a>
            </div>
        </div>
    </div>
</div>
@endsection
