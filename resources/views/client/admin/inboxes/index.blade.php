@extends('layouts.client')
@section('title', 'Correos')

@section('content')
<div class="bg-light-primary-opacity-20 py-2 px-2">
    <div class="container">
        <div class="my-2 flex justity-between">
            <h2>Correos</h2>
            <x-inboxes.sent-message />
        </div>
        <div class="grid">
            <div class="rounded-md bg-white py-1 px-1 md:px-2 cols-4 sm:cols-6 flex align-center">
                <div class="search-input">
                    <i class="material-icons left icon">search</i>
                    <input type="search" class="input border-none" placeholder="Que correo buscas...">
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
                    <a href="{{ route('inboxes.index', ['f' => 'me']) }}" class="btn @if($send === 'me') btn-secondary @endif btn-full">
                        <i class="material-icons-two-tone left">all_inbox</i>
                        <span>
                            Recibidos
                        </span>    
                    </a>
                    <a href="{{ route('inboxes.index', ['f' => 'send']) }}" class="ml-1 btn @if($send === 'send') btn-secondary @endif btn-full">
                        <i class="material-icons-two-tone left">send</i>
                        <span>
                            Enviados 
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
        <div class="list__item grid"
            x-data="{ tab: {{ $inboxes->count() > 0 ? $inboxes->first()->id : 1 }} }"
        >
        <div class="items cols-4 sm:cols-8 md:cols-5 flex flex-col">
            @forelse($inboxes as $message)
        
                <div 
                    class="mb-1 card card-message flex flex-col pointer"
                    :class="{ 'card-light-blue': tab == {{ $message->id }} }"
                    @click="tab = {{ $message->id }}"
                    >
                    <div class="text-left">
                        <div class="mb-1 flex justity-between align-center">
                            <p class="text-sm text-light-blue">{{ $message->user->name }}</p>
                            <p class="text-sm text-light-blue">{{ $message->created_at->diffForHumans() }}</p>
                        </div>
                        <h3>{{ $message->subject }}</h3>
                        <div class="message-body text-truncate">@parsedown($message->body, false)</div>
                    </div>
                    {{-- <div class="">
                        <div class="actions flex justity-end">

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
                                            <x-form method="delete" >
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
                        
                        </div>
                    </div> --}}
                </div>
                @empty
                    <div class="cols-4 sm:cols-8 md:cols-12">
                        <h3>No hay registros</h3>
                    </div>
                @endforelse

            </div>

            <div class="preview cols-4 sm:cols-8 md:cols-7">

                @foreach($inboxes as $message)
                <div 
                    class="card"
                    x-show.transition.in.duration.400ms.out.duration.400ms="tab == {{ $message->id }}"
                    
                    >
                    <div class="mb-1 flex justity-between align-center">
                        <div>
                            {{ $message->user->name }} 
                            <span class="text-light-blue text-sm">({{ $message->user->email }}) -> </span>
                            <span class="text-light-blue text-sm">Para {{ $send === 'me' ? 'mí' : $message->to }}</span>
                        </div>
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
                                        <x-form method="delete" :action="route('inboxes.destroy', $message)">
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
                    </div> 
                    <h2>{{ $message->subject }}</h2>
                    <p class="mb-2 text-light-blue text-sm">{{ $message->created_at->diffForHumans() }}</p>
                    <div class="mb-2 text-light-blue markdown">@parsedown($message->body)</div> 
                    <div class="mb-2">
                        <div class="mb-1"> 
                            <span class="headline text-light-blue">DNI</span>  
                            <h5>40594458</h5>
                        </div>
                        <div class="mb-1">
                            <span class="headline text-light-blue">Correo electrónico</span>
                            <h5>jjdj@gmail.com</h5>
                        </div>
                        <div>
                            <span class="headline text-light-blue">Teléfono o celular</span>
                            <h5>954452451</h5>
                        </div>
                    </div>
                    <a href="{{ route('users.index', ['search' => '55555555']) }}">Verificar usuario</a>
                </div>               
                
                @endforeach

            </div>
            
            @if($inboxes->count() > 0)
            <div class="cols-4 sm:cols-8 md:cols-12 w-100 flex justify-between align-center flex-col sm:flex-row" style="justify-content: space-between">
                <h3>Total de registros: {{ $inboxes->total() }}</h3>
                {{ $inboxes->links() }}
            </div>
            @endif

        </div>
    </div>
</div>
@endsection