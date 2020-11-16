
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
        

    </div>

    <div class="divider-x"></div>

    <div class="mt-4 flex justity-end">
        <a href="{{ route('profile') }}" class="btn btn-outline-secondary">Cancelar</a>
        <button class="ml-2 btn btn-primary">{{ $btnText }}</button>
    </div>
