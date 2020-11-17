@extends('layouts.client')
@section('title', 'Correos')

@section('content')
<inboxes-index />
{{-- <div class="bg-light-primary-opacity-20 py-2 px-2">
    <div class="container">
        <div class="my-2 flex justity-between">
            <h2>Correos</h2>
            @can('create', $message)
                <!-- <x-inboxes.sent-message /> -->
            @endcan
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
</div> --}}
{{-- <div class="container">
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
                <dropdown-sort></dropdown-sort> 
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
                    class="mb-1 card card-message flex flex-col pointer
                    @if($inboxes[0]->id == $message->id) card-light-blue @endif
                    "
                    :class="{ 'card-light-blue': tab == {{ $message->id }} }"
                    data-tab-target="#tab-{{ $message->id }}"
                    >
                    <div class="text-left">
                        <div class="mb-1 flex justity-between align-center">
                            <p class="text-sm text-light-blue">{{ $message->user->name }}</p>
                            <p class="text-sm text-light-blue">{{ $message->created_at->diffForHumans() }}</p>
                        </div>
                        <h3>{{ $message->subject }}</h3>
                        <div class="message-body text-truncate">@parsedown($message->body, false)</div>
                    </div>
                    
                </div>
                @empty
                    <div class="cols-4 sm:cols-8 md:cols-12">
                        <x-not-data>
                            No hay ningún mensaje.
                        </x-not-data>
                    </div>
                @endforelse

            </div>

            <div class="preview cols-4 sm:cols-8 md:cols-7">

                @foreach($inboxes as $message)
                <div 
                    class="card @if($inboxes[0]->id == $message->id) active @endif"
                    id="tab-{{ $message->id }}"
                    data-tab-content
                    >
                    <div class="mb-1 flex justity-between align-center">
                        <div>
                            {{ $message->user->name }} 
                            <span class="text-light-blue text-sm">({{ $message->user->email }}) -> </span>
                            <span class="text-light-blue text-sm">Para {{ $send === 'me' ? 'mí' : $message->to }}</span>
                        </div>
                        <btn-delete 
                            :model="{{ $message }}" 
                            resource="inboxes"></btn-delete>
                    </div> 
                    <h2>{{ $message->subject }}</h2>
                    <p class="mb-2 text-light-blue text-sm">
                        {{ $message->created_at->diffForHumans() }}
                    </p>
                    <div class="mb-2 text-light-blue markdown">
                        @parsedown($message->body)
                    </div> 
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
    
</div> --}}

@endsection
@push('js')
<script src="https://unpkg.com/marked@0.3.6"></script>
    
@endpush