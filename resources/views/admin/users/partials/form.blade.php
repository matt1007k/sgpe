
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

    <div>
        <p>Archivo adjunto:</p>
        @if($user->file)
        <a href="{{ $user->pathFile() }}" target="_blank" class="btn btn-secondary">
            <i class="material-icons icon">download</i>
            <span>Descargar</span>
        </a>
        @else
        <p class="text-light-blue">No tiene un archivo.</p>
        @endif
    </div>

    <div class="my-2 flex justity-between flex-col sm:flex-row">
        <div>
            <p>Estado</p>
            <livewire:users.show-status :status="$user->status" />
        </div>
        
        @if(!empty($user->dni) && old('status', $user->status) === 'unverified')
            <verify-user dni="{{ $user->dni }}" />
        @endif

    </div>
    @if(old('status', $user->status) === 'verified')
    <div class="my-4">  
        <modal-generate>
            <livewire:users.password-generate />
        </modal-generate>
    </div>
    @endif

    <div class="divider-x"></div>

    <div class="mt-4 flex justity-end">
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        <button class="ml-2 btn btn-primary">{{ $btnText }}</button>
    </div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.min.js"></script>
@endpush