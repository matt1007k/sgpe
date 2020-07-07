
    <x-field 
        label="Nombre Completo" 
        type="text" 
        name="name" 
        :value="old('name', $user->name)" required /> 

    <x-field 
        label="DNI" 
        type="number" 
        name="dni" 
        :value="old('dni', $user->dni)" required /> 

    <x-field 
        label="Télefono o Celular" 
        type="number" 
        name="phone" 
        :value="old('phone', $user->phone)" required /> 
    
    <x-field 
        label="Correo Electrónico" 
        type="email" 
        name="email" 
        :value="old('email', $user->email)" required /> 

    <div class="my-2 flex justity-between flex-col sm:flex-row">
        <div>
            <p>Estado</p>
            <livewire:users.show-status :status="$user->status" />
        </div>
        <div x-data="{ open: false }">
            <a class="btn btn-outline-teal" @click="open = true">
                <i class="material-icons left">check</i>
                Verificar usuario
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
                        <h3>Verificar usuario</h3>
                        <div class="group-input">
                        <input type="text" class="input" placeholder="Que usuario buscas...">
                        </div>
                        <div class="actions">
                            <button 
                                class="btn btn-outline-secondary"  
                                @click="open = false"
                                >Cancelar</button>
                            <button class="btn btn-primary">Verificar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(old('status', $user->status) === 'verified')
    <div class="my-4" x-data="{ open: false }">
        <a class="cursor-pointer" @click="open = true">Generar o cambiar contraseña</a>
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
                    <h3 class="mb-1">Generar o cambiar contraseña</h3>
                    <p class="text-light-blue">Genera una contraseña de manera aleatoria o ingresa una propia.</p>

                    <livewire:users.password-generate />
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="divider-x"></div>

    <div class="mt-4 flex justity-end">
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        <button class="ml-2 btn btn-primary">{{ $btnText }}</button>
    </div>