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
    <div class="content grid">
        <div class="card card-profile bg-light-primary-opacity-20 cols-4 sm:cols-8 md:cols-12">
            <a href="#" class="btn btn-outline-primary" style="position: absolute;top: 20px; right:20px;">Editar</a>
            <div class="flex flex-col justify-center align-center">
                <div class="avatar avatar-xl">
                    {{-- <div class="avatar-default">
                        <i class="material-icons-two-tone">face</i>
                    </div> --}}
                    <div class="avatar-image">
                        <img src="https://e7.pngegg.com/pngimages/7/618/png-clipart-man-illustration-avatar-icon-fashion-men-avatar-face-fashion-girl.png" alt="Avatar">
                    </div>
                </div> 
                <h3 class="mt-2">{{ Auth::user()->name }}</h3>
                <livewire:users.show-status :status="Auth::user()->status" />
                
                <div class="flex justify-center mt-4 mb-2">
                    <div class="payment-count text-center">
                        <h2>24</h2>
                        <p class="headline text-light-blue">Pagos recibidos</p>
                    </div>
                    <div class="ml-4 year-count text-center">
                        <h2>2</h2>
                        <p class="headline text-light-blue">Años pagados</p>
                    </div>
                </div>
            </div>
            
            <div class="card-footer-float flex flex-wrap justity-between flex-col sm:flex-row" style="">

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
    </div>
</div>
@endsection
