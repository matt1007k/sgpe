<div class="bg-light-primary-opacity-20 py-2 px-2">
    <div class="container">
        <div class="my-2 flex justity-between">
            <h2>Usuarios</h2>
            <a href="#" class="btn btn-primary">
                <i class="material-icons">add</i>
                Nuevo usuario
            </a>
        </div>
        <div class="grid">
            <div class="rounded-md bg-white py-1 px-1 md:px-2 cols-4 sm:cols-6">
                <div class="search-input">
                    <i class="material-icons left icon">search</i>
                    <input wire:model.lazy="search" type="search" class="input border-none" placeholder="Que usuarios buscas...">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="content mt-0">
        <div class="grid">
            <div class="cols-4 sm:cols-6 md:cols-5">
                <div class="btn-group">
                    <div class="btn btn-secondary btn-full">
                        <i class="material-icons-two-tone left">verified</i>
                        <span>
                           Verificados
                        </span>    
                    </div>
                    <div class="ml-1 btn btn-full">
                        <i class="material-icons-two-tone left">person_remove</i>
                        <span>
                            Sin Verificar
                        </span>    
                    </div>
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
                <div class="cols-4 sm:cols-2 md:cols-2">
                    <livewire:users.show-status :status="$user->status" />
                </div>
                <div class="cols-4 sm:cols-5 md:cols-3">
                    <p class="text-light-blue">
                        Fecha de registro {{ $user->created_at->format('d M, Y')}}
                    </p>
                </div>
                <div class="cols-4 sm:cols-3 md:cols-3">
                    <div class="mx-4 actions flex justity-between">
                        <div class="action tooltip">
                            <i class="material-icons-two-tone">delete</i>
                            <span>Eliminar</span>
                        </div>
                        <div class="action tooltip">
                           <i class="material-icons-two-tone">edit</i> 
                            <span>Editar</span>
                        </div>
                        <div class="action tooltip">
                            <i class="material-icons-two-tone">preview</i> 
                             <span>Ver Detalle</span>
                         </div>
                    </div>
                </div>
            </div>
            @empty
                <h3>No hay registros</h3>
            @endforelse

            {{-- {{ $users->links() }} --}}
        </div>
    </div>
</div>