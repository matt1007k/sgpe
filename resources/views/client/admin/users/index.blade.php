@extends('layouts.client')
@section('title', 'Usuarios')

@section('content')
<div class="bg-light-primary-opacity-20 py-2 px-2">
    <div class="container">
        <div class="my-2 flex justity-between">
            <h2>Usuarios</h2>
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                <i class="material-icons">add</i>
                Nuevo usuario
            </a>
        </div>
        <div class="grid">
            <div class="rounded-md bg-white py-1 px-1 md:px-2 cols-4 sm:cols-6 flex align-center">
                <div class="search-input">
                    <i class="material-icons left icon">search</i>
                    <input type="search" class="input border-none" placeholder="Que usuarios buscas...">
                </div>
                <button class="btn btn-dark">Buscar</button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="content mt-0">
        <div class="grid">
            <div class="cols-4 sm:cols-6 md:cols-5">
                <div class="btn-group">
                    <a href="{{ route('users.index', ['f' => 'verified']) }}" class="btn @if($status === 'verified') btn-secondary @endif btn-full">
                        <i class="material-icons-two-tone left">verified</i>
                        <span>
                           Verificados
                        </span>    
                    </a>
                    <a href="{{ route('users.index', ['f' => 'unverified']) }}" class="ml-1 btn @if($status === 'unverified') btn-secondary @endif btn-full">
                        <i class="material-icons-two-tone left">person_remove</i>
                        <span>
                            Sin Verificar
                        </span>    
                    </a>
                </div>
            </div>
            <div class="order cols-4 sm:cols-2 md:cols-7 align-self-center justify-self-end">
                <div class="flex dropdown__container align-center text-light-blue"
                x-data="{ open: false }"
                >
                    Ordenar por:
                    <a @click="open = true" class="cursor-pointer"><i class="ml-1 material-icons-two-tone">sort</i>
                    </a>
                    <div class="dropdown"
                    x-show="open"
                    @click.away="open = false"
                    x-transition:enter="transition"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition"
                    x-transition:leave-end="opacity-0 -translate-y-3"
                    >
                        <ul class="dropdown__menu">
                            <li>Último periodo</li>
                            <li>Antiguo periodo</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="list__item">
        
            @forelse($users as $user)
            <div class="mb-1 card grid">
                <div class="cols-4 sm:cols-6 md:cols-4 text-left">
                    <h4>{{ $user->name }}</h4>
                    <p class="text-light-blue ">
                        DNI {{ $user->dni }} 
                    </p>
                </div>
                <div class="cols-4 sm:cols-2 md:cols-2  align-self-center">
                    <livewire:users.show-status :status="$user->status" />
                </div>
                <div class="cols-4 sm:cols-5 md:cols-3  align-self-center">
                    <p class="text-light-blue">
                        Fecha de registro {{ $user->created_at->format('d M, Y')}}
                    </p>
                </div>
                <div class="cols-4 sm:cols-3 md:cols-3  align-self-start">
                    <div class="mx-4 actions flex justity-between">
                        <div x-data="{ open: false }">
                            <a @click="open = true" class="action tooltip">
                                <i class="material-icons-two-tone">delete</i>
                                <span>Eliminar</span>
                            </a>
                            <div class="modal" 
                                x-show="open"
                                @click.away="open = false"
                                x-transition:enter="transition"
                                x-transition:enter-start="opacity-0 -translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition"
                                x-transition:leave-end="opacity-0 -translate-y-3"
                                >
                                <div class="modal-content" style="
                                width: 500px;">
                                    <div class="close" @click="open = false">
                                        <i class="material-icons">close</i>
                                    </div>
                                    <div class="card">
                                        <x-form method="delete" :action="route('users.destroy', $user)">
                                        <div class="flex flex-col sm:flex-row">
                                            <div class="flex align-start ic icon-small icon-danger">
                                                <i class="material-icons-two-tone">warning</i>
                                            </div>
                                            <div class="ml-1 flex flex-col">
                                                <h3 class="mb-1">Eliminar registro</h3>
                                                <p class="text-light-blue">Estas seguro de eliminar el registro?. Esto borrar todos los datos existentes de manejar definitiva.</p>
                                            </div>
                                        </div>
                                        <div class="actions">
                                            <a
                                                class="btn btn-outline-secondary"  
                                                @click="open = false"
                                                >Cancelar</a>
                                            <button class="btn btn-danger">Eliminar</button>
                                        </div>
                                        </x-form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('users.edit', $user) }}" class="action tooltip">
                           <i class="material-icons-two-tone">edit</i> 
                            <span>Editar</span>
                        </a>
                        <a class="action tooltip">
                            <i class="material-icons-two-tone">preview</i> 
                             <span>Ver Detalle</span>
                         </a>
                    </div>
                </div>
            </div>
            @empty
                <h3>No hay registros</h3>
            @endforelse

            <div class="w-100 flex justify-between align-center flex-col sm:flex-row" style="justify-content: space-between">
                <h3>Total de registros: {{ $users->total() }}</h3>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection