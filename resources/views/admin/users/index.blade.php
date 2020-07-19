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
            <x-form method="get" :action="route('users.index')" class="rounded-md bg-white py-1 px-1 md:px-2 cols-4 sm:cols-6 flex align-center">
            {{-- <div class=""> --}}
                <div class="search-input">
                    <i class="material-icons left icon">search</i>
                    <input type="search" name="search" value="{{ old('search', $search) }}" class="input border-none" placeholder="Que usuarios buscas...">
                </div>
                <button class="btn btn-dark">Buscar</button>
            {{-- </div> --}}
            </x-form>
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
                <dropdown-sort-b>
                    <ul class="dropdown__menu">
                        <li class="@if($sort == 'desc') active @endif">
                            <a href="{{ route('users.index', ['sort' => 'desc']) }}">
                                Último registros
                            </a>
                        </li>
                        <li class="@if($sort == 'asc') active @endif">
                            <a href="{{ route('users.index', ['sort' => 'asc']) }}">
                                Antiguo registros
                            </a>
                        </li>
                    </ul>
                </dropdown-sort-b>
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
                        <btn-delete 
                            :model="{{ $user }}" 
                            resource="users"></btn-delete>

                        <a href="{{ route('users.edit', $user) }}" class="action tooltip">
                           <i class="material-icons-two-tone">edit</i> 
                            <span>Editar</span>
                        </a>
                        
                        <btn-view-user :user="{{ $user }}" />
                        
                    </div>
                </div>
            </div>
            @empty
            <x-not-data>
                No hay ningún registro.
            </x-not-data>
            @endforelse

            <div class="w-100 flex justify-between align-center flex-col sm:flex-row" style="justify-content: space-between">
                <h3>Total de registros: {{ $users->total() }}</h3>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection