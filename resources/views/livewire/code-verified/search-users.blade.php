<div>
    @if($count < 3)
    <h3 class="mt-2">
        <span class="text-invalid">(*)</span> 
        Tienes <strong class="text-invalid"><b>{{ 3 - $count}}</b> </strong> {{ $count > 1 ? 'intentos' : 'intento' }} para ingresar el 
        <span>
            <strong>Dígito de Verificación</strong>
        </span>
        
    </h3>
    @endif
        <div class="group-input">
            <label for="dni">DNI</label>
            <input type="text" id="dni" maxlength="8" class="input" name="dni"  :value="old('dni')"  wire:model.delay.1000ms="dni" {{ $count === 3 ? 'disabled' : ''}}>
            @error('dni')
            <div class="text-invalid">
            {{ $message }} 
            </div>
            @enderror
        </div>
        <div class="group-input">
            <label for="code_verified">Dígito de Verificación</label>
            <input type="text" id="code_verified" maxlength="1" class="input"  value="{{ old('code_verified') }}"  wire:model.delay.1000ms="code_verified" {{ $count === 3 ? 'disabled' : ''}}>                        
            @error('code_verified')
            <div class="text-invalid">
            {{ $message }} 
            </div>
            @enderror
            <div  class="text-right text-primary pointer" wire:click="toggle">¿Dónde esta el dígito de verificación?</div>
            <div class="view__code__verified {{ $open ? 'active' : '' }}">

                <div class="btn-group">
                    <a 
                        wire:click="tabAzul"
                        class="btn btn-full {{$tabSelect == 'azul' ? 'btn-secondary' : ''}} "
                    >
                        <span>DNI Azul</span>
                    </a>
                    <a
                        class="ml-1 btn btn-full {{$tabSelect == 'electronico' ? 'btn-secondary' : ''}} "
                        wire:click = "tabElectronico"
                    >
                        <span>DNI Electrónico</span>
                    </a>
                </div>
                <div style="display:{{$tabSelect == 'azul' ? 'block' : 'none'}}; padding: 20px">
                        <img src="{{ asset('images/dniverificacion.png') }}" alt="DNI Verificación">
                </div> 
                <div style="display:{{$tabSelect == 'electronico' ? 'block' : 'none'}}; padding: 20px">
                    <img src="{{ asset('images/electronicoverificacion.png') }}" alt="DNI Verificación">
                </div>     
            
            </div>
        </div>
        <div class="">
            <button wire:click.prevent="searchUser" class="btn btn-outline-primary btn-full" {{ empty($dni) || empty($code_verified) || $count === 3 ? 'disabled' : ''}}>
                <i class="material-icons left">search</i>
                <span>Buscar</span>
            </button>
        </div>
    {{-- @if ($searched) --}}
    <div wire:loading wire.target="searched" class="my-2 alert alert-info w-full">
        Buscando...
    </div>
    {{-- @endif --}}
    @if($count === 3)
        <div class="my-2 alert alert-info">{{ $message_wait }}</div>
    @endif 
    @if(!empty($user))
        @if($user['codVerifica'] === $code_verified)
            <div class="mt-3"></div>
            <div class="divider-x"></div>
            <h4 class="mt-3 font-bold">Datos Personales</h4>
            <div class="group-input">
                <label for="name">Nombre Completo</label>
                <input type="text" id="name" name="name" class="input" readonly value="{{ old('name', $full_name) }}">
                @error('name')
                <div class="text-invalid">
                   {{ $message }} 
                </div>
                @enderror
            </div>
            <div class="group-input code">
                <div class="input1 w-full md:w-1/2">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"  class="input" >
                    @error('email')
                    <div class="text-invalid">
                    {{ $message }} 
                    </div>
                    @enderror
                </div>
                <div class="input2 w-full md:w-1/2">
                    <label for="phone">Telefóno o Celular</label>
                    <input type="text" id="phone" name="phone" class="input"  value="{{ old('phone') }}" >                        
                    @error('phone')
                    <div class="text-invalid">
                    {{ $message }} 
                    </div>
                    @enderror
                </div>
            </div>
            <x-field
                label="Adjuntar Archivo"
                name="file" 
                :value="old('file')"
                type="file"
                help="El archivo no debe de superar los 5MB"
            />

            <div class="group-checkbox">
                <label for="accept">
                    <input type="checkbox" name="accept" id="accept" {{ old('accept') ? 'checked' : '' }}>

                    <span>
                    Acepto los  <a href="#" class="ml-1"> Términos y Condiciones</a>
                    </span>
                </label>
            </div>

            <button class="btn btn-primary btn-full">Registrarse</button>
        @else
        <div class="my-2 alert alert-danger w-full">
            Dígito de verificación no es válido
        </div>
        @endif
    @elseif(empty($user) && !empty($dni) && $searched)
        <div class="my-2 alert alert-danger w-full">
            Usuario no ha sido encontrado con el DNI: {{ $dni }}
        </div>
    @endif
</div>